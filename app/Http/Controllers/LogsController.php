<?php

namespace App\Http\Controllers;

use App\Log;
use App\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\LogsExport;
use Maatwebsite\Excel\Facades\Excel;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::query();

        if ($request->filled('created_from')) {
            try {
                $from = Carbon::parse($request->created_from);
                $query->where('created_at', '>=', $from);
            } catch (\Exception $e) {}
        }

        if ($request->filled('created_to')) {
            try {
                $to = Carbon::parse($request->created_to);
                $query->where('created_at', '<=', $to);
            } catch (\Exception $e) {}
        }

        if ($request->filled('response_keyword')) {
            $keyword = $request->response_keyword;
            $query->where('request_data', 'like', '%' . $keyword . '%');
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(25);

        return view('admin.logs.list', compact('logs'));
    }

    public function getDetails($id)
    {
        $log = Log::find($id);
        if (!$log) {
            return response()->json(['error' => 'Log not found'], 404);
        }

        return view('admin.logs.details', compact('log'));
    }

    /**
     * Export filtered request_data as CSV (openable in Excel).
     */
    public function export(Request $request)
    {
        $query = Log::query();

        if ($request->filled('created_from')) {
            try {
                $from = Carbon::parse($request->created_from);
                $query->where('created_at', '>=', $from);
            } catch (\Exception $e) {}
        }

        if ($request->filled('created_to')) {
            try {
                $to = Carbon::parse($request->created_to);
                $query->where('created_at', '<=', $to);
            } catch (\Exception $e) {}
        }

        if ($request->filled('response_keyword')) {
            $keyword = $request->response_keyword;
            $query->where('request_data', 'like', '%' . $keyword . '%');
        }

        $filename = 'logs_request_data_' . now()->format('Ymd_His') . '.csv';

        $callback = function() use ($query) {
            $handle = fopen('php://output', 'w');
            // header row
            fputcsv($handle, ['id', 'created_at', 'request_data']);
            // stream results — use cursor to avoid memory issues
            foreach ($query->orderBy('created_at', 'desc')->cursor() as $log) {
                // Ensure request_data is string
                $data = is_scalar($log->request_data) ? $log->request_data : json_encode($log->request_data);
                fputcsv($handle, [$log->id, $log->created_at, $data]);
            }
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Export filtered request_data as XLSX where columns are JSON keys.
     */
    public function exportXlsx(Request $request)
    {
        $query = Log::query();

        if ($request->filled('created_from')) {
            try {
                $from = Carbon::parse($request->created_from);
                $query->where('created_at', '>=', $from);
            } catch (\Exception $e) {}
        }

        if ($request->filled('created_to')) {
            try {
                $to = Carbon::parse($request->created_to);
                $query->where('created_at', '<=', $to);
            } catch (\Exception $e) {}
        }

        if ($request->filled('response_keyword')) {
            $keyword = $request->response_keyword;
            $query->where('request_data', 'like', '%' . $keyword . '%');
        }

        // Collect headings (union of all top-level JSON keys) and rows
        $allKeys = [];
        $rows = [];

        foreach ($query->orderBy('created_at', 'desc')->cursor() as $log) {
            $decoded = null;
            if (!empty($log->request_data)) {
                $decoded = json_decode($log->request_data, true);
            }

            if (!is_array($decoded)) {
                // not JSON or scalar: put under a single column "request_data_raw"
                $decoded = ['request_data_raw' => (string)$log->request_data];
            }

            // track keys
            foreach ($decoded as $k => $v) {
                if (!in_array($k, $allKeys, true)) {
                    $allKeys[] = $k;
                }
            }

            // keep meta columns too (id, created_at) + decoded values per log
            $rows[] = array_merge(
                ['id' => $log->id, 'created_at' => $log->created_at->toDateTimeString()],
                $decoded
            );
        }

        if (empty($rows)) {
            // nothing to export — provide empty sheet with headings
            $headings = ['id', 'created_at'];
            return Excel::download(new LogsExport($headings, []), 'logs_empty.xlsx');
        }

        // Ensure all rows have same columns in same order
        $headings = array_merge(['id', 'created_at'], $allKeys);

        $normalizedRows = [];
        foreach ($rows as $r) {
            $row = [];
            foreach ($headings as $h) {
                // convert arrays/objects to JSON string
                $val = $r[$h] ?? '';
                if (is_array($val) || is_object($val)) $val = json_encode($val, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                $row[] = $val;
            }
            $normalizedRows[] = $row;
        }

        $filename = 'logs_request_data_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new LogsExport($headings, $normalizedRows), $filename);
    }
}

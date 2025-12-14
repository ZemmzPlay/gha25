<?php

namespace App\Http\Controllers;

use App\Log;
use App\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index(Request $request)
    {
        // return logs with pagination
        // $logs = Log::orderBy('created_at', 'desc')->paginate(50);

        // return view('admin.logs.list', compact('logs'));
        $query = Log::query();

        // created_at range (expects datetime-local inputs like "2025-12-14T10:30")
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

        // keyword in request_data
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
}

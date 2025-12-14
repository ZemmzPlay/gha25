<?php

namespace App\Http\Controllers;

use App\Log;
use App\Registration;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        // return logs with pagination
        $logs = Log::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.logs.list', compact('logs'));
    }
}

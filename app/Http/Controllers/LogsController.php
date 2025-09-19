<?php

namespace App\Http\Controllers;

use App\Log;
use App\Registration;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Log::all();

        return view('admin.logs.list', compact('logs'));
    }
}

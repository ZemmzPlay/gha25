<?php

namespace App\Http\Middleware;

use App\Log;
use Closure;
use Illuminate\Support\Facades\Auth;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Log::create([
            'registration_id' => Auth::check() ? Auth::id() : null,
            // 'admin_id' => Auth::guard('admin-api') ? Auth::guard('admin-api')->id() : null,
            'action' => $this->cleanActionName($request->route()->getActionName()),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'request_data' => json_encode($request->except(['password', 'confirm_password', 'token']), true), // Exclude sensitive data
            'response_data' => json_encode($response->getContent(), true),
            'status_code' => $response->status(),
        ]);

        return $response;
    }

    /**
     * remove some text from the action name
     * @param string $action
     * @return string
     */
    private function cleanActionName(string $action): string
    {
        // Remove the namespace and the class name
        // For example: "App\Http\Controllers\API\UserController@index" becomes "UserController@index"
        $action = str_replace('App\Http\Controllers\API\\', "", $action);
        // Remove the word Controller
        // For example: "UserController@index" becomes "User@index"
        $action = str_replace('Controller', "", $action);
        return $action;
    }
}

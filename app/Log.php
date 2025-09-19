<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'action',
        'method',
        'url',
        'ip_address',
        'user_agent',
        'request_data',
        'response_data',
        'status_code'
    ];

    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
    ];
}

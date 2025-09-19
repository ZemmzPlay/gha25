<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Log extends Model
{
    protected $appends = ['user', 'agent'];

    protected $fillable = [
        'registration_id',
        'action',
        'method',
        'url',
        'ip_address',
        'user_agent',
        'request_data',
        'response_data',
        'status_code'
    ];

    public function getUserAttribute()
    {
        return $this->registration ? $this->registration->name : 'Guest';
    }

    public function getActionAttribute($value)
    {
        return ucfirst(str_replace('App\Http\s\Registration@', '', $value));
    }

    public function getAgentAttribute($value)
    {
        $agent = new Agent();
        $agent->setUserAgent($value);

        $platform = $agent->platform() ?? 'Unknown OS';
        $platformVersion = $agent->version($platform);

        if ($platform === 'Unknown') {
            if (str_contains($value, 'Windows NT 10.0')) $platform = 'Windows 10';
        }

        $browser = $agent->browser() ?? 'Other Browser';
        $browserVersion = $agent->version($browser);

        if ($browser === 'Other Browser' && str_contains($value, 'Chrome/')) {
            preg_match('/Chrome\/([0-9\.]+)/', $value, $matches);
            $browser = 'Chrome';
            $browserVersion = $matches[1] ?? '';
        }

        return trim("{$platform} {$platformVersion} · {$browser} {$browserVersion}");
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}

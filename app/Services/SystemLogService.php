<?php

namespace App\Services;

use App\Models\SystemLog;

class SystemLogService
{
    public static function log(
        string $action,
        ?string $description = null
    ): SystemLog {
        return SystemLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
            'method' => request()->method(),
            'route' => request()->route()?->getName(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
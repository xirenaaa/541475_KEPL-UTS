<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HealthController extends Controller
{
    public function __invoke()
    {
        $status  = 'healthy';
        $code    = 200;
        $checks  = [];

        // Check database
        try {
            DB::connection()->getPdo();
            DB::select('SELECT 1');
            $checks['database'] = 'ok';
        } catch (\Throwable $e) {
            $checks['database'] = 'failed: ' . $e->getMessage();
            $status = 'unhealthy';
            $code   = 503;
            Log::error('Health check: database unreachable', [
                'action'  => 'health.check',
                'service' => 'database',
                'reason'  => $e->getMessage(),
            ]);
        }

        // Check cache
        try {
            Cache::store()->put('health_check', true, 10);
            $value = Cache::store()->get('health_check');
            if ($value === true) {
                $checks['cache'] = 'ok';
            } else {
                $checks['cache'] = 'failed: read-back mismatch';
                $status = 'unhealthy';
                $code   = 503;
            }
        } catch (\Throwable $e) {
            $checks['cache'] = 'failed: ' . $e->getMessage();
            $status = 'unhealthy';
            $code   = 503;
            Log::error('Health check: cache unreachable', [
                'action'  => 'health.check',
                'service' => 'cache',
                'reason'  => $e->getMessage(),
            ]);
        }

        return response()->json([
            'status' => $status,
            'checks' => $checks,
        ], $code);
    }
}

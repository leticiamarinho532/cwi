<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Queue;
use Exception;

class HealthService
{
    /**
     * @return array
     */
    public function verify()
    {
        try {
            $results = [];

            try {
                DB::connection()->getPdo();
                $results['database'] = 'ok';
            } catch (\Exception $e) {
                $results['database'] = 'error: '.$e->getMessage();
            }

            try {
                $key = 'health_check';
                Cache::put($key, true, 1);
                if (Cache::get($key)) {
                    $results['cache'] = 'ok';
                } else {
                    $results['cache'] = 'error';
                }
            } catch (\Exception $e) {
                $results['cache'] = 'error: '.$e->getMessage();
            }

            try {
                if (config('queue.default') && Queue::getFacadeRoot()) {
                    $results['queue'] = 'ok';
                } else {
                    $results['queue'] = 'skipped';
                }
            } catch (\Exception $e) {
                $results['queue'] = 'error: '.$e->getMessage();
            }

            $status = in_array('error', $results, true) ? 'error' : 'ok';

            return [
                'status' => $status,
                'checks' => $results
            ];
        } catch (Exception $e) {
            Log::error('Erro ao buscar health check do sistema: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'error' => true,
                'message' => 'Não foi possivel atender sua solicitação.'
            ];
        }
    }
}
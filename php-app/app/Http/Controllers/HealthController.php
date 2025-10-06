<?php

namespace App\Http\Controllers;

use App\Services\HealthService;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    protected HealthService $healthService;

    public function __construct(HealthService $service)
    {
        $this->healthService = $service;
    }

    public function index()
    {
        $result = $this->healthService->verify();

        if (isset($result['error'])) {
            return response()->json(['error' => $result['message']], 500);
        }

        return response()->json([
            'status' => $result['status'],
            'checks' => $result['checks'],
            'environment' => config('app.env'),
            'app' => config('app.name'),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
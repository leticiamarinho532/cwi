<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExternalRequest;
use App\Services\ExternalService;
use Illuminate\Http\JsonResponse;

class ExternalController extends Controller
{
    protected ExternalService $externalService;

    public function __construct(ExternalService $service)
    {
        $this->externalService = $service;
    }

    public function handle(ExternalRequest $request): JsonResponse
    {
        $text = $request->input('text');
        $key  = $request->input('key');

        $result = $this->externalService->checkString($text, $key);

        if ($result['success']) {
            return response()->json([
                'message' => 'Sucesso',
                'data' => $result['data']
            ]);
        }

        $statusCode = $result['status_code'] ?? 422;

        return response()->json(
            array_merge(['message' => $result['message']], $result['details'] ?? []),
            $statusCode
        );
    }
}

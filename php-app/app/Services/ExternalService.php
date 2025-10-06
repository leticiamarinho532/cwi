<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalService
{
    protected string $url;

    public function __construct()
    {
        $this->url = config('services.nodejs.url', 'http://nodejs-app:3000/check-string');
    }

    /**
     * @param string $text
     * @param string $key
     * @return array
     */
    public function checkString(string $text, string $key): array
    {
        try {
            $response = Http::timeout(5)->get($this->url, [
                'text' => $text,
                'key' => $key,
            ]);

            if ($response->failed()) {
                Log::error('NodeJS retornou erro', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'message' => 'Não foi possível atender sua solicitação',
                    'status_code' => 503
                ];
            }

            $body = $response->json();

            if (isset($body['errors'])) {
                Log::warning('Validação do NodeJS falhou', ['errors' => $body['errors']]);

                $userMessage = [];
                
                foreach ($body['errors'] as $field => $msg) {
                    $userMessage[] = "Campo '{$field}': {$msg}";
                }

                return [
                    'success' => false,
                    'message' => 'Erro de validação nos dados enviados',
                    'details' => $userMessage,
                    'status_code' => 422
                ];
            }

            return [
                'success' => true,
                'data' => $body
            ];
        } catch (\Exception $e) {
            Log::error('Erro ao conectar com NodeJS', ['exception' => $e->getMessage()]);

            return [
                'success' => false,
                'message' => 'Não foi possível atender sua solicitação'
            ];
        }
    }
}

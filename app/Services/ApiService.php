<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{

    protected function performRequest(string $method, string $url, string $query = '', array $parameters = []): string
    {
        $finalUrl = $url . $query;
        if ($method === 'GET') {
            $response = Http::withHeaders([
                'accept-encoding' => 'gzip',
            ])->get($finalUrl, $parameters);
        } else {
            abort(405);
        }

        if ($response->successful()) {
            return $response->body();
        } else {
            abort($response->status());
        }
    }

    public function performGetRequest(string $apiUrl, string $query = '', array $parameters = [])
    {
        $content = $this->performRequest('GET', $apiUrl, $query, $parameters);
        return json_decode($content);
    }
}

<?php

namespace App\Services;

class AiService
{
    protected $apiUrl = 'http://rag-service:8000/chat';

    public function getChatResponse(string $message, int $propertyId = null)
    {
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post($this->apiUrl, [
                'json' => [
                    'message'     => $message,
                    'property_id' => $propertyId
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => 'AI Service Unavailable: ' . $e->getMessage()];
        }
    }
}

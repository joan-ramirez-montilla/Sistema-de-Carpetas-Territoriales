<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait WhatsAppApi
{
    public function sendWhatsAppTemplate(
        string $to,
        string $templateName,
        array $parameters,
        string $language = 'en_US'
    ): array {
        $url = sprintf(
            'https://graph.facebook.com/%s/%s/messages',
            config('services.whatsapp.version'),
            config('services.whatsapp.phone_number_id')
        );

        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => [
                    'code' => $language,
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => collect($parameters)->map(fn ($text) => [
                            'type' => 'text',
                            'text' => $text,
                        ])->toArray(),
                    ],
                ],
            ],
        ];

        $response = Http::withToken(config('services.whatsapp.token'))
            ->acceptJson()
            ->post($url, $payload);

        if ($response->failed()) {
            Log::error('WhatsApp API Error', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
        }

        return $response->json();
    }
}

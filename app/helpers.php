<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('pageUrl')) {

    function pageUrl(
        string $controller,
        string $action = 'index',
        ?int $id = null
    ): string {
        $payload = [
            'controller' => $controller,
            'action' => $action,
        ];

        if ($id !== null) {
            $payload['id'] = $id;
        }

        $encrypted = Crypt::encryptString(
            json_encode($payload)
        );

        return route('page', [
            'data' => $encrypted
        ]);
    }
}
<?php

class Response
{
    public static function json(int $code, string $message, ?array $data = null): string
    {
        $response = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data) {
            if ($code < 300) $response['data'] = $data;
            else $response['errors'] = $data;
        }
        
        return json_encode($response);
    }
}

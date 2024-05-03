<?php

class Response
{
    public static function json(int $code, string $message, ?array $data): string
    {
        $response = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data) 
            $response['data'] = $data;
        
        return json_encode($response);
    }
}

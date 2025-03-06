<?php

namespace App\Exceptions;

use Exception;

class CustomErrorException extends Exception
{
    protected $message;
    protected mixed $statusCode;

    public function __construct($message = "An error occurred", $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    // متد برای تبدیل خطا به پاسخ JSON
    public function render()
    {
        return response()->json([
            'success' => false,
            'data' => [],
            'message' => $this->message
        ], $this->statusCode);
    }
}

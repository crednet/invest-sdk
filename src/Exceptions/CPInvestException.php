<?php

namespace Credpal\CPInvest\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;

class CPInvestException extends Exception
{
    protected $errorData;

    public function __construct(string $message, int $code, array $errorData = [])
    {
        $this->errorData = $errorData;
        parent::__construct($message, $code);
    }

    public function render(): JsonResponse
    {
        $errorResponse = [
            'success' => false,
            'message' => $this->getMessage()
        ];

        return response()->json($errorResponse, $this->getCode());
    }
}

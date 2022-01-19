<?php

namespace Credpal\CPInvest\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;

class CPInvestException extends Exception
{
    public static $errors;

    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function render(): JsonResponse
    {
        $errorResponse = [
            'success' => false,
            'message' => $this->getMessage()
        ];
        
        if ($this->getCode() == \Symfony\Component\HttpFoundation\Response::HTTP_EXPECTATION_FAILED) {
            $errorResponse['errors'] = self::getValidationErrors();
        }

        return response()->json($errorResponse, $this->getCode());
    }

    public static function setValidationErrors(array $errorData)
    {
        self::$errors = $errorData;
    }

    public static function getValidationErrors()
    {
        return self::$errors;
    }
}

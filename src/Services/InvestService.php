<?php

namespace Credpal\CPInvest\Services;

use Credpal\CPInvest\Exceptions\CPInvestException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class InvestService
{
    public static function makeRequest(string $url, string $method = "post", array $data = [])
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'client-key' => config('cpinvest.client_key')
            ])->$method(config('cpinvest.base_url') . $url, $data);

            if (!$response->successful()) {
                if ($response->status() == Response::HTTP_EXPECTATION_FAILED && isset($response->json()['errors'])) {
                    CPInvestException::setValidationErrors($response->json()['errors']);
                }
                throw new CPInvestException($response->json()["message"], $response->status());
            }

            return $response;
        } catch (\Exception $e) {
            throw new CPInvestException($e->getMessage(), $e->getCode());
        }
    }

    public static function getInvestmentTenures()
    {

        return self::makeRequest('tenures/list', 'get')->json();
    }

    public static function createInvestment($data)
    {
        return self::makeRequest("investments", "post", $data)->json()['data'];
    }

    public static function getAllUserInvestments($data)
    {
        return self::makeRequest("investments", "get", $data)->json()['data'];
    }

    public static function getUserActiveInvestments($data)
    {
        return self::makeRequest("investments/active", "get", $data)->json()['data'];
    }

    public static function getInvestmentDetails($data)
    {
        return self::makeRequest("investments/{$data['investment_id']}/user/{$data['user_id']}", "get")
            ->json()['data'];
    }

    public static function getInvestmentTransactions($data)
    {
        return self::makeRequest(
            "investments/{$data['investment_id']}/user/{$data['user_id']}/transactions",
            "get",
        )->json()['data'];
    }

    public static function liquidateInvestment($data)
    {
        return self::makeRequest(
            "investments/{$data['investment_id']}/user/{$data['user_id']}/liquidate",
            "post",
            $data
        )->json()['data'];
    }

    public static function withdrawFunds($data)
    {
        return self::makeRequest(
            "investments/{$data['investment_id']}/user/{$data['user_id']}/withdraw",
            "post",
            $data
        )->json()['data'];
    }

    public static function requestOtp($data)
    {
        return self::makeRequest(
            "otp",
            "post",
            $data
        )->json()['data'];
    }

    public static function getSummary($data)
    {
        return self::makeRequest(
            "investments/summary/user/{$data['user_id']}",
            "get",
        )->json()['data'];
    }
}

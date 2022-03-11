<?php

namespace Credpal\CPInvest\Services;

use Credpal\CPInvest\Models\Investment;
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
		$createInvest = self::makeRequest("investments", "post", $data)->json()['data'];

		Investment::logInvestmentDetails($createInvest['investment']);
		return $createInvest;
	}

	public static function getAllUserInvestments($data)
	{
		return self::makeRequest("investments", "get", $data)->json();
	}

	public static function getUserActiveInvestments($data)
	{
		return self::makeRequest("investments/active", "get", $data)->json();
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
		)->json();
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

	public static function getInvestmentTypes()
	{
		return self::makeRequest(
			"investment-types",
			"get"
		)->json();
	}

	public static function getInvestmentTypeDetails($investmentTypeSlug)
	{
		return self::makeRequest(
			"investment-types/{$investmentTypeSlug}",
			"get"
		)->json();
	}

	public static function getSummary($data)
	{
		return self::makeRequest(
			"investments/summary/user/{$data['user_id']}",
			"get",
		)->json()['data'];
	}

	public static function getRate($data)
	{
		return self::makeRequest(
			"rates/percentage",
			"post",
			$data
		)->json()['data'];
	}

	public static function getTransformRates()
	{
		return self::makeRequest(
			"rates/formatted-rate",
			"get",
		)->json()['data'];
	}

	public static function getInvestmentHistory($data)
	{
		return self::makeRequest(
			"investments/history",
			"get",
			$data
		)->json();
	}
}

<?php

namespace Credpal\CPInvest;

use Credpal\CPInvest\Http\Requests\CreateInvestmentRequest;
use Credpal\CPInvest\Services\InvestService;

class CPInvest
{
    public function create(array $data)
    {
        return InvestService::createInvestment($data);
    }

    public function getAllUserInvestments($data)
    {
        return InvestService::getAllUserInvestments($data);
    }

    public function getUserActiveInvestments($data)
    {
        return InvestService::getUserActiveInvestments($data);
    }

    public function getInvestmentDetails($data)
    {
        return InvestService::getInvestmentDetails($data);
    }

    public function getInvestmentTransactions($data)
    {
        return InvestService::getInvestmentTransactions($data);
    }

    public function liquidateInvestment($data)
    {
        return InvestService::liquidateInvestment($data);
    }

    public function withdrawFunds($data)
    {
        return InvestService::withdrawFunds($data);
    }

    public function getTenures()
    {
        return InvestService::getInvestmentTenures();
    }

    public function requestOtp($data)
    {
        return InvestService::requestOtp($data);
    }

    public function getInvestmentTypes()
    {
        return InvestService::getInvestmentTypes();
    }

    public function getInvestmentTypeDetails($investmentTypeSlug)
    {
        return InvestService::getInvestmentTypeDetails($investmentTypeSlug);
    }

    public function getSummary($data)
    {
        return InvestService::getSummary($data);
    }

    public function getRate($data)
    {
        return InvestService::getRate($data);
    }

    public function getTransformRates()
    {
        return InvestService::getTransformRates();
    }

	public static function getAdminRates()
	{
		return InvestService::getAdminRates();
	}

	public static function updateAdminRates()
	{
		return InvestService::updateAdminRates();
	}

	public static function getAdminTenure()
	{
		return InvestService::getAdminTenure();
	}

	public static function updateAdminTenure()
	{
		return InvestService::updateAdminTenure();
	}

	public static function getAdminConfiguration()
	{
		return InvestService::getAdminConfiguration();
	}

	public static function updateAdminConfiguration($key, $data)
	{
		return InvestService::updateAdminConfiguration($key, $data);
	}

    public function getInvestmentHistory($data)
    {
        return InvestService::getInvestmentHistory($data);
    }
}

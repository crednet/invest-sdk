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
}

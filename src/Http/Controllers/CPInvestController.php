<?php

namespace Credpal\CPInvest\Http\Controllers;

use Credpal\CPInvest\Facade\CpInvest;
use Credpal\CPInvest\Http\Requests\CreateInvestmentRequest;
use Illuminate\Http\Request;

class CPInvestController extends Controller
{
    public function create(CreateInvestmentRequest $request)
    {
        $data = array_merge($request->validated(), [
            'user_id' => auth()->user()->id
        ]);

        return $this->successResponse(CpInvest::create($data));
    }

    public function getAllUserInvestments()
    {
        return $this->successResponse(CpInvest::getAllUserInvestments([
            'user_id' => auth()->user()->id
        ]));
    }

    public function getUserActiveInvestments()
    {
        return $this->successResponse(CpInvest::getUserActiveInvestments([
            'user_id' => auth()->user()->id
        ]));
    }

    public function getInvestmentDetails(string $investmentId)
    {
        return $this->successResponse(CpInvest::getInvestmentDetails([
            'user_id' => auth()->user()->id,
            'investment_id' => $investmentId
        ]));
    }

    public function getInvestmentTransactions(string $investmentId)
    {
        return $this->successResponse(CpInvest::getInvestmentTransactions([
            'user_id' => auth()->user()->id,
            'investment_id' => $investmentId
        ]));
    }

    public function liquidateInvestment(string $investmentId)
    {
        return $this->successResponse(CpInvest::liquidateInvestment([
            'user_id' => auth()->user()->id,
            'investment_id' => $investmentId
        ]));
    }
}

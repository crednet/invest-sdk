<?php

namespace Credpal\CPInvest\Http\Controllers;

use Credpal\CPInvest\Facade\CpInvest;
use Credpal\CPInvest\Http\Requests\CreateInvestmentRequest;
use Credpal\CPInvest\Http\Requests\LiquidateInvestmentRequest;
use Credpal\CPInvest\Http\Requests\WithdrawFundsRequest;
use Illuminate\Http\Request;

class CPInvestController extends Controller
{
    public function getTenures()
    {
        return $this->successResponse(CpInvest::getTenures());
    }

    public function create(CreateInvestmentRequest $request)
    {
        $data = array_merge($request->validated(), [
            'user_id' => auth()->user()->id,
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

    public function liquidateInvestment(LiquidateInvestmentRequest $request, string $investmentId)
    {
        $user = auth()->user();
        return $this->successResponse(CpInvest::liquidateInvestment([
            'user_id' => $user->id,
            'phone_no' => $user->phone_no,
            'investment_id' => $investmentId,
            'otp' => $request->otp,
            'wallet_id' => $request->wallet_id
        ]), "Investment Stopped");
    }

    public function withdrawFunds(WithdrawFundsRequest $request, string $investmentId)
    {
        $user = auth()->user();

        return $this->successResponse(CpInvest::withdrawFunds([
            'user_id' => $user->id,
            'investment_id' => $investmentId,
            'account_number' => $user->profile->account_no,
            'bank_code' => $user->profile->bank_name,
            'phone_no' => $user->phone_no,
            'otp' => $request->otp,
            'wallet_id' => $request->wallet_id
        ]), "Withdrawal Request Sent");
    }
}

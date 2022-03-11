<?php

namespace Credpal\CPInvest\Http\Controllers;

use Credpal\CPInvest\Models\Investment;
use Credpal\CPInvest\Facade\CpInvest;
use Credpal\CPInvest\Http\Requests\CreateInvestmentRequest;
use Credpal\CPInvest\Http\Requests\LiquidateInvestmentRequest;
use Credpal\CPInvest\Http\Requests\WithdrawFundsRequest;
use Credpal\CPInvest\Http\Requests\OtpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CPInvestController extends Controller
{
	public function getTenures()
	{
		return CpInvest::getTenures();
	}

	public function create(CreateInvestmentRequest $request)
	{
		$user = auth()->user();

		$data = array_merge($request->validated(), [
			'user_id' => $user['id'],
			'user' => [
				'name' => $user['name'],
				'email' => $user['email'],
			],
		]);

		return $this->successResponse(CpInvest::create($data));
	}

	public function getAllUserInvestments()
	{
		return CpInvest::getAllUserInvestments([
			'user_id' => auth()->user()->id
		]);
	}

	public function getUserActiveInvestments()
	{
		return CpInvest::getUserActiveInvestments([
			'user_id' => auth()->user()->id
		]);
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
		return CpInvest::getInvestmentTransactions([
			'user_id' => auth()->user()->id,
			'investment_id' => $investmentId
		]);
	}

	public function requestOtp(OtpRequest $request)
	{
		$user = auth()->user();

		return $this->successResponse(CpInvest::requestOtp([
			'user_id' => $user['id'],
			'recipient' => $user['phone_no'],
			'type' => $request['type'],
			'purpose' => $request['purpose'],
		]), "OTP send successfully");
	}

	public function liquidateInvestment(LiquidateInvestmentRequest $request, string $investmentId)
	{
		$user = auth()->user();
		return $this->successResponse(CpInvest::liquidateInvestment([
			'user_id' => $user['id'],
			'phone_no' => $user['phone_no'],
			'user' => [
				'name' => $user['name'],
				'email' => $user['email'],
			],
			'investment_id' => $investmentId,
			'otp' => $request['otp'],
			'wallet_id' => $request['wallet_id'],
		]), "Investment Stopped");
	}

	public function withdrawFunds(WithdrawFundsRequest $request, string $investmentId)
	{
		$user = auth()->user();

		return $this->successResponse(CpInvest::withdrawFunds([
			'user_id' => $user['id'],
			'investment_id' => $investmentId,
			'user' => [
				'name' => $user['name'],
				'email' => $user['email'],
			],
			'account_number' => $user['profile']['account_no'],
			'bank_code' => $user['profile']['bank_name'],
			'phone_no' => $user['phone_no'],
			'otp' => $request['otp'],
			'wallet_id' => $request['wallet_id'],
		]), "Withdrawal Request Sent");
	}

	public function getInvestmentTypes()
	{
		return CpInvest::getInvestmentTypes();
	}

	public function getInvestmentTypeDetails($investmentTypeSlug)
	{
		return CpInvest::getInvestmentTypeDetails($investmentTypeSlug);
	}

	public function activeInvestmentSummary()
	{
		return $this->successResponse(CpInvest::getSummary([
			'user_id' => auth()->user()->id
		]));
	}

	public function getRate(Request $request)
	{
		return $this->successResponse(CpInvest::getRate([
			'tenure_id' => $request->tenure_id,
			'amount' => $request->amount
		]));
	}

	public function webhook(Request $request)
	{
		// TODO: validate this request is coming from the expected source since authentication middle would be disable

		foreach ($request->input() as $investment)
		{
			Investment::updateOrCreate([
				'invest_investment_id' => $investment['id']
			], [
				'user_id' => $investment['user_id'],
				'name' => $investment['name'],
				'investment_type' => $investment['investment_type']['name'],
				'amount' => $investment['amount'],
				'liquidateable' => $investment['liquidateable'],
				'earnings' => $investment['earnings'],
				'days' => $investment['days'],
				'tax' => $investment['tax'],
				'percentage' => $investment['percentage'],
				'closing_at' => $investment['closing_at'],
				'liquidated_at' => $investment['liquidated_at'],
				'withdrew_at' => $investment['withdrew_at'],
				'active_at' => $investment['active_at'],
				'withdrawal_requested_at' => $investment['withdrawal_requested_at'],
				'status' => $investment['status'],
			]);
		}
		Log::debug("webhook controller called");

		exit(200);
	}

	public function getInvestmentHistory()
	{
		return CpInvest::getInvestmentHistory([
			'user_id' => auth()->user()->id
		]);
	}
}

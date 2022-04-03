<?php

namespace Credpal\CPInvest\Http\Controllers\Admin;

use Credpal\CPInvest\Http\Requests\UpdateConfigurationRequest;
use Credpal\CPInvest\Models\Investment;
use Credpal\CPInvest\Facade\CpInvest;
use Credpal\CPInvest\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CpInvestController extends Controller
{
	public function getAdminRates()
	{
		return CpInvest::getAdminRates();
	}

	public function updateAdminRates()
	{
		return CpInvest::updateAdminRates();
	}

	public function getAdminTenure()
	{
		return CpInvest::getAdminTenure();
	}

	public function updateAdminTenure()
	{
		return CpInvest::updateAdminTenure();
	}

	public function getAdminConfiguration()
	{
		return CpInvest::getAdminConfiguration();
	}

	public function updateAdminConfiguration(UpdateConfigurationRequest $request)
	{
		return CpInvest::updateAdminConfiguration(
			$request->input('key'),
			['value' => $request->input('value')]
		);
	}

	public function getAllInvestments(Request $request)
	{
		$searchString = $request->search;

		$investments = Investment::with('user');

		if ($searchString) {
			$investments = $investments->where(function($investment) use ($searchString) {
				$investment->where('name', 'like', "%{$searchString}%")
					->orWhere('invest_investment_id', 'like', "%{$searchString}%")
					->orWhereHas('user', function ($query) use ($searchString) {
						$query->whereRaw("CONCAT(users.name, ' ', users.last_name) like '%{$searchString}%'");
					});
			});
		}

		return $this->datatable($investments, [
			'filters' => $this->getInvestFiltersArray()
		]);
	}

	private function getInvestFiltersArray()
	{
		return [
			'running' => function($investment) {
				$investment->where('status', Investment::STATUS_RUNNING);
			},
			'liquidated' => function($investment) {
				$investment->where('status', Investment::STATUS_LIQUIDATED);
			},
			'withdrawn' => function($investment) {
				$investment->where('status', Investment::STATUS_WITHDRAWN);
			},
		];
	}
}

<?php

namespace Credpal\CPInvest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInvestmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'int', 'min:50000'],
            'name' => ['required', 'min:2',],
            'tenure_id' => ['required', 'string'],
            'wallet_id' => ['required', Rule::exists(config('cpinvest.credpal_cash_table'))->where('user_id', auth()->user()->id)]
        ];
    }
}

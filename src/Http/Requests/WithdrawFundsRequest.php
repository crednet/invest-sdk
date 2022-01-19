<?php

namespace Credpal\CPInvest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WithdrawFundsRequest extends FormRequest
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
            'otp' => 'required|digits:6',
            'wallet_id' => 'required'
        ];
    }
}
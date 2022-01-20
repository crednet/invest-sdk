<?php

namespace Credpal\CPInvest\Http\Requests;

use App\Models\OTP;
use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
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
            'type' => 'required|max:30|in:mobile,mail',
            'purpose' => 'required|max:50|in:liquidate_fund,withdraw_fund',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\GrossAmount;
use App\Rules\MidtransSignature;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentNotification extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "transaction_status" => [
                'required', Rule::in(['capture', 'settlement', 'pending', 'deny', 'cancel', 'expire', 'refund'])
            ],
            "merchant_id" => ['required', Rule::in([config('services.midtrans.merchant_id')])],
            "order_id" => 'required|exists:orders,code',
            'signature_key' => ['required', 'string', new MidtransSignature($this->all())],
            'gross_amount' => ['required', new GrossAmount($this->all())],
        ];
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MidtransSignature implements ValidationRule
{
    /**
     * @var
     */
    private $input;
    
    /**
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }
    
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $signature = hash('sha512', $this->input['order_id'].$this->input['status_code'].$this->input['gross_amount'].config('services.midtrans.server_key'));

        if ($signature != $value) {
            $fail('The :attribute not match.');
        }
    }
}

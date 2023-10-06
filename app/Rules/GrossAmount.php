<?php

namespace App\Rules;

use App\Models\Transaction;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GrossAmount implements ValidationRule
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
        $transaction = Transaction::where('code', $this->input['order_id'])->firstOrFail();

        if ((int) $transaction->total_price != (int) $value) {
            $fail('The :attribute not match.');
        }
    }
}

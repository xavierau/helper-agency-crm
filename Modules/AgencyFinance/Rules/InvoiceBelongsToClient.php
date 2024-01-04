<?php

namespace Modules\AgencyFinance\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\AgencyContract\Entities\Contract;

class InvoiceBelongsToClient implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {

        if($value === 'new' and request()->method() === 'POST') {
            return true;
        }

        $client_id = (request()->get('client'))['id'];

        return Contract::where('client_id',
                               $client_id)->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Please check the contract you picked';
    }
}

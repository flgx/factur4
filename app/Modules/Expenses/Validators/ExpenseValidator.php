<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Expenses\Validators;

use FI\Support\NumberFormatter;
use Validator;

class ExpenseValidator
{
    public function getValidator($input)
    {
        if (isset($input['amount']))
        {
            $input['amount'] = NumberFormatter::unformat($input['amount']);
        }

        return Validator::make($input, [
            'user_id'       => 'required',
            'expense_date'  => 'required',
            'category_name' => 'required',
            'description'   => 'max:255',
            'amount'        => 'required|numeric'
        ]);
    }
}
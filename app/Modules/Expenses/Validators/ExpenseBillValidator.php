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

use Validator;

class ExpenseBillValidator
{
    public function getValidator($input)
    {
        return Validator::make($input, [
            'invoice_id' => 'required',
            'item_name'  => 'required'
        ]);
    }
}
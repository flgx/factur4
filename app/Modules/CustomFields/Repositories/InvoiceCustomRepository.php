<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Repositories;

use FI\Modules\CustomFields\Models\InvoiceCustom;

class InvoiceCustomRepository
{
    public function save($input, $invoiceId)
    {
        $record = (InvoiceCustom::find($invoiceId)) ?: new InvoiceCustom;

        $record->invoice_id = $invoiceId;

        $record->fill($input);

        $record->save();

        return $record;
    }

    public function delete($id)
    {
        InvoiceCustom::destroy($id);
    }
}
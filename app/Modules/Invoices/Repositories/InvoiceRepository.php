<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Repositories;

use DB;
use FI\Events\InvoiceCreated;
use FI\Events\InvoiceModified;
use FI\Modules\CustomFields\Repositories\InvoiceCustomRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Models\Invoice;
use FI\Support\BaseRepository;
use FI\Support\DateFormatter;
use FI\Support\NumberFormatter;
use FI\Support\Statuses\InvoiceStatuses;

class InvoiceRepository extends BaseRepository
{
    public function __construct(
        GroupRepository $groupRepository,
        InvoiceCustomRepository $invoiceCustomRepository,
        InvoiceItemRepository $invoiceItemRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository
    )
    {
        $this->groupRepository            = $groupRepository;
        $this->invoiceCustomRepository    = $invoiceCustomRepository;
        $this->invoiceItemRepository      = $invoiceItemRepository;
        $this->recurringInvoiceRepository = $recurringInvoiceRepository;
    }

    public function paginateByStatus($status = 'all', $keywords = null, $clientId = null)
    {
        return Invoice::select('invoices.*')
            ->join('clients', 'clients.id', '=', 'invoices.client_id')
            ->join('invoice_amounts', 'invoice_amounts.invoice_id', '=', 'invoices.id')
            ->with($this->with)
            ->status($status)
            ->keywords($keywords)
            ->clientId($clientId)
            ->sortable(['created_at' => 'desc', 'number' => 'desc'])
            ->paginate(config('fi.resultsPerPage'));
    }

    public function getRecent($limit)
    {
        return Invoice::has('amount')->with(['amount', 'client'])->orderBy('created_at', 'DESC')->limit($limit)->get();
    }

    public function getRecentOverdue($limit)
    {
        return Invoice::has('amount')->overdue()->with(['amount', 'client'])->orderBy('due_at')->limit($limit)->get();
    }

    public function find($id)
    {
        return Invoice::with($this->with)->find($id);
    }

    public function findIdByNumber($number)
    {
        if ($invoice = Invoice::where('number', $number)->first())
        {
            return $invoice->id;
        }

        return null;
    }

    public function findByUrlKey($urlKey)
    {
        return Invoice::where('url_key', $urlKey)->first();
    }

    public function create($input, $client, $unformat = true)
    {
        $groupId   = (isset($input['group_id'])) ? $input['group_id'] : config('fi.invoiceGroup');
        $createdAt = (isset($input['created_at'])) ? (($unformat == true) ? DateFormatter::unformat($input['created_at']) : $input['created_at']) : date('Y-m-d');
        $dueAt     = (isset($input['due_at'])) ? $input['due_at'] : DateFormatter::incrementDateByDays($createdAt, config('fi.invoicesDueAfter'));
        $summary   = (isset($input['summary']) ? $input['summary'] : '');
        $number    = (isset($input['number']) ? $input['number'] : $this->groupRepository->generateNumber($groupId));
        $discount  = (isset($input['discount']) ? $input['discount'] : 0);
        $terms     = (isset($input['terms']) ? $input['terms'] : config('fi.invoiceTerms'));
        $statusId  = (isset($input['invoice_status_id'])) ? $input['invoice_status_id'] : InvoiceStatuses::getStatusId('draft');

        $invoice = Invoice::create(
            ['client_id'         => $client->id,
             'created_at'        => $createdAt,
             'due_at'            => $dueAt,
             'group_id'          => $groupId,
             'number'            => $number,
             'user_id'           => $input['user_id'],
             'invoice_status_id' => $statusId,
             'terms'             => $terms,
             'footer'            => config('fi.invoiceFooter'),
             'currency_code'     => $client->currency_code,
             'exchange_rate'     => '',
             'template'          => $client->invoice_template,
             'summary'           => $summary,
             'discount'          => $discount
            ]
        );

        event(new InvoiceCreated($invoice));

        if (isset($input['recurring']) and $input['recurring'] == 1)
        {
            $this->recurringInvoiceRepository->create($input, $invoice->id);
        }

        return $invoice;
    }

    public function update($input, $id)
    {
        $custom = (array)json_decode($input['custom']);

        unset($input['custom']);

        $invoiceInput = [
            'number'            => $input['number'],
            'created_at'        => DateFormatter::unformat($input['created_at']),
            'due_at'            => DateFormatter::unformat($input['due_at']),
            'invoice_status_id' => $input['invoice_status_id'],
            'terms'             => $input['terms'],
            'footer'            => $input['footer'],
            'currency_code'     => $input['currency_code'],
            'exchange_rate'     => $input['exchange_rate'],
            'template'          => $input['template'],
            'summary'           => $input['summary'],
            'discount'          => NumberFormatter::unformat($input['discount'])
        ];

        $invoice = Invoice::find($id);

        $invoice->fill($invoiceInput);

        $invoice->save();

        $this->invoiceCustomRepository->save($custom, $id);

        $this->invoiceItemRepository->saveItems(
            json_decode($input['items'], true),
            isset($input['apply_exchange_rate']),
            $input['exchange_rate']
        );

        event(new InvoiceModified($invoice));

        return $invoice;
    }

    public function updateRaw($input, $id)
    {
        $invoice = Invoice::find($id);

        $invoice->fill($input);

        $invoice->save();

        return $invoice;
    }

    public function delete($id)
    {
        Invoice::destroy($id);
    }
}
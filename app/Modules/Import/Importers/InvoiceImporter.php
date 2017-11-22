<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Import\Importers;

use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\Invoices\Validators\InvoiceValidator;
use FI\Support\DateFormatter;
use FI\Support\Statuses\InvoiceStatuses;
use Validator;

class InvoiceImporter extends AbstractImporter
{
    public function __construct(
        ClientRepository $clientRepository,
        GroupRepository $groupRepository,
        InvoiceRepository $invoiceRepository,
        InvoiceValidator $invoiceValidator
    )
    {
        $this->clientRepository  = $clientRepository;
        $this->groupRepository   = $groupRepository;
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceValidator  = $invoiceValidator;
    }

    public function getFields()
    {
        return [
            'created_at'        => '* ' . trans('fi.date'),
            'client_name'       => '* ' . trans('fi.client_name'),
            'number'            => '* ' . trans('fi.invoice_number'),
            'group_id'          => trans('fi.group'),
            'invoice_status_id' => trans('fi.status'),
            'due_at'            => trans('fi.due_date'),
            'summary'           => trans('fi.summary'),
            'terms'             => trans('fi.terms_and_conditions')
        ];
    }

    public function getMapRules()
    {
        return [
            'created_at'  => 'required',
            'client_name' => 'required',
            'number'      => 'required'
        ];
    }

    public function getValidator($input)
    {
        return $this->invoiceValidator->getRawValidator($input);
    }

    public function importData($input)
    {
        $row = 1;

        $fields = [];

        foreach ($input as $field => $key)
        {
            if (is_numeric($key))
            {
                $fields[$key] = $field;
            }
        }

        try
        {
            $handle = fopen(storage_path('invoices.csv'), 'r');
        }

        catch (\ErrorException $e)
        {
            $this->messages->add('error', 'Could not open the file');

            return false;
        }

        while (($data = fgetcsv($handle, 1000, ',')) !== false)
        {
            if ($row !== 1)
            {
                $record = [];

                // Create the initial record from the file line
                foreach ($fields as $key => $field)
                {
                    $record[$field] = $data[$key];
                }

                // Replace the client name with the client id
                $client = $this->clientRepository->firstOrCreate($record['client_name']);

                $record['client_id'] = $client->id;

                unset($record['client_name']);

                // Format the created at date
                if (strtotime($record['created_at']))
                {
                    $record['created_at'] = date('Y-m-d', strtotime($record['created_at']));
                }
                else
                {
                    $record['created_at'] = date('Y-m-d');
                }

                // Attempt to format this date if it exists
                // Otherwise generate date based on config setting
                if (isset($record['due_at']) and strtotime($record['due_at']))
                {
                    $record['due_at'] = date('Y-m-d', strtotime($record['due_at']));
                }
                else
                {
                    $record['due_at'] = DateFormatter::incrementDateByDays($record['created_at'], config('fi.invoicesDueAfter'));
                }

                // Attempt to convert the group name to an id
                // Otherwise default to default id from config setting
                if (isset($record['group_id']))
                {
                    if (!$record['group_id'] = $this->groupRepository->findIdByName($record['group_id']))
                    {
                        $record['group_id'] = config('fi.invoiceGroup');
                    }
                }
                else
                {
                    $record['group_id'] = config('fi.invoiceGroup');
                }

                // Assign the invoice to the current logged in user
                $record['user_id'] = auth()->user()->id;

                // If a proper quote status ID has not been provided, default to draft
                if (!isset($record['invoice_status_id']) or !key_exists($record['invoice_status_id'], InvoiceStatuses::statuses()))
                {
                    $record['invoice_status_id'] = InvoiceStatuses::getStatusId('draft');
                }

                // Default the footer
                $record['footer'] = config('fi.invoiceFooter');

                // The record *should* validate, but just in case...
                if ($this->validateRecord($record))
                {
                    $this->invoiceRepository->create($record, $client, false);
                }
            }
            $row++;
        }

        fclose($handle);

        return true;
    }
}
<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Repositories;

use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\Clients\Models\Client;
use FI\Support\CurrencyFormatter;
use FI\Support\NumberFormatter;
use FI\Support\DateFormatter;

class TaxSummaryReportRepository
{

    public function getResults($fromDate, $toDate)
    {ini_set("display_errors","true");error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	set_time_limit(180);
	
        $results = [];
		$sumatorios = [];
		$totfac = 0 ;
		$nrofac = '';
        $invoices = Invoice::with([ 'client','amount','items.taxRate', 'items.taxRate2', 'items.amount'])->where('created_at', '>=', $fromDate)->where('created_at', '<=', $toDate)->get();
		
        foreach ($invoices as $invoice)
        {
			if (!($nrofac == $invoice->number)){	
				$nrofac = $invoice->number;
				$results[$nrofac]['tot'] = 0; 
			}
			
			$results[$nrofac]['fecha'] = DateFormatter::format($invoice->created_at);
			$results[$nrofac]['name'] = $invoice->client->name;
			$results[$nrofac]['dni'] = $invoice->client->dni;
			$results[$nrofac]['subtotal'] = CurrencyFormatter::format($invoice->amount->subtotal);
			
            foreach ($invoice->items as $invoiceItem)
            {
				$precio = $invoiceItem->price;
				$cantid = $invoiceItem->quantity;
				$totfac = $precio * $cantid ;
				$results[$nrofac]['tot'] += $totfac;
                if ($invoiceItem->tax_rate_id)
                {
                    $key ='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $invoiceItem->taxRate->name . ' (' . NumberFormatter::format($invoiceItem->taxRate->percent, null, 3) . '%)';
					
					$amount_tax = $invoiceItem->amount->tax_1;
					if($invoiceItem->amount->tax_1 == 0 && $invoiceItem->amount->tax != 0)
						$amount_tax = $invoiceItem->amount->tax;
                    if (isset($results[$nrofac]['txs'][$key]['taxable_amount']))
                    {
                        $results[$nrofac]['txs'][$key]['taxable_amount'] += $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        $results[$nrofac]['txs'][$key]['taxes'] += $amount_tax / $invoice->exchange_rate;
						$results[$nrofac]['tot'] += $amount_tax / $invoice->exchange_rate; // Edx
                    }
                    else
                    {
                        $results[$nrofac]['txs'][$key]['taxable_amount'] = $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        $results[$nrofac]['txs'][$key]['taxes']          = $amount_tax / $invoice->exchange_rate;
						$results[$nrofac]['tot'] += $amount_tax / $invoice->exchange_rate; //Edx
                    }
					
                }

                if ($invoiceItem->tax_rate_2_id)
                {
                    $key ='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $invoiceItem->taxRate2->name . ' (' . NumberFormatter::format($invoiceItem->taxRate2->percent, null, 3) . '%)';

                    if (isset($results[$nrofac]['txs'][$key]['taxable_amount']))
                    {
                        if ($invoiceItem->taxRate2->is_compound)
                        {
                            $results[$nrofac]['txs'][$key]['taxable_amount'] += ($invoiceItem->amount->subtotal + $invoiceItem->amount->tax_2) / $invoice->exchange_rate;
                        }
                        else
                        {
                            $results[$nrofac]['txs'][$key]['taxable_amount'] += $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        }

                        $results[$nrofac]['txs'][$key]['taxes'] += $invoiceItem->amount->tax_2 / $invoice->exchange_rate;
						$results[$nrofac]['tot'] += $invoiceItem->amount->tax_2 / $invoice->exchange_rate; //Edx
                    }
                    else
                    {
                        if ($invoiceItem->taxRate2->is_compound)
                        {
                            $results[$nrofac]['txs'][$key]['taxable_amount'] = ($invoiceItem->amount->subtotal + $invoiceItem->amount->tax_2) / $invoice->exchange_rate;
                        }
                        else
                        {
                            $results[$nrofac]['txs'][$key]['taxable_amount'] = $invoiceItem->amount->subtotal / $invoice->exchange_rate;
                        }

                        $results[$nrofac]['txs'][$key]['taxes'] = $invoiceItem->amount->tax_2 / $invoice->exchange_rate;
						$results[$nrofac]['tot'] += $invoiceItem->amount->tax_2 / $invoice->exchange_rate; //Edx
                    }
					
                }
				
            }
			$results[$nrofac]['tot'] = CurrencyFormatter::format($results[$nrofac]['tot']);
			$results[$nrofac]['sumTax'] = 0;
			if (isset($results[$nrofac]['txs']))
			{
				foreach ($results[$nrofac]['txs'] as $key => $result)
				{ 
					if(isset($sumatorios[$key]))
					{
						$sumatorios[$key]['base'] += $result['taxable_amount'];
						$sumatorios[$key]['tax'] += $result['taxes'];
					}
					else
					{
					
						$sumatorios[$key]['base'] = $results[$nrofac]['txs'][$key]['taxable_amount'];
						$sumatorios[$key]['tax'] = $results[$nrofac]['txs'][$key]['taxes'];
					} 
					 $results[$nrofac]['txs'][$key]['taxable_amount'] = CurrencyFormatter::format($result['taxable_amount']);
					 $results[$nrofac]['txs'][$key]['taxes'] = CurrencyFormatter::format($result['taxes']);
					 $results[$nrofac]['txs'][$key]['total'] = CurrencyFormatter::format($result['taxable_amount']+$result['taxes']);
					 $results[$nrofac]['sumTax'] += $result['taxes'];
				}
			}
			$results[$nrofac]['sumTax'] = CurrencyFormatter::format($results[$nrofac]['sumTax']);
        }
		
		foreach($sumatorios as $key => $result)
		{
			$sumatorios[$key]['base'] = CurrencyFormatter::format($result['base']);
			$sumatorios[$key]['tax'] = CurrencyFormatter::format($result['tax']);
			$sumatorios[$key]['total'] = CurrencyFormatter::format($result['base']+$result['tax']);
		}
				
        return array('facturas' => $results, 'sumatorios' => $sumatorios);
    }
}
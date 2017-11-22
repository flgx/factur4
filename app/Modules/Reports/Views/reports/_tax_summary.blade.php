@extends('reports.layouts.master')

@section('content')


<h1 style="text-align: center;">{{ trans('fi.tax_summary') }}</h1>

<table class="alternate">

    <thead>
    <tr>
        <th style="width: 40%;" >{{ trans('fi.tax_rate') }}</th>
        <th class="amount" style="width: 20%;">{{ trans('fi.taxable_amount') }}</th>
        <th class="amount" style="width: 20%;">{{ trans('fi.taxes') }}</th>
        <th class="amount" style="width: 20%;">{{ trans('fi.total') }}</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($results['facturas'] as $nrofac => $detall)

		<tr>
			<td class="b_blanco"><strong>{{ $nrofac }}</strong> - {{ $detall['fecha'] }}</td>
			<td colspan="3" class="amount b_blanco">{{ $detall['name'] }} ({{ $detall['dni'] }})</td>
		</tr>

	<?php if (isset($detall['txs'])){?>
        @foreach ($detall['txs'] as $taxRate => $result)
    		<tr>
        		<td class="b_blanco">{{ $taxRate }}</td>
        		<td class="amount b_blanco">{{ $result['taxable_amount'] }}</td>
        		<td class="amount b_blanco">{{ $result['taxes'] }}</td>
				<td class="amount b_blanco">{{ $result['total'] }}</td>
    		</tr>
    	@endforeach
 	<?php } ?>
		<tr>
			<td class="b_gris amount">Totales Factura:</td>
			<td class="b_gris amount">{{ $detall['subtotal'] }}</td>
			<td class="b_gris amount">{{ $detall['sumTax'] }}</td>
			<td class="b_gris amount">{{ $detall['tot'] }}</td>
		</tr>
   
    @endforeach
	<tr>
        <td class="b_blanco" colespan="4">&nbsp;</td>
    </tr>
	<tr>
        <td class="b_blanco" colespan="4"><strong>{{ trans('TOTALES') }}</strong></td>
    </tr>
	 @foreach ($results['sumatorios']  as $taxRate => $result)
	<tr>
		<td class="b_blanco">{{ $taxRate }}</td>
		<td class="amount b_blanco">{{ $result['base'] }}</td>
		<td class="amount b_blanco">{{ $result['tax'] }}</td>
		<td class="amount b_blanco">{{ $result['total'] }}</td>
	</tr>
    @endforeach
	
	 </tbody>

</table>
<style>
.b_gris{background-color:#f5f5f5 !important;}
.b_blanco{background-color:#ffffff !important;}
</style>
@stop
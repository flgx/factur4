<?php
$url="http://".$_SERVER['HTTP_HOST'].'/sateii/';
$tfilas = 25; // Cantidad de filas Máxima por factura
$tipmod = '€';
$totiva=0;
$detalle = array();
$kiva = array(2 => 0, 1 => 1, 3 => 2, 0 => 0 );  // Iva Key Array  CLAVES
$tiva = array(0 => 0, 1 => 10, 2 => 21); // Según tabla tax_rates  VALORES
$totiva = array(0 => 0, 1 => 0, 2 => 0);
$impiva = array(0 => 0, 1 => 0, 2 => 0);
$fecha = trim($invoice->formatted_created_at);
$nrofac =    trim($invoice->number);
$nombreusr = trim($invoice->user->company);
$nombrecli = trim($invoice->client->name);
$i=0; $totconiva = 0; $totsiniva = 0;
foreach ($invoice->items as $item){
$detalle[$i][0] = substr(trim($item->name),0,50);   //Descripcion
$detalle[$i][1] = number_format($item->quantity,0);  // Cantidad
$detalle[$i][2] = number_format($item->price,2);  // Precio Unitario
$idx=$kiva[$item->tax_rate_id];
$detalle[$i][3] = number_format($tiva[$idx],2).' %'; // Iva Porcentaje
$detalle[$i][4] = number_format($item->quantity*$item->price,2); // Importe sin Iva
$detalle[$i][5] = number_format(($tiva[$idx]*$item->quantity*$item->price)/100,2); // Iva
$impiva[$idx] += number_format($item->quantity*$item->price,2);
$totiva[$idx] += number_format(($tiva[$idx]*$item->quantity*$item->price)/100,2);
$totconiva += number_format($item->quantity*$item->price,2)+number_format(($tiva[$idx]*$item->quantity*$item->price)/100,2);
$totsiniva += number_format($item->quantity*$item->price,2);
$i++;
}
/*foreach ($invoice->summarized_taxes as $tax){
    $base[intval(substr($tax->percent,0,-5))] = number_format((trim($tax->total,$tipmod)*100)/substr($tax->percent,0,-5),2).$tipmod;
}*/
$max = sizeof($detalle); // Maxima linea de detalles

?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ trans('fi.invoice') }} #{{ $invoice->number }}</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            color: #001028;
            background: #FFFFFF;
            font-family: sans-serif;
            font-size: 12px;
            margin-bottom: 50px;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        h1 {
            color: #5D6975;
            font-size: 2.8em;
            line-height: 1.4em;
            font-weight: bold;
            margin: 0;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th {
            padding: 5px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        td {
            padding: 10px;
        }

        table.alternate tr:nth-child(odd) td {
            background: #F5F5F5;
        }

        th.amount, td.amount {
            text-align: right;
        }

        .info {
            color: #5D6975;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            height: 50px;
            width: 100%;
            bottom: 0px;
            text-align: center;
        }

    </style>
</head>
<body>


<table>
    <tr>
        <td style="width: 50%;" valign="top">
            <h1>{{ mb_strtoupper(trans('fi.invoice')) }}</h1>
            <span class="info">{{ mb_strtoupper(trans('fi.invoice')) }} #</span>{{ $invoice->number }}<br>
            <span class="info">{{ mb_strtoupper(trans('fi.issued')) }}</span> {{ $invoice->formatted_created_at }}<br>
            <span class="info">{{ mb_strtoupper(trans('fi.due_date')) }}</span> {{ $invoice->formatted_due_at }}<br><br>
            <span class="info">{{ mb_strtoupper(trans('fi.bill_to')) }}</span><br>{{ $invoice->client->name }}<br>
            @if ($invoice->client->address) {!! $invoice->client->formatted_address !!}<br>@endif
        </td>
        <td style="width: 50%; text-align: right;" valign="top">
            {!! $logo !!}<br>
            {{ $invoice->user->company }}<br>
            {!! $invoice->user->formatted_address !!}<br>
            @if ($invoice->user->phone) {{ $invoice->user->phone }}<br>@endif
            @if ($invoice->user->email) <a
                    href="mailto:{{ $invoice->user->email }}">{{ $invoice->user->email }}</a>@endif
        </td>
    </tr>
</table>

<table class="alternate">
    <thead>
    <tr>
        <th>{{ mb_strtoupper(trans('fi.product')) }}</th>
        <th>{{ mb_strtoupper(trans('fi.description')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('fi.quantity')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('fi.price')) }}</th>
        <th class="amount">{{ mb_strtoupper(trans('fi.total')) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->items as $item)
        <tr>
            <td>{!! $item->name !!} </td>
            <td>{!! $item->formatted_description !!}</td>
            <td nowrap class="amount">{{ $item->formatted_quantity }}</td>
            <td nowrap class="amount">{{ $item->formatted_price }}</td>
            <td nowrap class="amount">{{ $item->amount->formatted_subtotal }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.subtotal')) }}</td>
        <td class="amount">{{ $invoice->amount->formatted_subtotal }}</td>
    </tr>

    @if ($invoice->discount > 0)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.discount')) }}</td>
            <td class="amount">{{ $invoice->amount->formatted_discount }}</td>
        </tr>
    @endif

    @foreach ($invoice->summarized_taxes as $tax)
        <tr>
            <td colspan="4" class="amount">{{ mb_strtoupper($tax->name) }} ({{ $tax->percent }})</td>
            <td class="amount">{{ $tax->total }}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.total')) }}</td>
        <td class="amount">{{ $invoice->amount->formatted_total }}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.paid')) }}</td>
        <td class="amount">{{ $invoice->amount->formatted_paid }}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{ mb_strtoupper(trans('fi.balance')) }}</td>
        <td class="amount">{{ $invoice->amount->formatted_balance }}</td>
    </tr>
    </tbody>
</table>

@if ($invoice->terms)
    <table style="margin-top: 50px;">
        <tr>
            <th>{{ mb_strtoupper(trans('fi.terms_and_conditions')) }}</th>
        </tr>
        <tr>
            <td>{!! $invoice->formatted_terms !!}</td>
        </tr>
    </table>
@endif

<div class="footer">
    <span style="font-size:10px; color:#CCC;">De conformidad amb el disposat per la Llei Orgánica 15/1999, de 13 de desembre, de Protecció de Dades de carácter presonal, domo permis permis a que les meves dades siguin incorporades en un fitxer responsabilitat de SATE SERVEIS ASISSTENCIALS i que sigui tractades amb la finalitat de mantenir, desenvolupar i controlar la relació contractual. Aixi mateix, declaro haver estat informat sobre la possiblitat d'erercir els drets d'accés, rectificació, cancel lació i oposició, dirigint-me a SATE SERVEIS ASISSTENCIALS al carrer moncada n°9 planta 3 porta2 de Tortosa; o bé remetent un missatge de correu electrónic a info@globals.cat
    </span>
    <img src="http://factura.sateserveisassistencials.com/custom/templates/invoice_templates/images/piepag.jpg">
</div>

</body>
</html>
<?php
$url="http://".$_SERVER['HTTP_HOST'];
$tfilas = 20; // Cantidad de filas Máxima por factura
$tipmod = '€';
$totiva=0;
$detalle = array();
$kiva = array(2 => 0, 1 => 1, 3 => 2, 0 => 0 );  // Iva Key Array  CLAVES
$tiva = array(0 => 0, 1 => 10, 2 => 21); // Según tabla tax_rates  VALORES
$totiva = array(0 => 0, 1 => 0, 2 => 0);
$impiva = array(0 => 0, 1 => 0, 2 => 0);
$fecha = trim($invoice->formatted_created_at);
$nrofac = 	 trim($invoice->number);
$nombreusr = trim($invoice->user->company);
$nombrecli = trim($invoice->client->name);
$i=0; $totconiva = 0; $totsiniva = 0;
foreach ($invoice->items as $item){
$detalle[$i][0] = substr(trim($item->name),0,50);	//Descripcion
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
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SATE Factura Plantilla</title>
</head>
<style>
@page {size: A4;
  margin: 12mm 12mm 6mm 12mm;
}
@media screen {
  html, body {
    width: 210mm;
    height: 297mm;
	margin: 6mm auto 6mm auto;
  }
  /* ... the rest of the rules ... */
}

div.chapter, div.appendix {
  page-break-after: always;
}
div.titlepage {
  page: blank;
}

body {
	}

#menu { display: none; }
 
#wrapper, #content {
 width: auto;
 border: 0;
 margin: 0 5%;
 padding: 0;
 float: none !important;
 }
h2,h4{
	color:#00AEC2;
	-webkit-margin-before: 0em;
    -webkit-margin-after: 0em;
}
addrss{
	color:#F4F4F4;
}

table {
	border-collapse: collapse;
	
		 }
tbody{
	border:solid 2px;
	border-color:#FFF}
#cabdet{
	border:solid;
	border-color:#FFF
	padding: 8px;     background: #428798;     border-bottom: 1px solid #fff;
    color: #fff;    border-top: 1px solid transparent;
	border-left: 1px solid transparent; border-right: 1px solid transparent;
	}
#detall{
	border:solid;
	border-color:#FFF;
	padding: 10px;
	border-bottom-color:#F4F4F4;
    border-top: 1px solid transparent;
	border-left: 1px solid transparent; border-right: 1px solid transparent;
	}
.mayus{
	text-transform:uppercase;
}
.itmdet{
	border-bottom: 1px solid #F4F4F4; border-right: 2px solid transparent;
	border-left: 2px solid transparent; border-right: 2px solid transparent;
}
.watermark
{	position: absolute;
 	float:left;
 	opacity:0.1;
 	z-index:99;
 	color:white;
	padding-top: 490px;
	margin-left:-10px;
}
</style>
<body >

    <div class="watermark">
      <img src="http://factura.sateserveisassistencials.com/custom/templates/invoice_templates/images/app.png">
    </div>
<table width="95%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" rowspan="2">{!! $logo !!}</td>
    <td width="10%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="9%">&nbsp;</td>
    <td width="13%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" valign="bottom"><h2>Factura</h2></td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" align="right" valign="middle"><?=$nrofac?></td>
  </tr>

  <tr>
    <td colspan="5" class="mayus" ><h4><?=$nombreusr?></h4></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" align="right" valign="middle"><?=$nombrecli?></td>
  </tr>
  <tr>
    <td colspan="4" rowspan="2" align="left" valign="top" style="color:#CCC"><span>{!! $invoice->user->formatted_address !!}
    </span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" align="right" valign="top"  style="color:#CCC"><span>@if ($invoice->client->address) {!! $invoice->client->formatted_address !!}
@endif 
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" align="left" valign="middle"><strong>Data:&nbsp;<?=$fecha?></strong></td>
    <td>&nbsp;</td>
    <td colspan="6" rowspan="2" align="left" valign="middle">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" valign="middle">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="12">
    <table width="100%" height="33" border="2" cellpadding="0" cellspacing="0" id="cabdet">
      <tr>
      	<td width="45%"><span >&nbsp;&nbsp;&nbsp;Descripción</span></td>
        <td width="5%"  align="center" valign="middle">Qtat</td>
        <td width="10%"  align="center" valign="middle">Preu</td>
        <td width="7%"  align="center" valign="middle">Tipo<br> IVA</td>
        <td width="12%"  align="center" valign="middle">Importe<br> sin IVA </td>
        <td width="9%"  align="center" valign="middle">IVA</td>
        <td width="12%"  align="right" valign="middle">Importe<br> con IVA</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="12">
      <table width="100%"  border="0" cellpadding="2px" cellspacing="0" style="font-size:12px"> 
       <?php $j=$tfilas; // Hasta ocho lineas de detalle
	   //for ($i = 1; $i <= 5; $i++) { $j--;
	   foreach ($detalle as $valor) {$j--?>
      	<tr>
      	<td width="45%" ><span >&nbsp;&nbsp;&nbsp;<?=$valor[0]?></span></td>
        <td width="5%" align="center" valign="middle" >
			<?=$valor[1]?></td>
        <td width="10%" align="right" valign="middle" >
			<?=$valor[2]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td width="7%"  align="center" valign="middle"><?=$valor[3]?></td>
        <td width="12%"  align="right" valign="middle"><?=$valor[4]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td width="9%"  align="right" valign="middle"><?=$valor[5]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td width="12%" align="right" valign="middle">
			<?=$valor[4]+$valor[5]?>&nbsp;<?=$tipmod?>&nbsp;</td>
      	</tr> 
  		<?php }?> 
      <?php for ($x = 1; $x <= $j; $x++) {?>
      	<tr >
      	  <td colspan="7" align="center" valign="middle" >&nbsp;</td>
   	    </tr>
	<?php }?>        
   	  </table>
      <table width="100%"  cellpadding="2px" cellspacing="0"> 

     </table> 
    </td>
  </tr>
  	<tr>
    <td colspan="12">&nbsp;
    </td>
    <tr>
    <td colspan="12">&nbsp;
    </td>
  </tr>
</table>

<table width="95%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="7" >&nbsp;</td>
      </tr>
      <tr>
        <td width="10%" rowspan="4" align="center" valign="middle" bgcolor="#428798" style="color:#FFF"><strong>IVA %</strong></td>
        <td width="15%" align="right" valign="middle" style="font-size:12px">IVA sobre <?=$tiva[0]?>&nbsp;%:</td>
        <td width="13%" align="right" valign="middle" style="font-size:12px"><?=$impiva[0]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td width="12%" align="right" valign="middle" style="font-size:12px"><?=$tiva[0]?>&nbsp;%</td>
        <td width="13%" align="right" valign="middle" style="font-size:12px"><?=number_format($totiva[0],2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td width="20%">&nbsp;</td>
        <td width="17%">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" style="font-size:12px">IVA sobre <?=$tiva[1]?>&nbsp;%:</td>
        <td align="right" valign="middle" style="font-size:12px"><?=$impiva[1]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td align="right" valign="middle" style="font-size:12px"><?=$tiva[1]?>&nbsp;%</td>
        <td align="right" valign="middle" style="font-size:12px"><?=number_format($totiva[1],2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle" style="font-size:12px">IVA sobre <?=$tiva[2]?>&nbsp;%:</td>
        <td align="right" valign="middle" style="font-size:12px"><?=$impiva[2]?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td align="right" valign="middle" style="font-size:12px"><?=$tiva[2]?>&nbsp;%</td>
        <td align="right" valign="middle" style="font-size:12px"><?=number_format($totiva[2],2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td bgcolor="#428798" style="color:#FFF"><strong>Total Factura sin IVA</strong></td>
        <td align="right" valign="middle" bgcolor="#CCCCCC"><?=number_format($totsiniva,2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle" bgcolor="#428798" style="color:#FFF"><strong>Totales</strong></td>
        <td align="right" valign="middle" bgcolor="#CCCCCC"><?=number_format($totsiniva,2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td align="right" valign="middle" bgcolor="#CCCCCC"><?=number_format(array_sum($totiva),2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
        <td bgcolor="#428798" style="color:#FFF"><strong>Total Factura con IVA</strong></td>
        <td align="right" valign="middle" bgcolor="#CCCCCC"><?=number_format($totconiva,2)?>&nbsp;<?=$tipmod?>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><span class="chapter" style="text-align:center; font-size:10px; color:#CCC;">De conformidad amb el disposat per la Llei Orgánica 15/1999, de 13 de desembre, de Protecció de Dades de carácter presonal, domo permis permis a que les meves dades siguin incorporades en un fitxer responsabilitat de SATE SERVEIS ASISSTENCIALS i que sigui tractades amb la finalitat de mantenir, desenvolupar i controlar la relació contractual. Aixi mateix, declaro haver estat informat sobre la possiblitat d'erercir els drets d'accés, rectificació, cancel lació i oposició, dirigint-me a SATE SERVEIS ASISSTENCIALS al carrer moncada n°9 planta 3 porta2 de Tortosa; o bé remetent un missatge de correu electrónic a info@globals.cat
    </span></td>
  </tr>
  <tr>
    <td><img src="custom/templates/invoice_templates/images/piepag.jpg"></td>
  </tr>
</table>
</body>
</html>
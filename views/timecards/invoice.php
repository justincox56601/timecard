<?php

include_once APPROOT . '/vendor/autoload.php';
$billTotal = 0;
$data['fakeAddress1'] = '1234 main St';
$data['fakeAddress2'] = 'Cityville ST, 12345';
$data['fakeemail'] = 'jane.doe@email.com';
$data['fakePhone'] = '123.456.7890';
$data['fakeInvoice'] = 1000;

$work = '';

foreach($data['hours'] as $d){
	$hours = $d->timeWorked / 3600;
	$total = $d->rate * $hours;
	$billTotal += $total;
	$work .= "<tr><td>$hours</td><td>$d->workDescription</td><td>$$d->rate</td><td>$$total</td></tr>";
}

//echo "<pre>";
//print_r($data);
//echo "</pre>";
get_template_part('header');
 
$html =
'<div class="invoice">
	<div class="contact-info">
		<p class="name">Justin Cox</p>
		<p class="address">2429 15th St NW<br>Bemidji, MN 56601<br>justin.cox@gmail.com<br>218.556.6054</p>
	</div>
	<div class="contact-info">
		<p class="name">'. $data["hours"][0]->name .'</p>
		<p class="address">
			'. $data["fakeAddress1"] .'<br>
			'. $data["fakeAddress2"] .'<br>
			'. $data["fakeemail"] .'<br>
			'. $data["fakePhone"] .'
		</p>
	</div>
	<div class="invoice-meta">
		<p>
			Invoice # '. $data["fakeInvoice"].'<br>
			Date: '. date("F j, Y", strtotime("now")) .'
		</p>
	</div>
	<div class="work">
		<table >
			<tr>
				<th>Hours</th><th>Description</th><th>Rate</th><th>Total</th>
			</tr>
			'. $work .'
			<tr><td class="bold">Total</td><td></td><td></td><td class="bold">$'. $billTotal .'</td></tr>
		</table>
	</div>
	<div class="closing">
		<p>
			Make all checks payable to Justin Cox.<br>If you have any questions concerning this invoice, contact Justin Cox.
		</p>
		<p>Thank you for your business.</p>
	</div>

</div>';

echo $html;
/*
$mpdf = new \Mpdf\Mpdf();



$stylesheet = file_get_contents(URLROOT . '/public/css/style.min.css');

$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);


$path = 'media/invoices' . '/' . $data["hours"][0]->name . '/' . date("F Y", strtotime("now"));


if(!is_dir($path)){
	mkdir($path, 0777, true);
}

$filename = $data['fakeInvoice'] . ' ' . $data["hours"][0]->name . ' ' . date("F j, Y", strtotime("now")) . '.pdf';
// Output a PDF file directly to the browser
$mpdf->Output($path . '/' . $filename, \Mpdf\Output\Destination::FILE);

*/



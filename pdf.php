<?php

$filename = 'test.html';
$content = file_get_contents($filename);

/*require_once('/home/alexandr/www/html/test/pie/TCPDF/tcpdf.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFont('dejavusans', '', 10);

$pdf->AddPage();
$html = $content;
//$pdf->writeHTML($content, true, false, true, false, '');
$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);

$pdf->Output('example_006.pdf', 'I');

// add a page
// $pdf->AddPage();
//
*/

require_once '/home/alexandr/www/html/dev-seodroid-ru/lib/mpdf/mpdf.php';

$style = file_get_contents('style.css');

$mpdf = new \mPDF();

@$mpdf->writeHTML($style,2);

$mpdf->writeHTML($content);
$mpdf->Output();
//*/


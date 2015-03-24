<?
require_once "fpdf/fpdf.php";

$textColour = array( 0, 0, 0 );
		
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
	$pdf->AddPage();
	$pdf->AddFont('ArialMT','B','arial.php');
	$pdf->SetFont('ArialMT','B',14);
	$pdf->Ln( $reportNameYPos );
	$pdf->Cell( 0, 15, "Îעקוע חא לוסÿצ ןמ נאבמעו ×Ï", 0, 0, 'C' );
	
	$pdf->Output( "report.pdf", "I" );
	

?>
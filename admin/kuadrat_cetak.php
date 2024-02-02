<?php

ob_start();
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Image('../Indihome.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'LAPORAN DATA HASIL PREDIKSI TREND KUADRAT',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : ',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Indonesia',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Source Code by',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Data Hasil Trend Kuadrat',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1.5, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Bulan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tahun', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Hasil', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'MSE', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'MAD', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'MAPE', 1, 0, 'C');
$pdf->ln();

$no=1;
include '../koneksi.php';

$query=mysqli_query($koneksi, "SELECT * FROM data_kuadrat");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1.5, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['bulan'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['tahun'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['hasil_kuadrat'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['mse'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['mad'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['mape'], 1, 0,'C');
	$pdf->ln();
	$no++;
}
$pdf->Output("laporan_trend_kuadrat.pdf","I");

?>
<?php
ob_start();
//include"../../koneksi.php";
require_once('tcpdf_include.php');
error_reporting(false);

class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
		$img_file = K_PATH_IMAGES.'/logo/image_demo.jpg';
		$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

class MYPDF2 extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		$img_file = dirname(__FILE__).'/images/c4.jpg';
		$this->Image($img_file, 0, 0, 105, 148, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

class MYPDF1 extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		$img_file = dirname(__FILE__).'/images/c1.jpg';
		$this->Image($img_file, 0, 0, 105, 148, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

$pdf = new MYPDF2('P', 'mm', 'A6', true, 'UTF-8', false);


/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 */

// Include the main TCPDF library (search for installation path).



// Extend the TCPDF class to create custom Header and Footer


// create new PDF document



// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hiro-Techno');
$pdf->SetTitle('ID CARD');
$pdf->SetSubject('ID CARD');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('times', '', 48);

// add a page
$pdf->AddPage();
$pag=$_GET['page']-1;
$offset=$pag*100;
$barcode=$_GET['barcode'];
//$query=mysqli_query($con,"SELECT * FROM peserta WHERE barcode=$barcode");

while ($row=mysqli_fetch_array($query)){
	$barcode=$barcode;
	$nik="NIK";
	$nama="NAMA";
	$jabatan="JABATAN";

	$html3='<div>
	<br><br><br><br><br><br>
		<table align="center">
			<tr>
				<th style="margin:100px"><font size="18">'.ucwords($nama).'</font></th>
			</tr>
			<br>
			<tr>
				<th><font size="15">'.ucwords($nik).'</font></th>
			</tr>
			<br>
			<tr>
				<th><font size="12">'.ucwords($jabatan).'</font></th>
			</tr>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br></div>
	';
	
	$pdf->writeHTML($html3, true, false, false, false, '');

	$stylebc = array(
		'position' => 'center',
		'align' => 'center',
		'stretch' => false,
		'fitwidth' => true,
		'cellfitalign' => '',
		'border' => false,
		'hpadding' => 'auto',
		'vpadding' => 'auto',
		'fgcolor' => array(0,0,0),
		'bgcolor' => false, //array(255,255,255),
		'text' => false,
		'font' => 'helvetica',
		'fontsize' => 6,
		'stretchtext' => 4,
		'margin' => auto,
	);

	// PRINT VARIOUS 1D BARCODES
	// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
	$pdf->write1DBarcode($barcode, 'C39', '11', '', '', 18, 0.4, $stylebc, 'N');
	$html4='<div>
	<br></div>
	';
	$pdf->writeHTML($html4, true, false, false, false, '');
}


// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>
//<p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:helvetica;font-weight:bold;font-size:26pt;">You can set a full page background.</p>';
//$pdf->writeHTML($html, true, false, true, false, '');


// add a page
//$pdf->AddPage();

// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 2&nbsp;</span>';
//$pdf->writeHTML($html, true, false, true, false, '');

// --- example with background set on page ---

// remove default header
$pdf->setPrintHeader(false);

// add a page
//$pdf->AddPage();


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
//$img_file = K_PATH_IMAGES.'image_demo.jpg';
//$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();


// Print a text
//$html = '<span style="color:white;text-align:center;font-weight:bold;font-size:80pt;">PAGE 3</span>';
//$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($barcode.'-'.$nama.'.pdf', 'D');
?>
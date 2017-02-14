<?php
	//require_once('tcpdf/config/tcpdf_config.php');
    require_once('tcpdf_include.php');


	class MYPDF extends TCPDF {
		public function Header() {
			
			$bMargin = $this->getBreakMargin();
		
			$auto_page_break = $this->AutoPageBreak;
		
			$this->SetAutoPageBreak(false, 0);
		
			$img_file = K_PATH_IMAGES.'KTAS.jpg';
			//$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
			$this->Image($img_file, 0, 0, 297, 420, '', '', '', false, 300, '', false, false, 0);
		
			$this->SetAutoPageBreak($auto_page_break, $bMargin);
		
			$this->setPageMark();
		}
	}


	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetTitle('Kartu Nama');


	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(0);
	$pdf->SetFooterMargin(0);

	$pdf->setPrintFooter(false);

	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	$pdf->SetFont('times', '', 48);

	//$pdf->AddPage();
	$pdf->AddPage('P', 'A3');



	$html = '';
	$pdf->writeHTML($html, true, false, true, false, '');

	$barcode = "123456789";

	/*$stylebc = array(
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
		'margin' => auto
	);
	$pdf->write1DBarcode($barcode, 'C39', '11', '', '', 18, 0.4, $stylebc, 'N');*/



	$pdf->Output('example_051.pdf', 'D');
?>
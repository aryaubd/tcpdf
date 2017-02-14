<?php
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
	$pdf->SetTitle('KTAS');


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

	$pdf->SetFont('times', '', 11);
	$pdf->AddPage('P', 'A3');

	$style = array(
		'position' => 'C',
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
		'stretchtext' => 4
	);


	$html 	= '<br/><br/><br/><br/>';
    $awal 	= $_GET["awal"]; //90001211;
    $akhir 	= $_GET["akhir"]; //90001974;
    $baris  = 1;
    $keluar = '';

    $banyak = 1;

    while ($awal <= $akhir)
    {
    	$keluar = '';
    	if($baris==1)
    	{
    		$html .= '<table border="0" width="100%">';
    		$html .= '<tr>';	
    	}
    	$html .= '<td style="">';
    	$params = $pdf->serializeTCPDFtagParameters(array($awal, 'C39', '14', '', '', 18, 0.4, $style, 'N'));
    	$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';

    	$kodenya = $awal - 1000;


    	$html .= '<span style="text-align:center;">KTA-S-'. substr($kodenya, -5) .'</span>';
    	$html .= '</td>';
    	if($baris==3)
    	{
    		$html .= '</tr>';
    		$html .= '</table>';

    		if($banyak == 3)
    		{
    			$html .= '<table><tr><td style="height:115px;"></td></tr></table>';
    		}
    		elseif($banyak == 6)
    		{
    			$html .= '<table><tr><td style="height:115px;"></td></tr></table>';
    		}
    		elseif($banyak == 9)
    		{
    			$html .= '<table><tr><td style="height:115px;"></td></tr></table>';
    		}
    		elseif($banyak == 12)
    		{
    			$html .= '<table><tr><td style="height:115px;"></td></tr></table>';
    		}
    		elseif($banyak == 15)
    		{
    			$html .= '<table><tr><td style="height:115px;"></td></tr></table>';
    		}
    		elseif($banyak == 18)
    		{
    			$html .= '<table><tr><td style="height:110px;"></td></tr></table>';
    		}
    		$baris=0;
    		$keluar = 'habis';
    	}

    	if($banyak==21)
    	{
    		$banyak = 0;
    		$pdf->writeHTML($html, true, false, true, false, '');
    		$html = '<br/><br/><br/><br/>';
    		$pdf->AddPage('P', 'A3');
    	}

    	$banyak++;
    	$baris++;
    	$awal++;
    }

    if($keluar=='')
    {
    	if($baris==2)
    	{
    		$html .= '<td></td><td></td>';
    	}
    	elseif($baris==3)
    	{
    		$html .= '<td></td>';	
    	}


    	$html .= '</tr>';
		$html .= '</table>';
    }

    $pdf->writeHTML($html, true, false, true, false, '');

	$pdf->Output('KTAS-'. $awal .' - ' . $akhir . '.pdf', 'I');
?>
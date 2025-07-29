<?php
/*
Yudha T. Putra
*/
require('../tcpdf/tcpdf.php');
$link = mysql_connect('localhost', 'root', 'F201603907');
		mysql_select_db('pmi');

	class MYPDF extends TCPDF {
	public function Header() {
	    $headerData = $this->getHeaderData();
	    $this->SetFont('helvetica', 'B', 10);
	    $this->writeHTML($headerData['string']);
	}
	}
	$pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
	$pdf->setHeaderData($ln='', $lw=0, $ht='', 
		$hs='DAFTAR USER SIMDONDAR<br>
			<table border="0.1" cellpadding="3" cellspacing="0">
				<tr>
					<th width="40px" align="center"><b>NO</b></th>
					<th width="100px" align="center"><b>ID USER</b></th>
					<th width="270px" align="center"><b>NAMA USER</b></th>
					<th width="100px" align="center"><b>NO. TELP</b></th>
				</tr>
			</table>', 
		$tc=array(0,0,0), $lc=array(0,0,0));
	// create new PDF document
	//$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
			
	// set document information
	$pdf->SetTitle('Daftar User SIMDONDAR');
	$pdf->SetSubject('Daftar User SIMDONDAR');
			
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, 16, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

	$pdf->SetFont('helvetica', 'B', 16);
	//$pdf->Write(0, 'DAFTAR USER SIMDONDAR', '', 0, 'C', true, 0, false, false, 0);
	//$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
			

			
	$pdf->SetFont('helvetica', '', 10);
			
	$sql = mysql_query("SELECT upper(`id_user`) as id_user,  upper(`nama_lengkap`) as nama_lengkap, `level`, `telp` FROM `user`");
			
			$tbl = <<<EOD
				<table border="0.1" cellpadding="2" cellspacing="0">
EOD;
			//end header kolom
						//isinya
			$no = 1;
			while ($isi = mysql_fetch_array($sql)) {
				$tbl.='
					<tr>
						<td width="40px" align="right">'.$no.'. '.'</td>
						<td width="100px">'.$isi[id_user].'</td>
						<td width="270px">'.$isi[nama_lengkap].'</td>
						<td width="100px">'.$isi[telp].'</td>';
					$tbl .='</tr>';
					$no++;
				}
			$tbl.='</table>';
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$namaPDF = 'Daftar User SIMDONDAR.pdf';
			$pdf->Output($namaPDF,'I');
?>

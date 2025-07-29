<?php
/*
Yudha T. Putra
*/

require('../tcpdf/tcpdf.php');
$link = mysql_connect('localhost', 'root', 'F201603907');
		mysql_select_db('pmi');
$tglawal 	= $_GET['tgl1'];
$harini 	= $_GET['tgl2'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
	public function Header() {
        $udd=mysql_fetch_assoc(mysql_query("SELECT `nama` FROM `utd` WHERE `aktif`='1'"));
        $namautd=$udd['nama'];
	    $headerData = $this->getHeaderData();
	    $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 10, ''.$namautd.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', '', 9);
        $this->Cell(0, 10, 'PENGGUNAAN REAGEN Cobas 6000', 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'B', 9);
	    $this->writeHTML($headerData['string']);
	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
    // create new PDF document
    //$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf = new MYPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setHeaderData($ln='', $lw=0, $ht='',
		$hs='',
		$tc=array(0,0,0), $lc=array(0,0,0));

			
	// set document information
	$pdf->SetTitle('Data Penggunaan Reagen Cobas 6000');
	$pdf->SetSubject('Data Penggunaan Reagen Cobas 6000');
			
	// set margins
    $pdf->SetMargins(20, 20, 20, true);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

	$pdf->SetFont('helvetica', 'B', 14);
	$pdf->Write(0, 'DATA PENGGUNAAN REAGENSIA Cobas 6000', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Write(0, 'Dari tanggal '.$tglawal.' s/d '.$harini, '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 8);

	$tbl = <<<EOD
                <br><table border="0.1" cellpadding="3" cellspacing="0">
                <tr style="background-color:Gainsboro">
                    <td rowspan="2" valign="center" align="center" width="25px">NO.</td>
			        <td rowspan="2" valign="center" align="center" width="100px">Tanggal</td>
			        <td colspan="3" width="150px" align="center">HBsAg</td>
                    <td colspan="3" width="150px" align="center">HCV</td>
                    <td colspan="3" width="150px" align="center">HIV</td>
                    <td colspan="3" width="150px" align="center">SYPHILIS</td>
		        </tr>
		        <tr style="background-color:Gainsboro">
			        <td align="center" width="50px">Control</td>
                    <td align="center" width="50px">Sample</td>
                    <td align="center" width="50px">Jumlah</td>
                    <td align="center" width="50px">Control</td>
                    <td align="center" width="50px">Sample</td>
                    <td align="center" width="50px">Jumlah</td>
                    <td align="center" width="50px">Control</td>
                    <td align="center" width="50px">Sample</td>
                    <td align="center" width="50px">Jumlah</td>
                    <td align="center" width="50px">Control</td>
                    <td align="center" width="50px">Sample</td>
                    <td align="center" width="50px">Jumlah</td>
                </tr>

EOD;
			//end header kolom
        $no=0;
        $ttl_sb="0";
        $ttl_sc="0";
        $ttl_si="0";
        $ttl_ss="0";
        $ttl_cb="0";
        $ttl_cc="0";
        $ttl_ci="0";
        $ttl_cs="0";
        $ttl_b="0";
        $ttl_c="0";
        $ttl_i="0";
        $ttl_s="0";
        $jml_b="0";
        $jml_c="0";
        $jml_i="0";
        $jml_s="0";
        //mysql_select_db('lis_pmi');
        //$sample=mysql_query("SELECT date(`run_time`) as tgl,
        //    sum(case when `sample_type`='S' and `parameter_no`='1' then 1 else 0 END) as s_b,
        //    sum(case when `sample_type`='S' and `parameter_no`='2' then 1 else 0 END) as s_c,
        //    sum(case when `sample_type`='S' and `parameter_no`='3' then 1 else 0 END) as s_i,
        //    sum(case when `sample_type`='S' and `parameter_no`='4' then 1 else 0 END) as s_s,
        //    sum(case when `sample_type`='C' and `parameter_no`='1' then 1 else 0 END) as c_b,
        //    sum(case when `sample_type`='C' and `parameter_no`='2' then 1 else 0 END) as c_c,
        //    sum(case when `sample_type`='C' and `parameter_no`='3' then 1 else 0 END) as c_i,
        //    sum(case when `sample_type`='C' and `parameter_no`='4' then 1 else 0 END) as c_s
         //   from cobas6000 WHERE date(`run_time`)>='$tglawal' AND date(`run_time`)<='$hariini' group by date(`run_time`)");
        $sample=mysql_query("select * from user");
        while($tmp=mysql_fetch_assoc($sample)){
            $no++;
            $ttl_sb=$ttl_sb+$tmp['s_b'];
            $ttl_sc=$ttl_sc+$tmp['s_c'];
            $ttl_si=$ttl_si+$tmp['s_i'];
            $ttl_ss=$ttl_ss+$tmp['s_s'];
            $ttl_cb=$ttl_cb+$tmp['c_b'];
            $ttl_cc=$ttl_cc+$tmp['c_c'];
            $ttl_ci=$ttl_ci+$tmp['c_i'];
            $ttl_cs=$ttl_cs+$tmp['c_s'];
            $ttl_b=$ttl_sb+$ttl_cb;
            $ttl_c=$ttl_sc+$ttl_cc;
            $ttl_i=$ttl_si+$ttl_ci;
            $ttl_s=$ttl_ss+$ttl_cb;
            $jml_b=$tmp['s_b'] + $tmp['c_b'];
            $jml_c=$tmp['s_c'] + $tmp['c_c'];
            $jml_i=$tmp['s_i'] + $tmp['c_i'];
            $jml_s=$tmp['s_s'] + $tmp['c_s'];
            $tgl=$tmp['tgl'];
            $crtl_b=$tmp['c_b'];    $crtl_c=$tmp['c_c'];    $crtl_i=$tmp['c_i'];    $crtl_s=$tmp['c_s'];
            $smp_b=$tmp['s_b'];     $smp_c=$tmp['s_c'];     $smp_i=$tmp['s_i'];     $smp_s=$tmp['s_s'];
        $tbl.='
		<tr>
		    <td align="right">'.$no.'</td>
			<td align="left">'.$tgl.'</td>
            <td align="right">'; $tbl.=number_format($crtl_b,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($smp_b,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($jml_b,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($crtl_c,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($smp_c,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($jml_c,0,'','.').'</td>';

            $tbl.='<td align="right">'; $tbl.=number_format($crtl_i,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($smp_i,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($jml_i,0,'','.').'</td>';

            $tbl.='<td align="right">'; $tbl.=number_format($crtl_s,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($smp_s,0,'','.').'</td>';
            $tbl.='<td align="right">'; $tbl.=number_format($jml_s,0,'','.').'</td>';


        $tbl.='</tr>';
	}
    $tbl.='
        <tr style="background-color:Gainsboro">
            <td colspan="2" align="left">TOTAL</td>

            <td width="50px" align="center">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>

            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>

            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>

            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>
            <td width="50px" align="right">TOTAL</td>
        </tr>';
    $tbl.='</table>';
	$pdf->writeHTML($tbl, true, false, false, false, '');
	$namaPDF = 'Data Reagen Cobas 6000.pdf';
	$pdf->Output($namaPDF,'I');
?>

<?php
require_once 'Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Dewo")
 ->setLastModifiedBy("Data Limbah")
 ->setTitle("Data Limbah")
 ->setSubject("Data Limbah")
 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
 ->setKeywords("office 2007 openxml php")
 ->setCategory("Test result file");
 
 // Create the worksheet
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()
 ->setCellValue('C10', "No")
 ->setCellValue('D10', "No Kantong")
 ->setCellValue('E10', "Gol Darah")
 ->setCellValue('F10', "Rhesus")
 ->setCellValue('G10', "Keterangan");
 
$server = "localhost";
$username = "root";
$password = "F201603907";
$db = "labor";

$koneksi = mysql_connect($server,$username,$password);
mysql_select_db($db, $koneksi) or die("Cannot connect to database..");

$cari=$_GET['cari'];
$SQL = mysql_query("select * FROM musnah where tanggal='$cari'");
 
$totJML = mysql_num_rows($SQL);
 
$dataArray= array();
$no=0;
while($row = mysql_fetch_array($SQL, MYSQL_ASSOC)){
 $no++;
 $row_array['no'] = $no;
 $row_array['kantong'] = $row['kantong'];
 $row_array['gol'] = $row['gol'];
 $row_array['rhesus'] = $row['rhesus'];
 $row_array['keterangan'] = $row['keterangan'];
 array_push($dataArray,$row_array);
}
$nox=$no+10;
$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'C11');

// Set page orientation and size
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set title row bold;
$objPHPExcel->getActiveSheet()->getStyle('C10:G10')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
$sharedStyle1 = new PHPExcel_Style();
$sharedStyle2 = new PHPExcel_Style();
 
$sharedStyle1->applyFromArray(
 array('borders' => array(
 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
 ),
 ));
 
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C10:G$nox");
 
// Set style for header row using alternative method
$objPHPExcel->getActiveSheet()->getStyle('C10:G10')->applyFromArray(
 array(
 'font' => array(
 'bold' => true
 ),
 'alignment' => array(
 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
 ),
 'borders' => array(
 'top' => array(
 'style' => PHPExcel_Style_Border::BORDER_THIN
 )
 ),
 'fill' => array(
 'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
 'rotation' => 90,
 'startcolor' => array(
 'argb' => 'FFA0A0A0'
 ),
 'endcolor' => array(
 'argb' => 'FFFFFFFF'
 )
 )
 )
);

// Merge cells
$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', "SURAT PENGANTAR");
$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
$objPHPExcel->getActiveSheet()->setCellValue('A2', "PEMUSNAHAN LIMBAH LABORATORIUM");
$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
$objPHPExcel->getActiveSheet()->setCellValue('A3', "UNIT DONOR DARAH PMI KOTA PEKANBARU");
$objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
$objPHPExcel->getActiveSheet()->setCellValue('A4', "KE INCENERATOR RUMAH SAKIT SANTA MARIA");
$objPHPExcel->getActiveSheet()->mergeCells('A5:H5');
$objPHPExcel->getActiveSheet()->setCellValue('A5', "No Surat : /UDD-PMI//");
$objPHPExcel->getActiveSheet()->mergeCells('A8:H8');
$objPHPExcel->getActiveSheet()->setCellValue('A8', "1. Darah donor yang rusak sebanyak kantong, terdiri dari :");
$objPHPExcel->getActiveSheet()->mergeCells('A292:D292');
$objPHPExcel->getActiveSheet()->setCellValue('A292', "2. Limbah infeksius lainnya :");
$objPHPExcel->getActiveSheet()->setCellValue('B293', "a. Jarum Kantong Aftap");
$objPHPExcel->getActiveSheet()->setCellValue('B294', "b. Jarum Blood Lancet");
$objPHPExcel->getActiveSheet()->setCellValue('B295', "c. Yellow Tip");
$objPHPExcel->getActiveSheet()->setCellValue('B296', "d. Selang Kantong Darah");
$objPHPExcel->getActiveSheet()->setCellValue('B297', "e. Spuit Sampel Pasien");
$objPHPExcel->getActiveSheet()->setCellValue('B298', "f. Lidi Pengaduk");
$objPHPExcel->getActiveSheet()->mergeCells('A300:H300');
$objPHPExcel->getActiveSheet()->setCellValue('A300', "Pekanbaru, ");
$objPHPExcel->getActiveSheet()->mergeCells('A302:B302');
$objPHPExcel->getActiveSheet()->setCellValue('A302', "Petugas Pengantar");
$objPHPExcel->getActiveSheet()->setCellValue('G302', "Supervisor Labor");
$objPHPExcel->getActiveSheet()->setCellValue('A305', "Faisal W. Siregar");
$objPHPExcel->getActiveSheet()->mergeCells('A305:B305');
$objPHPExcel->getActiveSheet()->setCellValue('G305', "Efrianita");
$objPHPExcel->getActiveSheet()->mergeCells('A307:G307');
$objPHPExcel->getActiveSheet()->setCellValue('A307', "Petugas Incenerator");
$objPHPExcel->getActiveSheet()->mergeCells('A308:G308');
$objPHPExcel->getActiveSheet()->setCellValue('A308', "RS Santa Maria");
$objPHPExcel->getActiveSheet()->mergeCells('A311:G311');
$objPHPExcel->getActiveSheet()->setCellValue('A311', "____________________");
$objPHPExcel->getActiveSheet()->mergeCells('A312:G312');
$objPHPExcel->getActiveSheet()->setCellValue('A312', "Nama dan Tanda Tangan");
$objPHPExcel->getActiveSheet()->getStyle('A1:I4')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1:I4')->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle('A1:I4')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A300')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A307')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A308')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('G302')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A311')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A312')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('G305')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data Limbah"'.date("d-F-Y").'".xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
 
// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

?>

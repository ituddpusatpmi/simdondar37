<?php
if (!isset($_GET['sSearch']) || $_GET['sSearch'] == '' || !$_GET['sSearch']) {
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => 0,
		"iTotalDisplayRecords" => 0,
		"aaData" => array()
	);
	echo json_encode($output);
	return false;
}
session_start();
$today=date("Y-m-d");
$array_bulan = array(1=>'Jan','Feb','Mar', 'Apr', 'Mei', 'Jun','Jul','Ags','Sep','Okt', 'Nov','Des');
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */

	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'Kode', 'Nama', 'Alamat','GolDarah', 'Rhesus', 'Jk', 'TglLhr','jumDonor','p10','p25','p50','p75','p100','psatya','pprov','Kode_lama' );

	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "Kode";

	/* DB table to use */
	$sTable = "pendonor";

	include("../config/db_connect.php");
	 $q_utd	= mysql_query("select id from utd where aktif='1'");
	 $utd	= mysql_fetch_assoc($q_utd);
	/* Database connection information */
	$gaSql['user']       = $db_user;
	$gaSql['password']   = $db_pass;
	$gaSql['db']         = $db_name;
	$gaSql['server']     = $db_host;

	/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */

	/*
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );

	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or
		die( 'Could not select database '. $gaSql['db'] );


	/*
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}


	/*
	 * Ordering
	 */
	$sOrder = "ORDER BY jumDonor";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}

		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}


	/*
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = " WHERE jumDonor>=10";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}

	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			//$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			if ($i!=3) $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			if ($i==3) $sWhere .= $aColumns[$i]." = '".mysql_real_escape_string($_GET['sSearch_'.$i])."' ";
		}
	}


	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());

	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];

	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];


	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);

	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				if($i==0){
					$link="";
					$kode=$aRow[ $aColumns[$i] ];
					$antri=mysql_fetch_assoc(mysql_query("select KodePendonor from htransaksi where KodePendonor='$kode' and status='0'"));
					$data=mysql_fetch_assoc(mysql_query("select tglkembali,Cekal from pendonor where Kode = '$kode' "));
					switch ($_SESSION[leveluser]){
		
                                    case "kasir":
                                                    $lokal=strpos(substr($kode,0,4),$utd[id]);

                                                    if ($lokal!==false) $link=$link. "<a href=pmikasir.php?module=eregistrasi&Kode=".$kode." TITLE=\"EDIT\"><img src=\"images/ubah.png\" width=15 height=15/></a>";
                                                    if ($lokal!==false) $link=$link. "<a href=/jqupc/index.php?ext=jpg&idpendonor=$kode TITLE=\"Cetak\">&nbsp;<img src=\"/images/cetak.png\" width=15 height=15/></a>";
                                                    break;
				    case "p2d2s":
                                                    $lokal=strpos(substr($kode,0,4),$utd[id]);

                                                    if ($lokal!==false) $link=$link. "<a href=pmikasir2.php?module=eregistrasi&Kode=".$kode." TITLE=\"EDIT\"><img src=\"images/ubah.png\" width=15 height=15/></a>";
                                                    if ($lokal!==false) $link=$link. "<a href=/jqupc/index.php?ext=jpg&idpendonor=$kode TITLE=\"Cetak\">&nbsp;<img src=\"/images/cetak.png\" width=15 height=15/></a>";
                                                    break;

                                    case "admin":
                                                    $lokal=strpos($kode,$utd[id]);
                                                    $lokal=strpos(substr($kode,0,4),$utd[id]);
                                                    if ($lokal!==false) $link=$link."<a href=pmiadmin.php?module=hapus_pendonor&Kode=".$kode." TITLE=\"DELETE\"><img src=\"images/hapus.png\" width=15 height=15/></a>";
                                                    if ($lokal!==false) $link=$link. "<a href=pmiadmin.php?module=eregistrasi&Kode=".$kode." TITLE=\"EDIT\"><img src=\"images/ubah.png\" width=15 height=15/></a>";
                                                    break;
                                    default:
                                                    $link="Anda tidak memiliki hak akses";
                                                            }
					$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=sejarah&kode=".$kode." TITLE=\"DETIL\">
										".$kode."</a>";
				}else if($i==5){
					if($aRow[ $aColumns[$i]]=='0'){
						$row[]="L";
					}else{
						$row[]="P";
					}
				}else if($i==6){
					$tgl=$aRow[ $aColumns[$i]];
					$bln11=date("n",strtotime($tgl));
					$bln1=$array_bulan[$bln11];
					$tgll=substr($tgl,8,2).' '.$bln1.' '.substr($tgl,0,4);
					$row[]=$tgll;
				}else if($i==8){
                 			if($aRow[ $aColumns[$i]]=='0'){
                                        $link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="p10";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					}  elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p10";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p10";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p10";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        } else {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p10";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";

                                        }
								
				}else if($i==9){
                                         $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="p25";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
                                        }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p25";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p25";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p25";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p25";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
                                }else if($i==10){
                                        $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="p50";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					 }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p50";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p50";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p50";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p50";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
                                }else if($i==11){
                                        $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="p75";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					 }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p75";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p75";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p75";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p75";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
                                }else if($i==12){
                                        $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="p100";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					 }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p100";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p100";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p100";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="p100";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
                                }else if($i==13){
                                        $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="psatya";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					 }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="psatya";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="psatya";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="psatya";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="psatya";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
                                }else if($i==14){
                                        $status=$aRow[ $aColumns[$i]];
					if($aRow[ $aColumns[$i]]=='0'){
					$link="";
					$kode=$aRow[ $aColumns[0] ];
                                        $status="pprov";
                                  	$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=ajukan_piagam&kode=".$kode."&status=".$status." TITLE=\"Ajukan\">
										Belum</a>";
					 }elseif ($aRow[ $aColumns[$i]]=='1') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="pprov";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diajukan</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='2') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="pprov";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Dicetak</a>";
                                        }  elseif ($aRow[ $aColumns[$i]]=='3') {
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="pprov";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam&kode=".$kodefix." TITLE=\"Edit\">
										Sudah Diberikan</a>";
                                        }else{
                                            $link="";
                                            $kode=$aRow[ $aColumns[0] ];
                                            $status="pprov";
                                            $kodefix=$kode.$status;
                                            $row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=edit_piagam1&kode=".$kodefix." TITLE=\"Edit\">
										Dikembalikan</a>";
					}
				}else{
					/* General output */
					$row[] = $aRow[ $aColumns[$i] ];
				}
			}
		}
		$output['aaData'][] = $row;
	}

	echo json_encode( $output );
?>

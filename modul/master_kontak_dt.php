
<?php

session_start();
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */

	$aColumns = array( 'Kode', 'Jenis', 'Nama', 'Alamat', 'Telp1', 'namaCp', 'alamatcp', 'telpcp1', 'telpcp2' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "Jenis";
	
	/* DB table to use */
	$sTable = "supplier";
	
	include("../config/db_connect.php");
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
	$sOrder = "";
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
	$sWhere = "";
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
			if ($i!=0) $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			//if ($i==0) $sWhere .= $aColumns[$i]." = '".mysql_real_escape_string($_GET['sSearch_'.$i])."' ";
			if ($i==0) $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
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
					$pilih=mysql_fetch_assoc(mysql_query("select Kode from supplier where Kode='$kode'"));
					switch ($_SESSION[leveluser]){
					case "logistik":
						$lokal=strpos(substr($kode,0,4),$utd[id]);
						$link=$link."<a href=pmilogistik.php?module=edit_kontak&Kode=".$kode." TITLE=\"Edit data Barang\"><img src=\"images/ubah.png\" width=15 height=15/></a>";
					break;
					case "admin":
						$lokal=strpos(substr($kode,0,4),$utd[id]);
						$link=$link."<a href=pmilogistik.php?module=edit_kontak&Kode=".$kode." TITLE=\"Edit data Barang\"><img src=\"images/ubah.png\" width=15 height=15/></a>";
						$link=$link."<a href=pmilogistik.php?module=kontak_hapus&Kode=".$kode." TITLE=\"Hapus data stok\"><img src=\"images/hapus.png\" width=15 height=15 /></a> ";
					break;
					default:
					$link="??";
						}
						$row[]=$link."&nbsp"."<a href=pmi".$_SESSION[leveluser].".php?module=kontak_transaksi&kode=".$kode." TITLE=\"Lihat transaksi\">
										".$kode."</a>";
				        ;
				}else if($i==1){ //Jenis Kontak
						$jenis=$aRow[ $aColumns[$i]];
						if ($jenis==0){
						   $jenis1='0-Supplier';
						}else if($jenis==1){
					  	   $jenis1='1-Customer';
						}else if($jenis==2){
					  	   $jenis1='2-Bagian';
						}else if($jenis==4){
					  	   $jenis1='4-Limbah';
						}else{
						   $jenis1='3-Lain';	
						}
						$row[]=$jenis1;
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

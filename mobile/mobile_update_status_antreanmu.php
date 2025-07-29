<?php
if (isset($_GET['id'])){
	$curl = curl_init();
	$idtransaksi= $_GET['id'];
	$status		= $_GET['sts'];
	$mode		= $_GET['mode'];
	$level		= 'pmi'.$_SESSION['leveluser'];

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/update_antrean_mu.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array('idtransaksi' => $idtransaksi,'status' => $status, 'pesan' => 'Pengajuan Kegiatan Donor tidak disetujui', 'statinbox' => '4'),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	echo $response;
	if ($mode=='antrean'){
		echo '<META http-equiv="refresh" content="1; url='.$level.'.php?module=mobile_antreanmu">';
	}
}
?>

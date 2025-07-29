<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://apicovid19indonesia-v2.vercel.app/api/indonesia",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);
//echo $response;
$tupdate=explode('T',$data['lastUpdate']);
$info='Update Covid-19 Indonesia  ('.$tupdate[0].' - '.substr($tupdate[1],1,4).') Positif: '.number_format($data['positif'],'0',',','.').' Sembuh: '.number_format($data['sembuh'],'0',',','.').' Dirawat: '.number_format($data['dirawat'],'0',',','.').' Meninggal: '.number_format($data['meninggal'],'0',',','.');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://apicovid19indonesia-v2.vercel.app/api/indonesia/provinsi",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$data = json_decode($response, true);
for($a=0; $a < count($data); $a++){
  if ($data[$a]['provinsi']=='BALI') {
    $infobali=' Provinsi '.$data[$a]['provinsi'].' Positif :'.number_format($data[$a]['kasus'],'0',',','.').' Dirawat :'.number_format($data[$a]['dirawat'],'0',',','.').' Sembuh :'.number_format($data[$a]['sembuh'],'0',',','.').' Meninggal :'.number_format($data[$a]['meninggal'],'0',',','.');
  }
}

echo '<li>'.$info.' '.$infobali.'</li>';
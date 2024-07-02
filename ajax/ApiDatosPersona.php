<?php

// Datos
$token = 'apis-token-3838.li9paIxTzRPD5bpsVLuAFnu3oHyIejTZ';
$dni = $_POST['documento'];
// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos listos para usar
//$persona = json_decode($response);
//datos ya llegan en formato json
if($response == 'Not Found'){
  echo json_encode(array('error' => 'si'));
}else{
  echo $response;
}

?>
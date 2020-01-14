<?php

//encryption key set in the Merchant Access Portal
$encryptionKey = 'secret';

$DateTime = new DateTime();

$data = array(
    'PAYGATE_ID'        => 10011072130,
    'REFERENCE'         => 'pgtest_123456789',
    'AMOUNT'            => 3299,
    'CURRENCY'          => 'ZAR',
    'RETURN_URL'        => 'http://localhost/paygate/PayWeb3/result.php',
    'TRANSACTION_DATE'  => $DateTime->format('Y-m-d H:i:s'),
    'LOCALE'            => 'en-za',
    'COUNTRY'           => 'ZAF',
    'EMAIL'             => 'customer@paygate.co.za',
);

$checksum = md5(implode('', $data) . $encryptionKey);

$data['CHECKSUM'] = $checksum;

$fieldsString = http_build_query($data);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, 'https://secure.paygate.co.za/payweb3/initiate.trans');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);

//execute post
$result = curl_exec($ch);

echo $result;

$Array = explode("&" ,$result);
$request_ID = str_replace("PAY_REQUEST_ID=", "", $Array[1]);
$ref = str_replace("REFERENCE=", "", $Array[2]);
$check = str_replace("CHECKSUM=", "", $Array[3]);
//close connection
curl_close($ch);

?>
<form action="https://secure.paygate.co.za/payweb3/process.trans" method="POST" >
    <input type="hidden" name="PAY_REQUEST_ID" value="<?= $request_ID  ?>">
    <input type="hidden" name="CHECKSUM" value="<?= $check  ?>">
    <input type="submit" name="" id="" value="Enviar">
</form>



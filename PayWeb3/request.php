<?php
ini_set('display_errors',0);
session_name('paygate_payweb3_testing_sample');
session_start();

require_once('paygate.payweb3.php');

$data = array(
	'PAYGATE_ID'        => filter_var($_POST['PAYGATE_ID'], FILTER_SANITIZE_STRING),
	'REFERENCE'         => filter_var($_POST['REFERENCE'], FILTER_SANITIZE_STRING),
	'AMOUNT'            => filter_var($_POST['AMOUNT'], FILTER_SANITIZE_NUMBER_INT),
	'CURRENCY'          => filter_var($_POST['CURRENCY'], FILTER_SANITIZE_STRING),
	'RETURN_URL'        => filter_var($_POST['RETURN_URL'], FILTER_SANITIZE_URL),
	'TRANSACTION_DATE'  => filter_var($_POST['TRANSACTION_DATE'], FILTER_SANITIZE_STRING),
	'LOCALE'            => filter_var($_POST['LOCALE'], FILTER_SANITIZE_STRING),
	'COUNTRY'           => filter_var($_POST['COUNTRY'], FILTER_SANITIZE_STRING),
	'EMAIL'             => filter_var($_POST['EMAIL'], FILTER_SANITIZE_EMAIL),
	'PAY_METHOD'        => (isset($_POST['PAY_METHOD']) ? filter_var($_POST['PAY_METHOD'], FILTER_SANITIZE_STRING) : ''),
	'PAY_METHOD_DETAIL' => (isset($_POST['PAY_METHOD_DETAIL']) ? filter_var($_POST['PAY_METHOD_DETAIL'], FILTER_SANITIZE_STRING) : ''),
	'NOTIFY_URL'        => (isset($_POST['NOTIFY_URL']) ? filter_var($_POST['NOTIFY_URL'], FILTER_SANITIZE_URL) : ''),
	'USER1'             => (isset($_POST['USER1']) ? filter_var($_POST['USER1'], FILTER_SANITIZE_URL) : ''),
	'USER2'             => (isset($_POST['USER2']) ? filter_var($_POST['USER2'], FILTER_SANITIZE_URL) : ''),
	'USER3'             => (isset($_POST['USER3']) ? filter_var($_POST['USER3'], FILTER_SANITIZE_URL) : ''),
	'VAULT'             => (isset($_POST['VAULT']) ? filter_var($_POST['VAULT'], FILTER_SANITIZE_NUMBER_INT) : ''),
	'VAULT_ID'          => (isset($_POST['VAULT_ID']) ? filter_var($_POST['VAULT_ID'], FILTER_SANITIZE_STRING) : '')
);

$encryption_key  = $_POST['encryption_key'];

$_SESSION['pgid']      = $data['PAYGATE_ID'];
$_SESSION['reference'] = $data['REFERENCE'];
$_SESSION['key']       = $encryption_key;

$PayWeb3 = new PayGate_PayWeb3();
//$PayWeb3->setDebug(true);
$PayWeb3->setEncryptionKey($encryption_key);
$PayWeb3->setInitiateRequest($data);

$returnData = $PayWeb3->doInitiate();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>PayWeb 3 - Request</title>
	<link rel="stylesheet" href="css/paygate.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<img src="images/paygate-logo.png" alt="PayGate" height="60" width="175" /><span>PayWeb 3 Sample Code - Step: Request / Redirect</span>
		</div>
		<div class="header-bar"><a class="btn btn-submit" href="input.php">Input</a> | <a class="btn btn-submit" href="query.php">Query</a></div>
		<form action="<?php echo $PayWeb3::$process_url ?>" method="post" name="paygate_process_form">
			<label for="PAYGATE_ID">PayGate ID</label>
			<p id="PAYGATE_ID" class="form-value"><?php echo $data['PAYGATE_ID']; ?></p>
			<br>
			<label for="REFERENCE">Reference</label>
			<p id="REFERENCE" class="form-value"><?php echo $data['REFERENCE']; ?></p>
			<br>
			<label for="AMOUNT">Amount</label>
			<p id="AMOUNT" class="form-value"><?php echo $data['AMOUNT']; ?></p>
			<br>
			<label for="CURRENCY">Currency</label>
			<p id="CURRENCY" class="form-value"><?php echo $data['CURRENCY']; ?></p>
			<br>
			<label for="RETURN_URL">Return URL</label>
			<p id="RETURN_URL" class="form-value"><?php echo $data['RETURN_URL']; ?></p>
			<br>
			<label for="LOCALE">Locale</label>
			<p id="LOCALE" class="form-value"><?php echo $data['LOCALE']; ?></p>
			<br>
			<label for="COUNTRY">Country</label>
			<p id="COUNTRY" class="form-value"><?php echo $data['COUNTRY']; ?></p>
			<br>
			<label for="TRANSACTION_DATE">Transaction Date</label>
			<p id="TRANSACTION_DATE" class="form-value"><?php echo $data['TRANSACTION_DATE']; ?></p>
			<br>
			<label for="EMAIL">Customer Email</label>
			<p id="EMAIL" class="form-value"><?php echo $data['EMAIL']; ?></p>

			<div class="well">
				<?php echo (isset($data['PAY_METHOD']) && $data['PAY_METHOD'] != '' ? '<label for="PAY_METHOD">Pay Method</label>
<p id="PAY_METHOD" class="form-value">'.$data['PAY_METHOD'].'</p>
<br>' : '');
				echo (isset($data['PAY_METHOD_DETAIL']) && $data['PAY_METHOD_DETAIL'] != '' ? '<label for="PAY_METHOD_DETAIL">Pay Method Detail</label>
<p id="PAY_METHOD_DETAIL" class="form-value">'.$data['PAY_METHOD_DETAIL'].'</p>
<br>' : '');
				echo (isset($data['NOTIFY_URL']) && $data['NOTIFY_URL'] != '' ? '<label for="NOTIFY_URL">Notify Url</label>
<p id="NOTIFY_URL" class="form-value">'.$data['NOTIFY_URL'].'</p>
<br>' : '');
				echo (isset($data['USER1']) && $data['USER1'] != '' ? '<label for="USER1">User Field 1</label>
<p id="USER1" class="form-value">'.$data['USER1'].'</p>
<br>' : '');
				echo (isset($data['USER2']) && $data['USER2'] != '' ? '<label for="USER2">User Field 2</label>
<p id="USER2" class="form-value">'.$data['USER2'].'</p>
<br>' : '');
				echo (isset($data['USER3']) && $data['USER3'] != '' ? '<label for="USER3">User Field 3</label>
<p id="USER3" class="form-value">'.$data['USER3'].'</p>
<br>' : '');
				echo (isset($data['VAULT']) && $data['VAULT'] != '' ? '<label for="VAULT">Vault</label>
<p id="VAULT" class="form-value">'.$data['VAULT'].'</p>
<br>' : '');
				echo (isset($data['VAULT_ID']) && $data['VAULT_ID'] != '' ? '<label for="VAULT_ID">Vault ID</label>
<p id="VAULT_ID" class="form-value">'.$data['VAULT_ID'].'</p>' : '');
				?>
			</div>
			<label for="encryption_key">Encryption Key</label>
			<p id="encryption_key" class="form-value"><?php echo $encryption_key; ?></p>
			<br>
			<?php if(isset($PayWeb3->initiateResponse) || isset($PayWeb3->lastError)){ ?>
				<label for="request">Request Result</label><br>
				<textarea class="form-value-textarea" rows="3" cols="50" id="request"><?php
					if (!isset($PayWeb3->lastError)) {
						foreach($PayWeb3->processRequest as $key => $value){
							echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />'.PHP_EOL;
						}
					} else {
						echo $PayWeb3->lastError;
					} ?>
				</textarea>
				<br>
			<?php
				if (!isset($PayWeb3->lastError)) {
					foreach($PayWeb3->processRequest as $key => $value){
						echo '<input type="hidden" name="'.$key.'" value="'.$value.'" />'.PHP_EOL;
					}
				} ?>
				<br>
				<input class="btn btn-submit" type="submit" name="btnSubmit" value="Submit" />
			<?php } ?>
			<br>
		</form>
	</div>
</body>
</html>
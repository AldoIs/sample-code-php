<?php
require_once('paygate.payweb3.php');

session_name('paygate_payweb3_testing_sample');
session_start();
session_destroy();

if(isset($_POST['btnSubmit'])){
	$data = array(
		'PAYGATE_ID'     => $_POST['PAYGATE_ID'],
		'PAY_REQUEST_ID' => $_POST['PAY_REQUEST_ID'],
		'REFERENCE'      => $_POST['REFERENCE']
	);

	$encryption_key = $_POST['encryption_key'];

	$PayWeb3 = new PayGate_PayWeb3();
	$PayWeb3->setDebug(true);
	$PayWeb3->setEncryptionKey($encryption_key);
	$PayWeb3->setQueryRequest($data);

	$returnData = $PayWeb3->doQuery();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>PayWeb 3 - Query</title>
		<link rel="stylesheet" href="css/paygate.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<img src="images/paygate-logo.png" alt="PayGate" height="60" width="175" /><span>PayWeb 3 Sample Code - Query</span>
			</div>
			<div class="header-bar"><a class="btn btn-submit" href="input.php">Input</a> | <a class="btn btn-submit" href="query.php">Query</a></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<label for="PAYGATE_ID">PayGate ID</label>
				<input class="form-input" type="text" name="PAYGATE_ID" id="PAYGATE_ID" value="<?php echo ($data['PAYGATE_ID'] != '' ? $data['PAYGATE_ID'] : '10011013800'); ?>" />
				<br>
				<label for="PAY_REQUEST_ID">Pay Request ID</label>
				<input class="form-input" type="text" name="PAY_REQUEST_ID" id="PAY_REQUEST_ID" value="<?php echo ($data['PAY_REQUEST_ID'] != '' ? $data['PAY_REQUEST_ID'] : ''); ?>" />
				<br>
				<label for="REFERENCE">Reference</label>
				<input class="form-input" type="text" name="REFERENCE" id="REFERENCE" value="<?php echo ($data['REFERENCE'] != '' ? $data['REFERENCE'] : ''); ?>" />
				<br>
				<label for="encryption_key">Encryption Key</label>
				<input class="form-input" type="text" name="encryption_key" id="encryption_key" value="<?php echo ($encryption_key != '' ? $encryption_key : 'secret'); ?>" />
				<br>
				<input class="btn btn-submit" id="doQueryBtn" type="submit" name="btnSubmit" value="Do Query" />

				<a class="btn btn-submit" href="input.php">New Transaction</a>
				<br>
			</form>
			<br>
<?php if(isset($PayWeb3->queryResponse) || isset($PayWeb3->lastError)){ ?>
	<div class="container-center">
		<div class="well">
			<?php if(!isset($PayWeb3->lastError)){
				foreach($PayWeb3->queryResponse as $key => $value){ ?>
					<label for="<?php echo $key; ?>"><?php echo $key; ?></label>
					<p class="form-value"><?php echo $value; ?></p>
					<br>
				<?php }
			} else if(isset($PayWeb3->lastError)){
				echo $PayWeb3->lastError;
			} ?>
		</div>
	</div>
<?php } ?>
</div>
</body>
</html>
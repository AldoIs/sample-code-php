<?php
	require_once('paygate.payweb3.php');

    session_name('paygate_payweb3_testing_sample');
    session_start();

	$data = array(
		'PAYGATE_ID'         => $_SESSION['pgid'],
		'PAY_REQUEST_ID'     => $_POST['PAY_REQUEST_ID'],
		'TRANSACTION_STATUS' => $_POST['TRANSACTION_STATUS'],
		'REFERENCE'          => $_SESSION['reference']
	);

	$PayWeb3 = new PayGate_PayWeb3();
	$PayWeb3->setEncryptionKey($_SESSION['key']);

	$test_checksum = $PayWeb3->generateChecksum($data);

	$data['CHECKSUM'] = $_POST['CHECKSUM'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8">
	    <title>PayWeb 3 - Result</title>
		<link rel="stylesheet" href="css/paygate.css">
	</head>
	<body>
		<div class="container">
			<div class="header">
				<img src="images/paygate-logo.png" alt="PayGate" height="60" width="175" /><span>PayWeb 3 Sample Code - Result</span>
			</div>
			<div class="header-bar"><a class="btn btn-submit" href="input.php">Input</a> | <a class="btn btn-submit" href="query.php">Query</a></div>
			<form action="query.php" method="post" name="query_paygate_form">
				<label for="checksumResult">Checksum result</label>
				<p id="checksumResult" class="form-value"><?php echo ($test_checksum != $data['CHECKSUM'] ? 'The checksums do not match: the calculated checksum is:<br>'.$test_checksum : 'Checksums match OK'); ?></p>
	            <hr>
				<label for="PAY_REQUEST_ID">Pay Request ID</label>
				<p id="PAY_REQUEST_ID" class="form-value"><?php echo $data['PAY_REQUEST_ID']; ?></p>
				<input type="hidden" name="PAY_REQUEST_ID" value="<?php echo $data['PAY_REQUEST_ID']; ?>" />
				<br>
				<label for="TRANSACTION_STATUS">Transaction Status</label>
				<p id="TRANSACTION_STATUS" class="form-value"><?php echo $data['TRANSACTION_STATUS']; ?> (<?php echo $PayWeb3->getTransactionStatusDescription($data['TRANSACTION_STATUS']) ?>)</p>
				<input type="hidden" name="TRANSACTION_STATUS" value="<?php echo $data['TRANSACTION_STATUS']; ?>" />
				<br>
				<label for="CHECKSUM" class="col-sm-3 text-right">Checksum</label>
				<p id="CHECKSUM" class="form-value"><?php echo $data['CHECKSUM']; ?></p>
				<br>

				<input type="hidden" name="PAYGATE_ID" value="<?php echo $data['PAYGATE_ID']; ?>" />
				<input type="hidden" name="REFERENCE" value="<?php echo $data['REFERENCE']; ?>" />
				<input type="hidden" name="encryption_key" value="<?php echo $_SESSION['key']; ?>" />

				<input type="submit" class="btn btn-submit" value="Query PayGate" name="btnSubmit">

				<a class="btn btn-submit" href="input.php">New Transaction</a>
			</form>
        </div>
	</body>
</html>
<?php
/*
 * This is an example page of the form fields required for a PayGate PayHost Settlement transaction.
 */
include_once('../../lib/php/global.inc.php');

/*
 * Include the helper PayHost SOAP class to make building the SOAP message a little easier
 */
include_once('../paygate.payhost_soap.php');

ini_set('display_errors',1);
ini_set('default_socket_timeout', 300);

$result     = '';
$err        = '';
$identifier = 'payrequestid';

if(isset($_POST['btnSubmit'])){

    /*
     * Create variables based on key names in $_POST
     */
    extract($_POST, EXTR_OVERWRITE);


    /*
     * Build SOAP to send to PayGate Query service
     */

    if ($identifier == 'merchantorderid'){
        //If Merchant Order ID is used
        $xmlQuery = '<ns1:MerchantOrderId>'.$merchantOrderId.'</ns1:MerchantOrderId>';
    } else if ($identifier == 'transid'){
        //If Transaction ID is used
        $xmlQuery = '<ns1:TransactionId>'.$transId.'</ns1:TransactionId>';
    }

    $xml = <<<XML
<ns1:SingleFollowUpRequest>
	<ns1:SettlementRequest>
		<ns1:Account>
			<ns1:PayGateId>{$payGateId}</ns1:PayGateId>
			<ns1:Password>{$encryptionKey}</ns1:Password>
		</ns1:Account>
		{$xmlQuery}
	</ns1:SettlementRequest>
</ns1:SingleFollowUpRequest>p

XML;

    /**
     *  disabling WSDL cache
     */
    ini_set("soap.wsdl_cache_enabled", "0");

    /*
     * Using PHP SoapClient to handle the request
     */
    $soapClient = new SoapClient(PayHostSOAP::$process_url."?wsdl", array('trace' => 1)); //point to WSDL and set trace value to debug

    try {
        /*
         * Send SOAP request
         */
        $result = $soapClient->__soapCall('SingleFollowUp', array(
            new SoapVar($xml, XSD_ANYXML)
        ));
    } catch(SoapFault $sf){
        /*
         * handle errors
         */
        $err = $sf->getMessage();
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>PayHost - Settlement</title>
    <link rel="stylesheet" href="/<?php echo $root; ?>/lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?php echo $root; ?>/lib/css/core.css">
</head>
<body>
<div class="container-fluid" style="min-width: 320px;">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">
                    <img alt="PayGate" src="/<?php echo $root; ?>/lib/images/paygate_logo_mini.png" />
                </a>
                <span style="color: #f4f4f4; font-size: 18px; line-height: 45px; margin-right: 10px;"><strong>PayHost Web Payment Settlement</strong></span>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/<?php echo $root; ?>/PayHost/singlePayment/webPayment/index.php">Initiate</a>
                    </li>
                    <li class="active">
                        <a href="/<?php echo $root; ?>/PayHost/singleFollowUp/settlement.php">Settlement</a>
                    </li>
                    <li>
                        <a href="/<?php echo $root; ?>/PayHost/singleFollowUp/simple_settlement.php">Simple settlement</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="background-color:#57B7DF; text-align: center; margin-top: 51px; margin-bottom: 15px; padding: 4px;"><strong>Settlement</strong></div>
    <div class="container">
        <form role="form" class="form-horizontal text-left" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="payGateId" class="col-sm-3 control-label">PayGate ID</label>
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="payGateId" id="payGateId" value="<?php echo(isset($payGateId) ? $payGateId : '10011072130'); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="encryptionKey" class="col-sm-3 control-label">Encryption Key</label>
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="encryptionKey" id="encryptionKey" value="<?php echo(isset($encryptionKey) ? $encryptionKey : 'test'); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="merchantOrderId" class="col-sm-3 control-label">Merchant Order ID</label>
                <div class="col-sm-5">
                    <div class="input-group">
		                        <span class="input-group-addon">
		                            <label for="merchantOrderIdChk" class="sr-only">Merchant Order Id Checkbox</label>
		                            <input name="identifier" id="merchantOrderIdChk" value="merchantorderid" type="radio" aria-label="Merchant Order Id Checkbox" <?php echo((isset($identifier) && $identifier == 'merchantorderid') || !isset($identifier) ? 'checked="checked"' : ''); ?> />
		                        </span>
                        <input type="text" name="merchantOrderId" id="merchantOrderId" class="form-control" aria-label="Merchant Order Id Input" value="<?php echo(isset($reference) ? $reference : ''); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="transid" class="col-sm-3 control-label">Transaction ID</label>
                <div class="col-sm-5">
                    <div class="input-group">
		                        <span class="input-group-addon">
		                            <label for="transidChk" class="sr-only">Transaction ID Checkbox</label>
		                            <input name="identifier" id="transidChk" value="transid" type="radio" aria-label="Transaction ID Checkbox" <?php echo(isset($identifier) && $identifier == 'transid' ? 'checked="checked"' : ''); ?>>
		                        </span>
                        <input type="text" name="transId" id="transId" class="form-control" aria-label="Transaction ID Input" value="<?php echo(isset($transid) ? $transid : ''); ?>" />
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class=" col-sm-offset-4 col-sm-4">
                    <img src="/<?php echo $root; ?>/lib/images/loader.gif" alt="Processing" class="initialHide" id="queryLoader">
                    <input class="btn btn-success btn-block" id="doVoidBtn" type="submit" name="btnSubmit" value="Do Settlement" />
                </div>
            </div>
            <br>
        </form>
        <?php
        if (isset($_POST['btnSubmit'])) {
            if (!$result) {
                // show exception
                echo <<<HTML
				<div class="row" style="margin-bottom: 15px;">
					<div class="col-sm-offset-2 col-sm-8 alert alert-danger">
						<strong>ERROR: </strong>{$err}
					</div>
				</div>
HTML;
            }
            ?>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-offset-4 col-sm-4">
                    <button id="showRequestBtn" class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#requestDiv" aria-expanded="false" aria-controls="requestDiv">
                        Request
                    </button>
                </div>
            </div>
            <div id="requestDiv" class="row collapse well well-sm">
                <?php
                //Show raw XML request DATA (only shows if 'trace' => 1)
                echo <<<HTML
						<textarea rows="20" cols="100" id="request" class="form-control">{$soapClient->__getLastRequest()}</textarea>
HTML;
                ?>
            </div>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-offset-4 col-sm-4">
                    <button id="showResponseBtn" class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#responseDiv" aria-expanded="false" aria-controls="responseDiv">
                        Response
                    </button>
                </div>
            </div>
            <div id="responseDiv" class="row collapse in well well-sm" >
                <?php  echo <<<HTML
				<textarea rows="20" cols="100" id="response" class="form-control">{$soapClient->__getLastResponse()}</textarea>
HTML;
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/<?php echo $root; ?>/lib/js/bootstrap.min.js"></script>
</body>
</html>
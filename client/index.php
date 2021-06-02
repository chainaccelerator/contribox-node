<?php

require_once '../lib/_require.php';

$data = '{
    "env": "regtest",
    "role": "owner",
    "domain": "Core",
    "domainSub": "user",
    "process": "Identifier",
    "processStep": "Validation",
    "processStepAction": "AskForConfirmationDeclaration",
    "about": "user",
    "amount": 0,
    "blockSignature": false, 
    "pegSignature": false, 
    "version": "v0", 
    "declareAddressFrom": false,
    "declareAddressTo": false, 
    "proofEncryption": false, 
    "userEncryption": false,
    "from": [],    
    "to": [], 
    "proof": "{data: \"\", version: \"v0\"}", 
    "user": "{data: \"\", version: \"v0\"}"
}';
$conf = json_decode($data);
$c = new Conf($conf->env);
$c->context = $conf;
$htmlConf = $c->conditionHtml();

$walletDefault = new SdkWallet();
$wallet = $walletDefault->conditionHtml();

$templateDefault = new SdkTemplate($conf->role, $conf->domain,$conf->domainSub, $conf->process, $conf->processStep, $conf->processStepAction, $conf->about, $conf->amount, $conf->blockSignature, $conf->pegSignature, $conf->version);
$template = $templateDefault->conditionHtml();

$transactionDefault = new SdkTransaction($conf->from, $conf->to, $templateDefault->name, $conf->amount, $conf->proof, $conf->user);
$operation = $transactionDefault->conditionHtml(array(), SdkTemplateTypeTo::walletsList());

$requestDataDefault= new SdkRequestData();
$requestData = $requestDataDefault->conditionHtml();

?><!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="css/default.css">
    <!-- DEBUT SDK -->
    <!-- FIN SDK -->
</head>
<body>

<script async type="text/javascript" src="js/sodium.js" ></script>
<script async type="text/javascript" src="js/contribox.js"></script>
<script async type='text/javascript' src='js/main.js'></script>
<script defer type='text/javascript' src='js/SdkTemplate.js'></script>
<script defer type='text/javascript' src='js/SdkTransaction.js'></script>
<script defer type='text/javascript' src='js/SdkWallet.js'></script>
<script defer type='text/javascript' src='js/SdkRequestData.js'></script>
<script defer type='text/javascript' src='js/Conf.js'></script>
    <section>
        <div id="msg"></div>
        <input type="file" name="fileSelect" id="fileSelect" style="display: none">
        <button id="upload" name="upload">Upload your wallet</button> <a href="#" id="create" name="create">Create your wallet</a>
        <br id="sep1">
        <br id="sep2">
        <fieldset><legend>Operation</legend>
            <?php echo $operation ?>
            <br><br>
            <a href="#" id="provePay" name="provePay" style="display: none">Prove and pay</a>
        </fieldset>
        <fieldset><legend>Confirmations to sign (or not)</legend>
            <h4>Backup</h4>
            <h4>Lock</h4>
            <h4>Witness (from)</h4>
            <h4>Cosigner (from)</h4>
            <h4>Ban</h4>
            <h4>Board</h4>
            <h4>Member</h4>
            <h4>Old</h4>
            <h4>Onboard</h4>
            <h4>Outboard</h4>
            <h4>Witness (org)</h4>
            <h4>Cosigner (org)</h4>
            <h4>Block</h4>
            <h4>Peg</h4>
        </fieldset>
        <fieldset><legend>Create a template</legend>
            <?php echo $template; ?>
            <br>
            <br>
            <a href="#" id="createTemplate" name="createTemplate" style="display: none">Create</a>
        </fieldset>
    </section>
    <script defer type='text/javascript' src='js/SdkLoad.js'></script>
    <script defer type='text/javascript' src='js/SdkClient.js'></script>
</body>
</html>
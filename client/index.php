<?php

require_once '../lib/_require.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

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
    <title>Client Contribox</title>
    <link type="text/css" rel="stylesheet" href="css/default.css">
</head>
<body>
<!-- DEBUT SDK -->
<script>
var Module = {
    onRuntimeInitialized: async function () {
        // console.info('onRuntimeInitialized');
        main();
    }
};
function main() {

    if (init() !== 0) {
        alert("initialization failed");
        return;
    }
    // console.log("Cleanup and terminating");
}
</script>
<script async type="text/javascript" src="js/contribox.js"></script>
<script async type='text/javascript' src='js/main.js'></script>
<script>
window.sodium = {
    onload: function (sodium) {
        let h = sodium.crypto_generichash(64, sodium.from_string('test'));
        // console.log(sodium.to_hex(h));
    }
};
</script>
<script src="js/sodium.js" async></script>
<script defer type='text/javascript' src='js/Conf.js'></script>
<script defer type='text/javascript' src='js/SdkTemplate.js'></script>
<script defer type='text/javascript' src='js/SdkTransaction.js'></script>
<script defer type='text/javascript' src='js/SdkWallet.js'></script>
<script defer type='text/javascript' src='js/SdkRequestData.js'></script>
<!-- FIN SDK -->
<section>
    <div id="msg"></div>
</section>
<section>
    <fieldset id="account"><legend>Account</legend>

        <label>First name</label> <input type="text" name="firstname" value=""><br><br>
        <label>Last name</label> <input type="text" name="lastname" value=""><br><br>
        <label>Identity Id</label> <input type="text" name="identityId" value=""><br><br>
        <label>Identity Id proof 1</label> <input type="file" id="proof1"  name="identityIdProof1" value=""><br><br>
        <label>Professional Id</label> <input type="text" name="professionalId" value=""><br><br>
        <label>Professional Id proof 1</label> <input type="file" id="proof2" name="professionalIdProof1" value=""><br><br>
        <a href="#" id="create" name="create">Create your wallet</a>
    </fieldset>
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
<!-- DEBUT SDK -->
<script defer type='text/javascript' src='js/SdkLoad.js'></script>
<!-- FIN SDK -->
<script defer type='text/javascript' src='js/SdkClient.js'></script>
</body>
</html>
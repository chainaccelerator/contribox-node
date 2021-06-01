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
    <script async type="text/javascript" src="js/contribox.js"></script>
    <script async type='text/javascript' src='js/main.js'></script>
    <script>
var Module = {
    onRuntimeInitialized: async function () {
        console.info('onRuntimeInitialized');
        main();
    }
}
window.sodium = {
    onload: function (sodium0) {
        let h = sodium0.crypto_generichash(64, sodium0.from_string('test'));
        console.log(sodium0.to_hex(h));
        sodium=sodium0;
    }
};
function main() {

    if (init() !== 0) {
        alert("initialization failed");
        return;
    }
    console.log("Cleanup and terminating");
}
    </script>
    <script src="js/sodium.js" async></script>
    <!-- FIN SDK -->
</head>
<body>
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
<script>
// START SDK
var sodium;
const env = '<?php echo $conf->env; ?>';
<?php echo $templateDefault->htmlScript; ?>
var template = new Template();
<?php echo $transactionDefault->htmlScript; ?>
var transaction = new Transaction();
<?php echo $walletDefault->htmlScript; ?>
var wallet = new Wallet();
<?php echo $requestDataDefault->htmlScript; ?>
var requestData = new RequestData();

async function sig(publicKey, hash) {

    return '';
}
async function send(transaction, template, publicAddress) {

    let urlClient = 'http://localhost:7000/api/index.php';
    let dataToHash = requestData;
    delete dataToHash.pow;
    requestData.pow.hash = await hash(dataToHash);
    requestData.sig.sig = await sig(publicAddress, requestData.pow.hash);

    // request options
    const options = {
        method: 'POST',
        body: JSON.stringify(requestData),
        headers: {
            'Content-Type': 'application/json'
        }
    }
    // send post request
    fetch(urlClient, options)
        .then(res => res.json())
        .then(res => console.log(res))
        .catch(err => console.error(err));
}
// END SDK
var ret;
var fileSelectElem = document.getElementById("fileSelect");
var dlElem = document.getElementById("upload");
var dlElemCreate = document.getElementById("create");
var sep1 = document.getElementById("sep1");
var sep2 = document.getElementById("sep2");
var provePay = document.getElementById("provePay");
var templateElm = document.getElementById("template");
var createTemplate = document.getElementById("createTemplate");

function msgHtml() {

    let msgElem = document.getElementById("msg");
    msgElem.innerText = ret.msg;
    msgElem.classList.value = '';
    if(ret.cssClass !== '') msgElem.classList.add(ret.cssClass);
}
function walletListUpade(){


    var FromElm = document.getElementsByName("from")[0];
    var FromPubElm = document.getElementsByName("publickeyListfrom")[0];

    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.pubkey0;
        option.text=w.role;
        FromElm.appendChild(option);
        var option2 = document.createElement("option");
        option2.value=w.pubkey0;
        option2.text=w.role;
        FromPubElm.appendChild(option2);
    });
}

dlElem.addEventListener("click", function (e) {
    if (fileSelectElem) {
        fileSelectElem.click();
    }
    e.preventDefault();
    fileSelectElem.style.display = "initial";
}, false);

dlElemCreate.addEventListener("click", function (e) {

    wallet.createwallets();
    dlElem.style.display = "none";
    dlElemCreate.style.display = "none";
    sep1.style.display = "none";
    sep2.style.display = "none";
    createTemplate.style.display = "initial";
    provePay.style.display = "initial";

    walletListUpade();
    ret = {msg: "Wallet created", cssClass:"success"};
    msgHtml();

}, false);

createTemplate.addEventListener("click", function (e) {

    template.createTemplate();
    ret = {msg: "Template created", cssClass:"success"};
    msgHtml();

}, false);

fileSelectElem.addEventListener("change", function (e) {

    let file = this.files[0];
    let reader = new FileReader();

    reader.addEventListener("load", function () {

        wallet.load()

        dlElem.style.display = "none";
        dlElemCreate.style.display = "none";
        sep1.style.display = "none";
        sep2.style.display = "none";
        provePay.style.display = "initial";
        ret = {msg: "Wallet uploaded", cssClass:"success"};

        walletListUpade();
        msgHtml();
    }, false);

    if (file) {
        reader.readAsText(file);
    }
    fileSelectElem.style.display = "none";

}, false);
</script>
</body>
</html>
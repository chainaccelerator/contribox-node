function Account(){

    this.firstname = '';
    this.lastname = '';
    this.identityId = '';
    this.professionalId = '';
    this.identityIdProof1 = {};
    this.professionalIdProof1 = {};
    this.setToken();
}
Account.prototype.setToken = function(){

    let array = new Uint32Array(10);
    this.identityToken = window.crypto.getRandomValues(array).toString();
}
Account.prototype.update = function(){

    this.firstname = document.getElementsByName('firstname')[0].value;
    this.lastname = document.getElementsByName('lastname')[0].value;
    this.identityId = document.getElementsByName('identityId')[0].value;
    this.professionalId = document.getElementsByName('professionalId')[0].value;
}
Account.prototype.setIdentityIdProof1 = function(reader){

    this.identityIdProof1 = reader;
}
Account.prototype.setPprofessionalIdProof1 = function(reader){

    this.professionalIdProof1 = reader;
}
var account = new Account();
var ret;
var FromElm = document.getElementsByName("from")[0];
var accountElem = document.getElementById("account");
var fileSelectElem = document.getElementById("fileSelect");
var dlElem = document.getElementById("upload");
var dlElemCreate = document.getElementById("create");
var provePay = document.getElementById("provePay");
var createTemplate = document.getElementById("createTemplate");
var proof1 = document.getElementById("proof1");
var proof2 = document.getElementById("proof2");
var userElem = document.getElementsByName("user")[0];

function msgHtml() {

    let msgElem = document.getElementById("msg");
    msgElem.innerText = ret.msg;
    msgElem.classList.value = '';
    if(ret.cssClass !== '') msgElem.classList.add(ret.cssClass);
}
function loadedWallet(){

    accountElem.style.display = "none";
    createTemplate.style.display = "initial";
    provePay.style.display = "initial";
}
function loadedWalletNot(){

    accountElem.style.display = "initial";
    createTemplate.style.display = "none";
    provePay.style.display = "none";
}
function loadedWalletTest(){

    if(wallet.loaded == false) loadedWalletNot();
    else loadedWallet();
}
function walletListUpade(){

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

loadedWalletTest();

dlElem.addEventListener("click", function (e) {
    if (fileSelectElem) {
        fileSelectElem.click();
    }
    e.preventDefault();
    fileSelectElem.style.display = "initial";
}, false);

dlElemCreate.addEventListener("click", function (e) {

    account.update();
    wallet.createwallets(account);
    walletListUpade();
    loadedWalletTest();
    wallet.download();
    ret = {msg: "Wallet created", cssClass:"success"};
    msgHtml();

}, false);

createTemplate.addEventListener("click", function (e) {

    template.getDataFromForm();
    template.createTemplate();
    ret = {msg: "Template created", cssClass:"success"};
    msgHtml();

}, false);

fileSelectElem.addEventListener("change", function (e) {

    let file = this.files[0];
    let reader = new FileReader();

    reader.addEventListener("load", function () {

        wallet.load(reader);
        walletListUpade();
        loadedWalletTest();
        ret = {msg: "Wallet uploaded", cssClass:"success"};
        msgHtml();
    }, false);

    if (file) reader.readAsText(file);

    fileSelectElem.style.display = "none";

}, false);

proof1.addEventListener("change", function (e) {

    let file1 = this.files[0];
    let reader1 = new FileReader();

    reader1.addEventListener("load", function () {

        account.setIdentityIdProof1(reader1);
    }, false);

    if (file1) reader1.readAsText(file1);

}, false);

proof2.addEventListener("change", function (e) {

    let file2 = this.files[0];
    let reader2 = new FileReader();

    reader2.addEventListener("load", function () {

        account.setPprofessionalIdProof1(reader2);
    }, false);

    if (file2) reader2.readAsText(file2);

}, false);

var ret;
var fileSelectElem = document.getElementById("fileSelect");
var dlElem = document.getElementById("upload");
var dlElemCreate = document.getElementById("create");
var sep1 = document.getElementById("sep1");
var sep2 = document.getElementById("sep2");
var provePay = document.getElementById("provePay");
var createTemplate = document.getElementById("createTemplate");

function msgHtml() {

    let msgElem = document.getElementById("msg");
    msgElem.innerText = ret.msg;
    msgElem.classList.value = '';
    if(ret.cssClass !== '') msgElem.classList.add(ret.cssClass);
}
function loadedWallet(){

    dlElem.style.display = "none";
    dlElemCreate.style.display = "none";
    sep1.style.display = "none";
    sep2.style.display = "none";
    createTemplate.style.display = "initial";
    provePay.style.display = "initial";
}
function loadedWalletNot(){

    dlElem.style.display = "initial";
    dlElemCreate.style.display = "initial";
    sep1.style.display = "initial";
    sep2.style.display = "initial";
    createTemplate.style.display = "none";
    provePay.style.display = "none";
}
function loadedWallet(){

    loadedWalletNot();

    if(wallet.loaded === true) {
        loadedWallet();
        walletListUpade();
    }
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

    loadedWallet();
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

        wallet.load();
        loadedWallet();
        ret = {msg: "Wallet uploaded", cssClass:"success"};
        msgHtml();
    }, false);

    if (file) reader.readAsText(file);

    fileSelectElem.style.display = "none";

}, false);
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

    wallet.list.forEach(function (w) {

        let elm = document.getElementsByName("xpubList"+w.role)[0];
        let option = document.createElement("option");
        option.value = w.xpubHash;
        option.text = w.role;
        option.selected = true;
        elm.appendChild(option);
    });
}

loadedWalletTest();
account.update();

function loadWallet(){

    getLayoutData(0).then(function (result) {
        getLayoutData(1).then(function (result) {
            getLayoutData(2).then(function (result) {
                getLayoutData(3).then(function (result) {
                    getLayoutData(4).then(function (result) {
                        getLayoutData(5).then(function (result) {
                            getLayoutData(6).then(function (result) {
                                getLayoutData(7).then(function (result) {
                                    getLayoutData(8).then(function (result) {
                                        getLayoutData(9).then(function (result) {
                                            getLayoutData(10).then(function (result) {
                                                getLayoutData(11).then(function (result) {
                                                    getLayoutData(12).then(function (result) {
                                                        getLayoutData(13).then(function (result) {
                                                            getLayoutData(14).then(function (result) {
                                                                getLayoutData(15).then(function (result) {
                                                                    getLayoutData(16).then(function (result) {
                                                                        getLayoutData(17).then(function (result) {
                                                                            getLayoutData(18).then(function (result) {

                                                                                if (result == false) {
                                                                                    ret = {msg: "Wallet created", cssClass: "success" };
                                                                                    wallet.download();
                                                                                }
                                                                                else {

                                                                                    ret = {msg: "Wallet loaded", cssClass: "success" };
                                                                                }
                                                                                wallet.loaded = true;
                                                                                walletListUpade();
                                                                                loadedWalletTest();
                                                                                msgHtml();
                                                                            });
                                                                        });
                                                                    });
                                                                });
                                                            });
                                                        });
                                                    });
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });
}


function openPopup() {
    var el = document.getElementById('popup');
    el.style.display = 'block';
}
function closePopup() {
    var el = document.getElementById('popup');
    el.style.display = 'none';
}
function llu(e){

    var fileSelectElem = document.getElementById("fileSelect");
    fileSelectElem.click();
    fileSelectElem.style.display = "initial";
}
function llw(e){

    let file = e.files[0];
    let reader = new FileReader();
    var dlElem = document.getElementById("upload");
    var fileSelectElem = document.getElementById("fileSelect");

    reader.addEventListener("load", function () {

        let w = reader.result;
        let walletJ = JSON.parse(w.toString());
        wallet.list = walletJ.list;

        wallet.key = walletJ.key;

        wallet.list.forEach(function(w2) {

            var indexedDB2 = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
            var open2 = indexedDB2.open ("contribox", 2);
            open2.onsuccess = function () {

                var db2 = open2.result;
                var tx2 = db2.transaction("wallets", "readwrite");
                var store2 = tx2.objectStore("wallets");
                let objectStoreRequest = store2.add(w2);

                objectStoreRequest.onsuccess = function (event) {

                    console.info("added");
                };
                objectStoreRequest.onerror = function (event) {

                    console.info(event);
                };
            }
        });

        this.loaded = true;

        walletListUpade();
        loadedWalletTest();
        initW = true;
        ret = {msg: "Wallet uploaded", cssClass:"success"};
        msgHtml();
        closePopup();
    }, false);

    if (file) reader.readAsText(file);

    fileSelectElem.style.display = "none";

}
function getLayoutData (i) {

    let cpi = i;

    return new Promise (function(resolve) {
        indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        var open = indexedDB.open ("contribox", 2);

        open.onupgradeneeded = function(event) {

            initW = false;

            let store = event.target.result.createObjectStore("wallets", {keyPath: "name"});
            store.createIndex("name", "name", {unique: true});
            store.createIndex("role", "role", {unique: false});
            store.createIndex("pubkey0", "pubkey0", {unique: true});
            store.createIndex("seedWords", "seedWords", {unique: true});
            store.createIndex("xprv", "xprv", {unique: true});
            store.createIndex("xpub", "xpub", {unique: true});

            if (confirm("Do you want to import a wallet? Otherwise a wallet will be created.")) {

                var newDiv = document.createElement("div");
                newDiv.innerHTML += '<button class="open_button" onClick="openPopup()">Open Popup</button>' +
                    '<div id="popup" style="  position: absolute;width: 300px;z-index: 999;display: none;top:0;background-color: #fff;  border: 1px solid #ddd;  border-radius: 5px;  box-shadow: 0 2px 8px #aaa;  overflow: hidden;   padding: 10px;">' +
                    '   <input type="file" name="fileSelect" id="fileSelect" style="display: none" onchange="llw(this)">' +
                    '   <button id="upload" name="upload" onclick="llu(this)">Upload your wallet</button><br><br>' +
                    '  <button class="close_button" onClick="closePopup()">close</button' +
                    '</div>';

                var currentDiv = document.getElementById("main_container");
                document.body.insertBefore(newDiv, currentDiv);

                openPopup();
            }
        }
        open.onsuccess = function () {

            if(initW == false) return resolve(false);

            db = open.result;
            tx = db.transaction("wallets", "readwrite");
            var store = tx.objectStore("wallets");
            let r = wallet.walletList[cpi];

            store.get(r).onsuccess =  function (event) {

                let w = event.target.result;

                if (w == undefined) {

                    w = wallet.createWallet(account, r);
                    w.name = r;

                    let objectStoreRequest = store.add(w);

                    objectStoreRequest.onsuccess = function(event) {

                        console.info("added");
                    };
                    objectStoreRequest.onerror = function(event) {

                        console.info(event);
                    };
                    wallet.list[wallet.list.length] = w;
                    return resolve(false);
                }
                else {

                    wallet.list[wallet.list.length] = w;
                    return resolve(true);
                }

            }
        }
    });
}

var initW = true;
getLayoutData(0).then(function(result) {

    if(initW == true) loadWallet();
});

createTemplate.addEventListener("click", function (e) {

    template.getDataFromForm();
    template.createTemplate();
    ret = {msg: "Template created", cssClass:"success"};
    msgHtml();

}, false);

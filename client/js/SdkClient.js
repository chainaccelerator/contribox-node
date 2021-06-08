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

    var FromPubElm = document.getElementsByName("xpubListfrom")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        FromElm.appendChild(option);
        var option2 = document.createElement("option");
        option2.value=w.xpub;
        option2.text=w.role;
        FromPubElm.appendChild(option2);
    });

    var ToPubElm = document.getElementsByName("xpubListto")[0];
    var ToElm = document.getElementsByName("to")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        ToPubElm.appendChild(option);
        var option2 = document.createElement("option");
        option2.value=w.xpub;
        option2.text=w.role;
        ToElm.appendChild(option2);
    });

    var BackupPubElm = document.getElementsByName("xpubListbackup")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        BackupPubElm.appendChild(option);
    });

    var LockPubElm = document.getElementsByName("xpubListlock")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        LockPubElm.appendChild(option);
    });

    var WitnessPubElm = document.getElementsByName("xpubListwitness")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        WitnessPubElm.appendChild(option);
    });

    var CosignerPubElm = document.getElementsByName("xpubListcosigner")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        CosignerPubElm.appendChild(option);
    });

    var BanPubElm = document.getElementsByName("xpubListban")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        BanPubElm.appendChild(option);
    });

    var OldPubElm = document.getElementsByName("xpubListold")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        OldPubElm.appendChild(option);
    });

    var MemberPubElm = document.getElementsByName("xpubListmember")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        MemberPubElm.appendChild(option);
    });

    var BoardPubElm = document.getElementsByName("xpubListboard")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        BoardPubElm.appendChild(option);
    });

    var CosignerPubElm = document.getElementsByName("xpubListcosignerOrg")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        CosignerPubElm.appendChild(option);
    });

    var WitnessPubElm = document.getElementsByName("xpubListwitnessOrg")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        WitnessPubElm.appendChild(option);
    });

    var ParentsType1PubElm = document.getElementsByName("xpubListparentstype1")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        ParentsType1PubElm.appendChild(option);
    });

    var ChildsType1PubElm = document.getElementsByName("xpubListchildstype1")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        ChildsType1PubElm.appendChild(option);
    });

    var InvestorType1PubElm = document.getElementsByName("xpubListinvestorType1")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        InvestorType1PubElm.appendChild(option);
    });

    var BlockPubElm = document.getElementsByName("xpubListblock")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        BlockPubElm.appendChild(option);
    });

    var PegPubElm = document.getElementsByName("xpubListpeg")[0];
    wallet.list.forEach(function (w) {
        var option = document.createElement("option");
        option.value=w.xpub;
        option.text=w.role;
        PegPubElm.appendChild(option);
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
                                                                                getLayoutData(19).then(function (result) {
                                                                                    getLayoutData(20).then(function (result) {
                                                                                        getLayoutData(21).then(function (result) {

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
            });
        });
    });
}

function getLayoutData (i) {

    return new Promise (function(resolve) {
        indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        var open = indexedDB.open ("contribox", 2);

        open.onupgradeneeded = function(event) {

            let store = event.target.result.createObjectStore("wallets", {keyPath: "name"});
            store.createIndex("name", "name", {unique: true});
            store.createIndex("role", "role", {unique: false});
            store.createIndex("pubkey0", "pubkey0", {unique: true});
            store.createIndex("seedWords", "seedWords", {unique: true});
            store.createIndex("xprv", "xprv", {unique: true});
            store.createIndex("xpub", "xpub", {unique: true});

            if (confirm("Do you want to import a non-existent wallet? Otherwise a wallet will be created.")) {

                fileSelectElem.click();
                e.preventDefault();
                fileSelectElem.style.display = "initial";
            }
        }
        open.onsuccess = function () {

            db = open.result;
            tx = db.transaction("wallets", "readwrite");
            var store = tx.objectStore("wallets");
            let r = wallet.walletList[i];

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
getLayoutData(0);
loadWallet();

dlElem.addEventListener("click", function (e) {
    if (fileSelectElem) {
        fileSelectElem.click();
    }
    e.preventDefault();
    fileSelectElem.style.display = "initial";
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

function RequestData() {

    this.request = {"timestamp":0,"peerList":[],"pow":{"nonce":0,"difficulty":4,"difficultyPatthern":"d","hash":"default","pow":"default","previousHash":"default"},"sig":{"address":"","hash":"default","hdPath":"0\/0","range":"0","signature":"","xpub":""}};
    this.route = {"id":"default","version":"0.1","env":"regtest","template":"","transaction":{"amount":0,"from":[],"to":[],"proof":"{data: \"\", version: \"v0\"}","user":"{data: \"\", version: \"v0\"}","template":"","htmlFieldsId":[],"htmlScript":"","type":""}};
}
RequestData.prototype.roleMsgCreate = function(tx, templateRole) {

    if(templateRole.state != true) {
    
        console.warn("templateRole.state", templateRole);
        return false;
    }    
    if(templateRole.amount == 0) {
            
        console.warn("roleInfo.state", roleInfo);
        return false;
    }
    let tx0 = JSON.parse(JSON.stringify(tx));
    
    let toList = JSON.parse(JSON.stringify(roleInfo.xpubList));
    if(toList.length == 0) {
    
        console.warn("toList.length", toList);
        return false;
    }
    tx0.template = templateName;
    tx0.amount = roleInfo.amount;
    tx0.from = fromXpubIdList;
    tx0.to = toList;
    
    if(requestData.route.transaction.amount = 0)  t.parentstype1.amount = this.route.transaction.amount;
    if(requestData.route.transaction.amount > 0)  t.parentstype1.amount = this.route.transaction.amount;
    if(requestData.route.transaction.amount < 0)  t.from.amount = this.route.transaction.amount;    
    
    tx0.patternAfterTimeout = roleInfo.patternAfterTimeout;
    tx0.patternAfterTimeoutN = roleInfo.patternAfterTimeoutN;
    tx0.patternBeforeTimeout = roleInfo.patternBeforeTimeout;
    tx0.patternBeforeTimeoutN = roleInfo.patternBeforeTimeoutN;
    tx0.type = roleInfo.type;    
    let l = [];
        
    if(roleInfo.userProofSharing != true) tx0.proof = "";
    if(roleInfo.proofSharing != true) tx0.user = "";
    
    for(i=0; i<toList.length;i++){
        
        let test = this.encrypt(tx0, toList[i]);
        l[l.length] = test;
    }      
    return l;
}

RequestData.prototype.txPrepare = function(tx, role0, t, transactionDefault, res) {
    
    delete role0.htmlFieldsId;
    delete role0.htmlScript;
    
    let transaction0 = JSON.parse(JSON.stringify(transactionDefault));
    if(role0.from == "") {
        
        console.warn("role0.from");
        return { txList: res.txList, signList: res.signList }
    }    
    if(role0.state == false) {
        
        console.warn("role0.state");
        return { txList: res.txList, signList: res.signList }
    }    
    let templateFrom = t[role0.from];
    
    if(templateFrom.lenght == 0)  {
        
        console.warn("templateFrom.lenght");
        return { txList: res.txList, signList: res.signList }
    }    
    let inputAddressList;
    let outputAddressList;
    
    if(tx.amount != 0) {
    
        if(tx.amount > 0) {
    
            console.info("tx.amount", tx.amount);
        
            inputAddressList = templateFrom.xpubList;
            outputAddressList = role0.xpubList;
        }
        else {
        
            inputAddressList = role0.xpubList;
            outputAddressList = templateFrom.xpubList;
        }   
        console.info("outputAddressList", outputAddressList);
        
        let amountOutput = tx.amount / outputAddressList.length;
        
        for(let i=0;i<outputAddressList.length;i++){
            
            transaction0.outputs[i] = {};
            transaction0.outputs[i].address = outputAddressList[i];
            transaction0.outputs[i].amount = amountOutput;
            transaction0.outputs[i].uxtoList = [];
            transaction0.outputs[i].patternAfterTimeoutN = templateFrom.patternAfterTimeoutN;
            transaction0.outputs[i].patternBeforeTimeoutN = templateFrom.patternBeforeTimeoutN;
            transaction0.outputs[i].patternAfterTimeout = templateFrom.patternAfterTimeout;
            transaction0.outputs[i].patternBeforeTimeout = templateFrom.patternBeforeTimeout;
        
            let amountInput = amountOutput / inputAddressList.length;
            
            for(let n=0;n<inputAddressList.length;n++){
                
                transaction0.inputs[n][i] = { address: inputAddressList[n], amount: amountInput };
            }
        }
        res.txList[res.txList.length] = transaction0;
    }        
    for(xpub of role0.xpubList) {
    
        if(res.signList.includes(xpub) == false) res.signList[res.signList.length] = xpub;
    }
    for(xpub of templateFrom.xpubList) {
    
        if(res.signList.includes(xpub) == false) res.signList[res.signList.length] = xpub;
    }   
    return res;
}

RequestData.prototype.send = function(tr) {
        
    this.route.transaction = JSON.parse(JSON.stringify(tr));
    this.route.template = JSON.parse(JSON.stringify(tr.template));
    this.request.timestamp = new Date().getTime();
                
    let p = JSON.parse(JSON.stringify(requestData.route.transaction.proof));
    let u = JSON.parse(JSON.stringify(requestData.route.transaction.user));
                
    template.list.forEach(function(t) {
    
        if(t.name == requestData.route.template) {
                        
            requestData.pow(requestData);
            requestData.sig(requestData);
            
            requestData.route.transaction.from.forEach(function(p) { if(t.from.xpubList.indexOf(p) == -1) t.from.xpubList[t.from.xpubList.length] = p;});
            requestData.route.transaction.to.forEach(function(p) { if(t.to.xpubList.indexOf(p) == -1) t.to.xpubList[t.to.xpubList.length] = p;});
            
            for(w0 of wallet.walletsFederation.backup) t.backup.xpubList[t.backup.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.lock) t.lock.xpubList[t.lock.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.witness) t.witness.xpubList[t.witness.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.cosigner) t.cosigner.xpubList[t.cosigner.xpubList.length] = w0.xpubHash;
            
            console.info("requestData.route.transaction.amount", requestData.route.transaction.amount);
            
            if(requestData.route.transaction.amount > 0) {
                t.to.amount = requestData.route.transaction.amount;
                t.to.from = "from";
            }
            if(requestData.route.transaction.amount < 0) {    
                t.from.amount = requestData.route.transaction.amount;
                t.from.from = "to";                
            }            
            var transactionDefault = {
                inputs: [ {
                    address: "",
                    outputIndex: 0
                }],
                outputs: [ {
                    outputIndex: 0,    
                    address: "",
                    value: 0,
                    script: "",                    
                    pattern: "any",
                    patternAfterTimeoutN: 300,
                    patternBeforeTimeoutN: 1,
                    patternAfterTimeout: true,
                    patternBeforeTimeout: true
                }]
            };
            let res = {};      
            res.signList = [];
            res.txList = [];     
            var template0 = t;
            
res = requestData.txPrepare(requestData.route.transaction, template0.from, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.Genesis, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.api, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.peg, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.block, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.backup, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.lock, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.witness, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.cosigner, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.info, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.to, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.ban, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.board, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.member, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.old, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.cosignerOrg, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.witnessOrg, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.investorType1, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.childstype1, template0, transactionDefault, res)

res = requestData.txPrepare(requestData.route.transaction, template0.parentstype1, template0, transactionDefault, res)

            requestData.validation = res;
            
            console.info(requestData);
            
            let urlClient = "http://localhost:7002/api/index.php";            
            const options = {
            
                method: "POST",
                body: JSON.stringify(requestData),
                headers: {
                    "Content-Type": "application/json"
                }
            }
            fetch(urlClient, options)
            .then(res => res.json())
                .then(res => console.log(res))
                .catch(err => console.error(err));
        }
    });                                        
}
RequestData.prototype.sha256 = function(message) {

    let m = JSON.stringify(message);
    let s = sodium.from_string(m);
    let h = sodium.crypto_generichash(64, s);
    let hex = sodium.to_hex(h);
    
    // let msgUint8 = new TextEncoder().encode(message);
    // let hashBuffer = await crypto.subtle.digest("SHA-256", msgUint8);
    // let hashArray = Array.from(new Uint8Array(hashBuffer));
    // let hashHex = hashArray.map(b => b.toString(16).padStart(2, "0")).join("");
    
    return hex;
}
RequestData.prototype.encrypt = function(message, xpub) {

    let m = JSON.stringify(message);
    hdPath = "0/0";
    range = 100;
    
    return encryptMessageWithXpub(m, xpub, hdPath, range);
    
    // return sodium.crypto_aead_xchacha20poly1305_ietf_encrypt(message, null, null, wallet.nonce3, wallet.key3);
        
    // let m = JSON.stringify(message);
    // let enc = new TextEncoder();
    // let encoded = enc.encode(m);
    
    // return window.crypto.subtle.encrypt(
    //   {
    //      name: "RSA-OAEP"
    //   },
    //   publicKey,
    //   encoded
    // );
}
RequestData.prototype.decrypt = function(newCipher, xprv) {

    encryptedMessage = newCipher.encryptedMessage;
    hdPath = newCipher.hdPath;
    range = newCipher.range;
    xpub = newCipher.xpub;
    pubkey = newCipher.pubkey;
    senderPubkey = newCipher.encryptedMessage;

    let message = decryptMessage(encryptedMessage, xprv, hdPath, range, pubkey, senderPubkey);
    
    return JSON.parse(message);    

    // return sodium.crypto_aead_xchacha20poly1305_ietf_decrypt(null, ciphertext, null, wallet.nonce3, wallet.key3);

    // return window.crypto.subtle.decrypt(
    // {
    //   name: "RSA-OAEP"
    // },
    // privateKey,
    // ciphertext
    // );
}
RequestData.prototype.sig = function(data){

    wallet.list.forEach(function(w){
    
        if(w.role == "api") {
        
            requestData.request.sig = wallet.sig(w, data);
        }
    });
    return false;
}
RequestData.prototype.pow = function(data){

  let pattern = Array(this.request.pow.difficulty + 1).join(this.request.pow.difficultyPatthern);
  this.request.pow.hash = this.sha256(data);
  this.request.pow.pow = "";
  
  while (this.request.pow.pow.substring(0, this.request.pow.difficulty) != pattern) {
     
    this.request.pow.nonce++;
    this.request.pow.pow = this.sha256(this.request.pow.previousHash + this.timestamp + this.request.pow.hash + this.request.pow.nonce);
    
    if(this.request.pow.nonce > 800000) return false;
  } 
}

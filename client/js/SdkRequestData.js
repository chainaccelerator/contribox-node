
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
    
    console.warn("role0.type", role0.type);
    let transaction0 = JSON.parse(JSON.stringify(transactionDefault));
    if(role0.from == "") {
        
        console.warn("role0.from", role0);
        return { txList: res.txList, signList: res.signList }
    }    
    if(role0.state == false) {
        
        console.warn("role0.state", role0);
        return { txList: res.txList, signList: res.signList }
    }    
    let templateFrom = t[role0.from];
    
    if(templateFrom.lenght == 0)  {
        
        console.warn("templateFrom.lenght", templateFrom);
        return { txList: res.txList, signList: res.signList }
    }    
    if(tx.amount > 0) {
    
        transaction0.inputs[0].address = role0.xpubList;
        transaction0.outputs[0].address = templateFrom.xpubList;
        transaction0.outputs[0].value = tx.amount;
        transaction0.outputs[0].pattern = template0.pattern;
        transaction0.outputs[0].patternAfterTimeoutN = role0.patternAfterTimeoutN;
        transaction0.outputs[0].patternBeforeTimeoutN = role0.patternBeforeTimeoutN;
        transaction0.outputs[0].patternAfterTimeout = role0.patternAfterTimeout;
        transaction0.outputs[0].patternBeforeTimeout = role0.patternBeforeTimeout;
    }
    if(tx.amount < 0) {
    
        transaction0.inputs[0].address = templateFrom.xpubList;
        transaction0.outputs[0].address = role0.xpubList;
        transaction0.outputs[0].value =  tx.amount;
        transaction0.outputs[0].pattern = role0.pattern;
        transaction0.outputs[0].patternAfterTimeoutN = role0.patternAfterTimeoutN;
        transaction0.outputs[0].patternBeforeTimeoutN = role0.patternBeforeTimeoutN;
        transaction0.outputs[0].patternAfterTimeout = role0.patternAfterTimeout;
        transaction0.outputs[0].patternBeforeTimeout = role0.patternBeforeTimeout;
    }
    for(xpub of role0.xpubList) res.signList[res.signList.length] = xpub;
    for(xpub of templateFrom.xpubList) res.signList[res.signList.length] = xpub;
    res.txList[res.txList.length] = transaction0;
    
    console.info("res0", res);
    
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
            
            if(requestData.route.transaction.amount > 0) {
                t.to.amount = requestData.route.transaction.amount;
                t.to.from = "from";
            }
            if(requestData.route.transaction.amount > 0) {    
                t.from.amount = requestData.route.transaction.amount;
                t.from.from = "to";                
            }
            
            var transactionDefault = [{
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
            }];
            let res = {};      
            res.signList = [];
            res.txList = [];     
            var template0 = t;
            
console.info("template0.from", template0.from);
res = requestData.txPrepare(requestData.route.transaction, template0.from, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.Genesis", template0.Genesis);
res = requestData.txPrepare(requestData.route.transaction, template0.Genesis, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.api", template0.api);
res = requestData.txPrepare(requestData.route.transaction, template0.api, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.peg", template0.peg);
res = requestData.txPrepare(requestData.route.transaction, template0.peg, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.block", template0.block);
res = requestData.txPrepare(requestData.route.transaction, template0.block, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.backup", template0.backup);
res = requestData.txPrepare(requestData.route.transaction, template0.backup, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.lock", template0.lock);
res = requestData.txPrepare(requestData.route.transaction, template0.lock, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.info", template0.info);
res = requestData.txPrepare(requestData.route.transaction, template0.info, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.to", template0.to);
res = requestData.txPrepare(requestData.route.transaction, template0.to, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.cosigner", template0.cosigner);
res = requestData.txPrepare(requestData.route.transaction, template0.cosigner, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.witness", template0.witness);
res = requestData.txPrepare(requestData.route.transaction, template0.witness, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.ban", template0.ban);
res = requestData.txPrepare(requestData.route.transaction, template0.ban, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.board", template0.board);
res = requestData.txPrepare(requestData.route.transaction, template0.board, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.member", template0.member);
res = requestData.txPrepare(requestData.route.transaction, template0.member, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.old", template0.old);
res = requestData.txPrepare(requestData.route.transaction, template0.old, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.cosignerOrg", template0.cosignerOrg);
res = requestData.txPrepare(requestData.route.transaction, template0.cosignerOrg, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.witnessOrg", template0.witnessOrg);
res = requestData.txPrepare(requestData.route.transaction, template0.witnessOrg, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.investorType1", template0.investorType1);
res = requestData.txPrepare(requestData.route.transaction, template0.investorType1, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.childstype1", template0.childstype1);
res = requestData.txPrepare(requestData.route.transaction, template0.childstype1, template0, transactionDefault, res);
console.info("res", res);


console.info("template0.parentstype1", template0.parentstype1);
res = requestData.txPrepare(requestData.route.transaction, template0.parentstype1, template0, transactionDefault, res);
console.info("res", res);

           
                       
            console.info("res", res);
            
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

<?php

class SdkRequestData {

    public SdkRequest $request;
    public SdkRequestRoute $route;
    public string $htmlScript = '';

    public function __construct(string $role = '', string $domain = '', string $domainSub = '', string $process = '', string $processStep = '', string $processStepAction = '', string $about = '', int $amount = 0, bool $blockSignature = false, bool $pegSignature = false, string $version = 'v0', bool $declareAddressFrom = false, bool $declareAddressTo = false, bool $proofEncryption = false, bool $userEncryption = false, array $form = [], array $to = [], string $template = '', string $proof = '{data: "", version: "v0"}', string $user = '{data: "", version: "v0"}'){

        $dataRoute = new stdClass();
        $dataRoute->route = new stdClass();
        $dataRoute->route->template = 'default';
        $dataRoute->route->id = '0';
        $dataRoute->route->version = 'v0';
        $dataRoute->route->env = 'regtest';
        $dataRoute->route->transaction = new stdClass();
        $dataRoute->route->transaction->from = [];
        $dataRoute->route->transaction->to = [];
        $dataRoute->route->transaction->amount = 0;
        $dataRoute->route->transaction->proof = '';
        $dataRoute->route->transaction->user = '';

        $data = new stdClass();
        $data->request = new stdClass();
        $data->request->timestamp = time();
        $data->request->route = $dataRoute->route;
        $data->request->pow = new CryptoPow($data->request->route, $data->request->timestamp);
        $data->request->pow->pow($data->request->route, $data->request->timestamp);
        $data->request->hash = $data->request->pow->hash;

        $data->request->sig = new stdClass();
        $data->request->sig->address = '';
        $data->request->sig->signature = '';
        $this->request = new SdkRequest($data);
        $this->route = new SdkRequestRoute($dataRoute);
    }
    public function conditionHtml():string {

        $form = '';
        $c1= '';
        $c = [];
        $c['from'] = 'from';
        $res = '';
        foreach(SdkWallet::$walletsFederation as $d => $v) $c[$d] = $d;
        foreach(SdkWallet::$walletsShare as $d => $v) $c[$d] = $d;

        foreach($c as $t) {

            $c1 = 'SdkTemplateType'.ucfirst($t);
            $form .=    '
tx = requestData.roleMsgCreate(requestData.route.transaction, t.'.$t.');
if(tx != false) transactions[transactions.length] = tx;
';
            $res .= '
res = requestData.txPrepare(template0.'.$t.', template0, res)'."\n";
        }

        $this->htmlScript =  '
function RequestData() {

    this.peerList = '.json_encode(array_merge(json_decode(file_get_contents('../'.Conf::$env.'/conf/peerList.json')), ApiRequest::$peerList)).'
    this.request = '.json_encode($this->request).';
    this.route = '.json_encode($this->route).';
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
    
    if(requestData.route.transaction.amount = 0)  t.'.$t.'.amount = this.route.transaction.amount;
    if(requestData.route.transaction.amount > 0)  t.'.$t.'.amount = this.route.transaction.amount;
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

RequestData.prototype.txPrepare = function(role0, t, res) {
    
    delete role0.htmlFieldsId;
    delete role0.htmlScript;
    
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
    let transaction0 = {}
    transaction0.role = role0.type;

    if(templateFrom.patternBeforeTimeout != false) transaction0.locktime = templateFrom.patternBeforeTimeoutN.toString(16);

    let inputAddressListTmp = [];
    let outputAddressListTmp = [];
    
    if(role0.amount != 0) {
           
        if(role0.amount > 0) {
        
            inputAddressListTmp = role0.xpubList;
            outputAddressListTmp = templateFrom.xpubList;
        }
        else {
        
            inputAddressListTmp = templateFrom.xpubList;
            outputAddressListTmp = role0.xpubList;
        }
        let inputAddressList = [];
        let outputAddressList = [];
        let allList = [];
                
        for(xpub of inputAddressListTmp) {
        
            if(inputAddressList.includes(xpub) == false) {
            
                inputAddressList.push(xpub);
            } 
            if(allList.includes(xpub) == false) {
            
                allList.push(xpub);
            }
        } 
        for(xpub of outputAddressListTmp) {
        
            if(outputAddressList.includes(xpub) == false) {
            
                outputAddressList.push(xpub);
            } 
            if(allList.includes(xpub) == false) {
            
                allList.push(xpub);
            }
        }                   
        for(xpub of allList) {
        
            if(res.signList.includes(xpub) == false) {
            
                res.signList.push(xpub);
            }
        }            
        let min = 0;
        let max = allList.length;
            
        if(templateFrom.pattern == "all")  min = max;
        else if(templateFrom.pattern == "any") min = 1;
        else min = Math.round(all*templateFrom.pattern);                
        if(templateFrom.pattern == "none") min = 0;
        
        for(xpubOut of outputAddressList) {
                            
            transaction0.amount = Math.round((role0.amount*10000000)/outputAddressList.length)/10000000;
            transaction0.xpubHashSigmin = min;
            transaction0.xpubHashSigmax = max; 
            transaction0.patternAfterTimeoutN = templateFrom.patternAfterTimeoutN;
            transaction0.patternAfterTimeout = templateFrom.patternAfterTimeout;
            transaction0.toXpubHashSig = xpubOut;
            transaction0.fromXpubHashSigList = inputAddressList;
            
            res.txList.push(transaction0);
        }
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
                        
            requestData.pow(requestData.route);
            requestData.sig(requestData.route);
            
            requestData.route.transaction.from.forEach(function(p) { if(t.from.xpubList.indexOf(p) == -1) t.from.xpubList[t.from.xpubList.length] = p;});
            requestData.route.transaction.to.forEach(function(p) { if(t.to.xpubList.indexOf(p) == -1) t.to.xpubList[t.to.xpubList.length] = p;});
            
            for(w0 of wallet.walletsFederation.backup) t.backup.xpubList[t.backup.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.lock) t.lock.xpubList[t.lock.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.witness) t.witness.xpubList[t.witness.xpubList.length] = w0.xpubHash;
            for(w0 of wallet.walletsFederation.cosigner) t.cosigner.xpubList[t.cosigner.xpubList.length] = w0.xpubHash;
                        
            if(requestData.route.transaction.amount > 0) {
            
                t.to.amount = requestData.route.transaction.amount;
                t.to.from = "from";
            }
            if(requestData.route.transaction.amount < 0) {    
            
                t.from.amount = requestData.route.transaction.amount;
                t.from.from = "to";                
            }
            let res = {};
            res.signList = [];
            res.txList = [];     
            var template0 = t;
            '.$res.'
            requestData.validation = res;
            
            console.info(requestData);
            
            delete requestData.request.peerList;
            delete requestData.request.sig.hdPath;
            delete requestData.request.sig.range;
            
            let urlClient = "http://"+requestData.peerList[0].api.connect+"/index.php";            
            const options = {
            
                method: "POST",
                body: JSON.stringify(requestData),
                headers: {
                    "Content-Type": "application/json"
                }
            }
            fetch(urlClient, options)
            .then(res => res.json())
                .then(
                res => {
                        console.log(res);
                    }
                )
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
';
        $c = get_class($this);
        file_put_contents('js/'.$c.'.js', $this->htmlScript);

        return '';
    }
}
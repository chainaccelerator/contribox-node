function Transaction(from = {"xpubList":[],"type":"from","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"htmlFieldsId":[],"htmlScript":""}, to = {"xpubList":[],"type":"to","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"htmlFieldsId":[],"htmlScript":""}, template = "owner_Core_user_user_Identifier_Validation_AskForConfirmationDeclaration_v0", amount = 0, proof = "{data: \"\", version: \"v0\"}", proofSharing = false, user = "{data: \"\", version: \"v0\"}", userProofSharing = false, patternAfterTimeout = false, patternAfterTimeoutN = 0, patternBeforeTimeout = false, patternBeforeTimeoutN = 0, type = ""){

            this.from = from;
this.to = to;
this.template = template;
this.amount = amount;
this.proof = proof;
this.proofSharing = proofSharing;
this.user = user;
this.userProofSharing = userProofSharing;
this.patternAfterTimeout = patternAfterTimeout;
this.patternAfterTimeoutN = patternAfterTimeoutN;
this.patternBeforeTimeout = patternBeforeTimeout;
this.patternBeforeTimeoutN = patternBeforeTimeoutN;
this.type = type;

}
Transaction.prototype.getDataFromForm = function () {

    this.from = document.getElementsByName("from")[0].value;
this.to = document.getElementsByName("to")[0].value;
this.template = document.getElementsByName("template")[0].value;
this.amount = document.getElementsByName("amount")[0].value;
this.proof = document.getElementsByName("proof")[0].value;
this.proofSharing = document.getElementsByName("proofSharing")[0].value;
this.user = document.getElementsByName("user")[0].value;
this.userProofSharing = document.getElementsByName("userProofSharing")[0].value;
this.patternAfterTimeout = document.getElementsByName("patternAfterTimeout")[0].value;
this.patternAfterTimeoutN = document.getElementsByName("patternAfterTimeoutN")[0].value;
this.patternBeforeTimeout = document.getElementsByName("patternBeforeTimeout")[0].value;
this.patternBeforeTimeoutN = document.getElementsByName("patternBeforeTimeoutN")[0].value;
this.type = document.getElementsByName("type")[0].value;

}
Transaction.prototype.createTransaction = function () {
    
}

function Transaction(from = {"xpubList":[],"type":"from","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"htmlFieldsId":[],"htmlScript":""}, to = {"xpubList":[],"type":"to","pattern":"any","patternAfterTimeout":true,"patternAfterTimeoutN":300,"patternBeforeTimeout":false,"patternBeforeTimeoutN":1,"amount":0,"from":"Genesis","state":true,"htmlFieldsId":[],"htmlScript":""}, template = "owner_Core_user_user_Identifier_Validation_AskForConfirmationDeclaration_0", amount = 0, proof = "{data: \"\", version: \"v0\"}", user = "{data: \"\", version: \"v0\"}"){

            this.from = from;
this.to = to;
this.template = template;
this.amount = amount;
this.proof = proof;
this.user = user;

}
Transaction.prototype.getDataFromForm = function () {

    this.from = document.getElementsByName("from")[0].value;
this.to = document.getElementsByName("to")[0].value;
this.template = document.getElementsByName("template")[0].value;
this.amount = document.getElementsByName("amount")[0].value;
this.proof = document.getElementsByName("proof")[0].value;
this.user = document.getElementsByName("user")[0].value;

}
Transaction.prototype.createTransaction = function () {
    
}

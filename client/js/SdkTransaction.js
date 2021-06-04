function Transaction(from = [], to = [], template = "owner_Core_user_user_Identifier_Validation_AskForConfirmationDeclaration_v0", amount = 0, proof = "{data: \"\", version: \"v0\"}", proofEncryptionKey = "", user = "{data: \"\", version: \"v0\"}", userEncryptionKey = ""){

            this.from = from;
this.to = to;
this.template = template;
this.amount = amount;
this.proof = proof;
this.proofEncryptionKey = proofEncryptionKey;
this.user = user;
this.userEncryptionKey = userEncryptionKey;

}
Transaction.prototype.getDataFromForm = function () {

    this.from = document.getElementsByName("from")[0].value;
this.to = document.getElementsByName("to")[0].value;
this.template = document.getElementsByName("template")[0].value;
this.amount = document.getElementsByName("amount")[0].value;
this.proof = document.getElementsByName("proof")[0].value;
this.proofEncryptionKey = document.getElementsByName("proofEncryptionKey")[0].value;
this.user = document.getElementsByName("user")[0].value;
this.userEncryptionKey = document.getElementsByName("userEncryptionKey")[0].value;

}
Transaction.prototype.createTransaction = function () {
    
}

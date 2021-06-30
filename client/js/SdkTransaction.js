function Transaction(fr = [], to = [], template = "", amount = 0, pr = "{data: \"\", version: \"v0\"}", us = "{data: \"\", version: \"v0\"}"){

    this.from = fr;
    this.to = to;
    this.template = template;
    this.amount = amount;
    this.proof = pr;
    this.user = us;

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

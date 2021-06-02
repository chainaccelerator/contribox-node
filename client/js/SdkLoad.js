var Module = {
    onRuntimeInitialized: async function () {
        console.info('onRuntimeInitialized');
        main();
    }
};
window.sodium = {
    onload: function (sodium0) {
        let h = sodium0.crypto_generichash(64, sodium0.from_string('test'));
        console.log(sodium0.to_hex(h));
        sodium=sodium0;
    }
};
function main() {

    if (init() !== 0) {
        alert("initialization failed");
        return;
    }
    console.log("Cleanup and terminating");
};
// START SDK
var sodium;
var template = new Template();
var transaction = new Transaction();
var wallet = new Wallet();
var requestData = new RequestData();
// END SDK


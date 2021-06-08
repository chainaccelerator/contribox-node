
function Walletdb() {

    this.list = [];
    this.loaded = false;
    var db;
    this.request = indexedDB.open("contribox", 2);

    this.request.onupgradeneeded = function(event) {

        let store = event.target.result.createObjectStore("wallets", { keyPath: "name" });
        store.createIndex("name", "name", { unique: true });
        store.createIndex("role", "role", { unique: false });
        store.createIndex("pubkey0", "pubkey0", { unique: true });
        store.createIndex("seedWords", "seedWords", { unique: true });
        store.createIndex("xprv", "xprv", { unique: true });
        store.createIndex("xpub", "xpub", { unique: true });
    };
}
Walletdb.prototype.addNew = function(w, n, r, psw) {

    let t = this.db.transaction(["wallets"], 'readwrite');
    let objectStore = t.objectStore("wallets");

    w.name = n;
    w.psw = psw;

    let objectStoreRequest = objectStore.add(w);

    objectStoreRequest.onsuccess = function(event) {

        console.info("added");
    };
    objectStoreRequest.onerror = function(event) {

        console.info(event);
    };
    return w;
}
Walletdb.prototype.l = async function() {

    let t = walletdb.db.transaction('[wallets]', 'readwrite');
    let objectStore = t.objectStore("wallets");
    this.list = objectStore.getAll();

    return this.list;
}
Walletdb.prototype.clearwallets = async function() {

    await this.store.clear();
    await this.l();
}
window.addEventListener('unhandledrejection', event => {
    alert("Error: " + event.reason.message);
});

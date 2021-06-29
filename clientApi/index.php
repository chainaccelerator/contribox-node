<?php

require_once '../lib/_require.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

SdkReceived::run();

/*

{
    "peerList": [
        {
            "rpcBitcoin": {
            "connect": "",
                "user": "",
                "pwd": ""
            },
            "rpcElements": {
            "connect": "",
                "user": "",
                "pwd": ""
            },
            "api": {
            "connect": "10.10.214.118:7002",
                "user": "",
                "pwd": ""
            }
        }
    ],
    "request": {
    "timestamp": 1624975306845,
        "peerList": [],
        "pow": {
        "nonce": 31692,
            "difficulty": 4,
            "difficultyPatthern": "d",
            "hash": "7e5cebffe6b88b8c49600845a3c06e5296014b114213ee5a35f666c7bed41bc2c853ea576c0f0c2ede63ab225146aed2b0a8da832b2c72590904b770e25be45d",
            "pow": "dddd073085ca6cbef3886ca63da32d8f1ecbd04fbeccce0bd32aff051134b632ffe603e60d112dabec0458e58e09a37f7eb4b0a3d3c63fa56b6927a15f9d2fea",
            "previousHash": "default"
        },
        "sig": {
        "hash": "a52c5a4e3064cb4d32d16ba663b1ce00d5f2c8480a03cd2f619d5d6ee25aa77417a59f68704b6631a830711d2ed336f22a288c81d758df17127c5dff8d81783b",
            "xpub": "tpubD6NzVbkrYhZ4YSHpPfgiqFd75jEGeMit2L4xPKs2373mWWChBjGaHov6DMVLqXB8WAKbX2JQAd81Bi8nU5uiFvHmwWjRsJtuMJApQcynY9i",
            "hdPath": "0/0",
            "range": 0,
            "address": "2dq3kYsVxdu4cJGVwSZvxe3TsGfgyunAn95",
            "signature": "IGj5O14aeefIzmyjJQtTR4NJyiUBwnW9/m3JqWGo0EW6eq53UjcFV2EcxE8uGTxYWa/XIzY36+lARMZMr8/zrFk="
        }
    },
    "route": {
    "id": "default",
        "version": "0.1",
        "env": "regtest",
        "template": "default",
        "transaction": {
        "from": [
            "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756"
        ],
            "to": [],
            "template": "default",
            "amount": 0.0001,
            "proof": {
            "role": "Author",
                "domain": "Core",
                "process": "Core",
                "templateValidation": "default",
                "proofValidation": {
                "state": false,
                    "definition": "",
                    "type": "proofValidation"
                },
                "fromValidation": {
                "state": false,
                    "definition": "",
                    "type": "fromValidation"
                },
                "toValidation": {
                "state": false,
                    "definition": "",
                    "type": ""
                },
                "Genesis": {
                "xpubList": [
                    "be68ac1332ad95d67e3a98df5f31e8ec5390d52057a5a99b266c7eefb3cbf0ef9cfe080196cc312790858f0fd3c25d5788cfd78bbcf00c4d45643494d6e54d9c",
                    "be68ac1332ad95d67e3a98df5f31e8ec5390d52057a5a99b266c7eefb3cbf0ef9cfe080196cc312790858f0fd3c25d5788cfd78bbcf00c4d45643494d6e54d9c",
                    "4305e43692fbdedc43fc1d2fa44ffd6c5489ea2d87e46921a8ca3f72dd873955e8ae84ed81fe29b4f2a785c57a4992dcd77f912e199281d9e8773daae28ed677"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "Genesis"
                },
                "api": {
                "xpubList": [
                    "56a5f1ba261f49fe78a8a58c86e49f847c108582ecc436f9819164fc0fe774191f024e3445f61d02b7c225bd200e1f37acbf09f83c1cec12c6290ee9c2e496e9",
                    "4305e43692fbdedc43fc1d2fa44ffd6c5489ea2d87e46921a8ca3f72dd873955e8ae84ed81fe29b4f2a785c57a4992dcd77f912e199281d9e8773daae28ed677"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "api"
                },
                "from": {
                "xpubList": [
                    "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "from"
                },
                "to": {
                "xpubList": [
                    "bfbea58e01b5934121764c6e699488ec16a7e62f9c1ad1d6940ba3129f0dbef4f3e124aa93218b71d1f6ec169752a010fee35e5d6bc047f6b7057c2703218ff4",
                    "340e560262b6304227a9a097a4f5e2053d618120d28ca392111eccfa03b731b326abb83eeb791b1943bbb0547bdcf3c23fda16c669a9b88ef282097ca04413ea",
                    "340e560262b6304227a9a097a4f5e2053d618120d28ca392111eccfa03b731b326abb83eeb791b1943bbb0547bdcf3c23fda16c669a9b88ef282097ca04413ea"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "to"
                },
                "backup": {
                "xpubList": [
                    "07c8a84b5f18690d11ccdafff7b131af9670013fd7bf7bc82a9dcedbf6ee178ae416e998445dd4729cfa6ac283cdf5c155611c7e753dc4f19826b98952a3802f",
                    "12b547648950810c320b84c372989fda55e145600135944857da9a0cd3b9477cf00163827282938f8fb2eeec31df2d284bf0fb629ed72f2ca592837af7f08db2"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "backup"
                },
                "lock": {
                "xpubList": [
                    "f21742116813e3eb6089f3780e338667c66f8f2121a89eb7aee63ec18094d77693f0b03a460b8ac25b10b9367f14e33530e1164723517d6ca4b6746506b54826",
                    "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "lock"
                },
                "cosigner": {
                "xpubList": [
                    "a8ab904bfc4f53242e694f1ee9c96164c23b2934420ba7325221f69e696879b0d2412149131904948902892ac118f9846795c1dc92b60ebd3d662d115b28413e",
                    "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602",
                    "ec9f796468acfb4fe41c2d6e6235d1e7a00926e1e6d0ac90c1d2de507002f5f92ebda9f6eaf9710fbe4bceee01058a3b59ac499b629f749c4a5d96b606bc8c25"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "cosigner"
                },
                "witness": {
                "xpubList": [
                    "be439967b227a86c04d42c04aa4300c755c8ec246789bc889eaab2c2d19382b1855400639994557badd3d4990f111165e8c0654d5a3534e1f8224356d70dbf84",
                    "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602",
                    "7e346daa8dd73ef00a5eb8c33ff599c6a1871700059543c2eeb741904955861dce6ae52b499dce5ee72e15c165a66e379e8de08c26de56bd8e264996b1cf22d8"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "witness"
                },
                "peg": {
                "xpubList": [
                    "fd587b1bd959d661b68c04b6bba2abc35333f361e4a5455ab3a4b565cea7b8e495fd68f9373b2981c23667c181ca3da09423e01fc508b8b6be13d35807662837",
                    "84f086aa96e527d08e67b8339b5637610ecafdf3fcb1847005a37ba8c7ccecde1ee16fbbc4af8faf763cec87c247d05d7971ff7a9f87c002dd9d723413ea2a52"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "peg"
                },
                "block": {
                "xpubList": [
                    "c64819ce6c22e1225035f74e8cf2aa0906eeb828da94355dd4d5c383411cb0c0a2f92b4ac95832cdd2b4d6470d849bc92ee94d0569d81de5682bebc4155c1905",
                    "4e5583c9de8ba773084631200e2c4d75f8f98ea2b3aba4634a785b80c941ff2a8af92a46a918a023ad365283c591eddc008a2962e2490c11fd559806015aa2d9"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "block"
                },
                "ban": {
                "xpubList": [
                    "3de156b05aa14e010e93582e2357fb1bb59d7c0c940b37e85fc2e15c03f825863043e90acec48bf849b442985572abe608eea1011b9790d433f3108f4c0170de",
                    "3e62b71489406dfead253876433dcbc2b3d6c1504408059c1dfe2a2982f196d43504384897f0fb358f1c6f87e4f91ed82a01221712156d7cab7a3f63ed5c302f"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "ban"
                },
                "board": {
                "xpubList": [
                    "3d5579b8415a1c765e84343c490976ef9ea3d23b278b229d973d4a9b323d557417f291215c305db5344adfe98631d2787c971df716c53de031ab7db60053dbea",
                    "66060bce46be053996fa2af481229d3811ffe5571c291e8d3e7fd6e999ec1e01231101db5df52b11a219913b619f0e42c001cfac605e27be43bcf2bf59bad56c"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "board"
                },
                "member": {
                "xpubList": [
                    "621895e8adf75dda716f121abe5cf450f3b8f33ad2c971b249bce0f8ae93097d50b460adf6b211e8c55275dc49f520ab52d6640d2f213d24a1f138a71d431558",
                    "a2af372e0a4ff5eed49ed08454017f2913de18a0c0ae18b454bbe57c6942a157b2606da99bbb130299079c5c8de4b8bcc161f446f2141476990d980f61236f30"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "member"
                },
                "old": {
                "xpubList": [
                    "972f939c94aab7db907e530a9169056f1e28d140abdbdbae534744877a7e914dfeb0b4e2d73c73324492c7a3539c6d9c3975169ef2d50f642720fa299b4d87ae",
                    "241a0ebd89e367f369321177a77fc3e2f1f9f024323635c92fb52cc376bdeb8a89b2a92a143162c3fef3f54bb1dd2d302cb9e2f562de12443ffc48447041e46b"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "old"
                },
                "cosignerOrg": {
                "xpubList": [
                    "3331516c42de0b9768a0db1c171edf9278830281ba35a59b2e466a984b6601c9e17f510e983f132c5ec5a92fc972fa0c4e749690ae9776f3433f0ffe06f9fd59",
                    "b8b773c5d3d593aa71767fb8a228e9dfd9139c6955125c7ae6c112dd282f6c4d5a94d9fe876dcbac3c2f57c55e4419019b6dfc142db8d8e6eab2efde5e40aed4"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "cosignerOrg"
                },
                "witnessOrg": {
                "xpubList": [
                    "33107a16ab4230abe5f81703befbfe11c532b19a6e39417aa786d145cb781e4545e30a36862fefa447a00f41b3ace7806218287f4641ecc0c5fc8849e36db4ec",
                    "e1d8559a38a59f36a082c61e3efc5c6c84e68dbbb7634e0b2eb456784e1c6b82262ea3ff37e7d07e95aa783c6c5536233eb8a55304de65a1ba5fd67b080c93cf"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "witnessOrg"
                },
                "info": {
                "xpubList": [
                    "b29fa11a1815439bd1d89add31f5bb7b87253ebcc87e498df9082e78160662d779f4c94add2d1e386dd511cb2896f380efc087f4404ea1d7121355e680d108e0",
                    "e81e03fc5acb2e0e1b4c2395aabd5fe960a5074b2e4b73bd77e09707050b5c0d2191afe951d728768980186a77083d73e0fd3400e6d4f414db52a59371d6195a",
                    "e81e03fc5acb2e0e1b4c2395aabd5fe960a5074b2e4b73bd77e09707050b5c0d2191afe951d728768980186a77083d73e0fd3400e6d4f414db52a59371d6195a"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "info"
                },
                "parentstype1": {
                "xpubList": [
                    "57f6b7eb7cd065166ab32f7e54500349549d886959e96b7fc824bf727ac0ced94782425196e647f43522259e81e746378b975bebb92556ae6449338d80459e26",
                    "d36592e797ed1ca2e0dd68e5bdb90307545b0cf9a3ce44ab33c53c117d117ed657ac31dd5ab4c4d52a368f59a2035898c1b76bce2f3a1959225b42c37f2df8e2"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "parentstype1"
                },
                "childstype1": {
                "xpubList": [
                    "8aa5f5d246bd7ad8bc5228e960ae53cd82c81af77dd35e8bc4b5ca0f49fea50eb4dc8adb2d617a604398eb1db221d46c06cd781067b276baffa4490933ca02a6",
                    "d36592e797ed1ca2e0dd68e5bdb90307545b0cf9a3ce44ab33c53c117d117ed657ac31dd5ab4c4d52a368f59a2035898c1b76bce2f3a1959225b42c37f2df8e2"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "childstype1"
                },
                "investorType1": {
                "xpubList": [
                    "d36592e797ed1ca2e0dd68e5bdb90307545b0cf9a3ce44ab33c53c117d117ed657ac31dd5ab4c4d52a368f59a2035898c1b76bce2f3a1959225b42c37f2df8e2"
                ],
                    "pattern": "none",
                    "patternAfterTimeoutN": 300,
                    "patternBeforeTimeoutN": 1,
                    "amount": 0,
                    "from": "Genesis",
                    "state": true,
                    "proofSharing": true,
                    "userProofSharing": true,
                    "patternAfterTimeout": false,
                    "patternBeforeTimeout": false,
                    "type": "investorType1"
                },
                "name": "AuthorCoreundefinedundefinedCoreundefinedundefinedundefined",
                "hash": "b5162c57b8c583583827b4499d72fcdeedf0fd52a50ff5ce427952d7a410f92e6922b63a54ce6ea10f85d0daa02f15be9ac5382b4933c5ced6f412b00d813bad"
            },
            "user": {
            "firstname": "",
                "lastname": "",
                "identityId": "",
                "professionalId": "",
                "identityIdProof1": {},
                "professionalIdProof1": {},
                "identityToken": "2251510142,3301546408,995849601,3260441346,2648717747,3319993623,3577860831,191273867,3517213062,2025631252"
            }
        }
    },
    "validation": {
    "txList": [
            {
                "role": "backup",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "6b0d4c1db36f38b44b882c7366cc0dcff48c0199e09eb1f4bd97bb35f6b11af4b749faf6ab62be1099f3a0337cbf2d40fe2ae6629b76143f988f2edfd5713122",
                "12b547648950810c320b84c372989fda55e145600135944857da9a0cd3b9477cf00163827282938f8fb2eeec31df2d284bf0fb629ed72f2ca592837af7f08db2"
            ]
            },
            {
                "role": "backup",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "6b0d4c1db36f38b44b882c7366cc0dcff48c0199e09eb1f4bd97bb35f6b11af4b749faf6ab62be1099f3a0337cbf2d40fe2ae6629b76143f988f2edfd5713122",
                "12b547648950810c320b84c372989fda55e145600135944857da9a0cd3b9477cf00163827282938f8fb2eeec31df2d284bf0fb629ed72f2ca592837af7f08db2"
            ]
            },
            {
                "role": "lock",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "bf66bb59775e761887afbb7141d58c862c290908c63790ae4b4c66ed30acdab756816f452dd09f15b114d5cec536247bfe15c6c7b2536e497cc6275ec23170d7",
                "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602"
            ]
            },
            {
                "role": "lock",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "bf66bb59775e761887afbb7141d58c862c290908c63790ae4b4c66ed30acdab756816f452dd09f15b114d5cec536247bfe15c6c7b2536e497cc6275ec23170d7",
                "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602"
            ]
            },
            {
                "role": "witness",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "31dbf467606302dedc0ca5f820fe0239a9d6c033af54ce4a168e770cb92ae24675e7f4baa615005959c12b58c9a7c9449e57d81a6cef05508f44d03b91d04022",
                "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602"
            ]
            },
            {
                "role": "witness",
                "amount": 0.000005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 4,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "31dbf467606302dedc0ca5f820fe0239a9d6c033af54ce4a168e770cb92ae24675e7f4baa615005959c12b58c9a7c9449e57d81a6cef05508f44d03b91d04022",
                "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602"
            ]
            },
            {
                "role": "to",
                "amount": 0.00005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 3,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "6935e4ab9feb4217c43f9c675585b1345b08a8218b67139fbea953cdb3e36487be48019966e5f61dfe6534fbfcba14f922ca7725102f773e0138fda37183fb72"
            ]
            },
            {
                "role": "to",
                "amount": 0.00005,
                "xpubHashSigmin": 1,
                "xpubHashSigmax": 3,
                "patternAfterTimeoutN": 300,
                "patternAfterTimeout": true,
                "toXpubHashSig": "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
                "fromXpubHashSigList": [
                "6935e4ab9feb4217c43f9c675585b1345b08a8218b67139fbea953cdb3e36487be48019966e5f61dfe6534fbfcba14f922ca7725102f773e0138fda37183fb72"
            ]
            }
        ],
        "signList": [
        "6b0d4c1db36f38b44b882c7366cc0dcff48c0199e09eb1f4bd97bb35f6b11af4b749faf6ab62be1099f3a0337cbf2d40fe2ae6629b76143f988f2edfd5713122",
        "12b547648950810c320b84c372989fda55e145600135944857da9a0cd3b9477cf00163827282938f8fb2eeec31df2d284bf0fb629ed72f2ca592837af7f08db2",
        "c52ea234667f63d384f941149c8af438fb04c94ec2dc0ff066381e690d006184ba055adce53aa8e86358632b3fd96316f2bdc19a3d398cdc6af7a3ffa48fb4fe",
        "79e9758cfdfdd389eba2b7da6733e2e05f3bcff0243154826f7f5cfd4f9eb9a4065dba8fefb9b1f1a780b4e933b0692d0a98eafe5bbf719c93fc006ce0f44756",
        "bf66bb59775e761887afbb7141d58c862c290908c63790ae4b4c66ed30acdab756816f452dd09f15b114d5cec536247bfe15c6c7b2536e497cc6275ec23170d7",
        "39d5315f1feb60b8ef78cbdc5009034c6c7620d7f2ee61cc3fb52bf657c828f811f68e5dbc354238fe268097b050919fea1a0432d46b404a1e47620e3ab3e602",
        "31dbf467606302dedc0ca5f820fe0239a9d6c033af54ce4a168e770cb92ae24675e7f4baa615005959c12b58c9a7c9449e57d81a6cef05508f44d03b91d04022",
        "6935e4ab9feb4217c43f9c675585b1345b08a8218b67139fbea953cdb3e36487be48019966e5f61dfe6534fbfcba14f922ca7725102f773e0138fda37183fb72"
    ]
    }
}

 */



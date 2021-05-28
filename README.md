# contribox-node

Install an Elements sidechain peg on Bitcoin with a dynamic federation (https://blockstream.com/elements/).

Install a specific API on top of node for the relay for the sharing between user : templates (decentralized referential), transactions, encrypted proofs, and signs.

Provide a JS Sdk for using this API with a wasm module for transactions building and (multi)signing without a node dependency.

Confidential, free, fast transactions, uniq assets and proof' issuements, without smart contract centralisation but:
* Validation is on the client side, until the Elements blockchain' blocs validation
* Certification is on the Elements side, until peg out validations
* Templates allow to ask a reward for specifics validations

Full native web integration without app or plug-in.

For now:
* Not condifidential addresses, transactions and issuements (until Elements allow it)
* Not a pure dynamic federation (until Elements allow it)
* Wallets storage (secured by multisignatures) encrypted into Javascript indexDB into navigators for a specific URL (node IP:port)
* Tested on Regtest only

## Install a sidechain's node

On debian 10 stable, with root:

<external IP (option)> is required if you want to accept requests from other nodes

    # apt install curl -y && curl -o install_node.sh https://raw.githubusercontent.com/chainaccelerator/contribox-node/main/install/install_node.sh && bash install_node.sh <chain ex:regtest> <user ex:Nicolas> <first node IP to connect ex: 10.0.0.14> <external IP (option)> 

## Install a sidechain

On debian 10 stable, with root:

    # apt install curl -y && curl -o install_sidechain.sh https://raw.githubusercontent.com/chainaccelerator/contribox-node/main/install/install_sidechain.sh && bash install_sidechain.sh <chain ex:regtest> <user ex:Nicolas> <external IP>

## Configure (Optional)

<env ex:regtest>/conf/install.json

#### For nodes and sidechains install

    "BC_ENV": "regtest" Mainchain and Elements chain name
    "NUMBER_NODES": 3, Nodes to run
    "API_PORT": "9002", Global custom API on top of the node
    "BC_WEB_ROOT_DIR": "/var/www", Global application path
    "BC_GIT_INSTALL": "https://github.com/chainaccelerator/contribox-node.git",
    "BITCOIN_VERSION": "0.21.1", Bitcoin version to install
    "ELEMENTS_VERSION": "0.18.1.11", Elements version to install
    "PHP_V": "8.0.5", PHP version to install
    "PORT_PREFIX_SERVER": "71", Port prefix for both Bitcoin and Elements
    "PORT_PREFIX_RPC": "72", Port prefix for both Bitcoin and Elements RPC
    "BC_SERVER_DIR": "/opt", Symbolic link to OS directories for the application
    "BITCOIN_DATA_ROOT_PATH": "/var/bitcoin", Symbolic link to OS directories for Bitcoin datas
    "BITCOIN_CONF_ROOT_PATH": "/etc/bitcoin", Symbolic link to OS directories for Bitcoin configuration
    "BITCOIN_LOG_ROOT_PATH": "/var/log/bitcoin", Symbolic link to OS directories for Bitcoin logs
    "ELEMENTS_DATA_ROOT_PATH": "/var/elements", Symbolic link to OS directories for Elements datas
    "ELEMENTS_LOG_ROOT_PATH": "/var/log/elements", Symbolic link to OS directories for Elements logs
    "ELEMENTS_CONF_ROOT_PATH": "/etc/elements",Symbolic link to OS directories for Elements Configuration
    "QT": 1, Is Bitcoind and ELementsd are lunched with their interfaces or not
    "PEG_SIGNER_AMOUNT": 0.0001, Recommanded amount for be able to sign the pegs (in Bitcoins)
    "BLOCK_SIGNER_AMOUNT": 0.0001, Recommanded amount for be able to sign the blocks (in Bitcoins)
    "NODE_AMOUNT": 0.0001, Recommanded a for be able to publis a node (in Bitcoins)
    "NODE_INITIAL_AMOUNT": 21000000, Initial sidechain tokens
    "BACKUP_AMOUNT": 0.0001, Recommanded a for ask for a backup a wallet (in Bitcoins)
    "WITNESS_AMOUNT": 0.0001, Recommanded a for ask for a co-sign a wallet (in Bitcoins)
    "LOCK_AMOUNT": 0.0001, Recommanded amount for ask for a lock a wallet (in Bitcoins)
    "PEG_AMOUNT": 0.0001, Recommanded amount for ask for a peg (in Bitcoins)
    "BLOCK_AMOUNT": 0.0001, Recommanded amount for ask for a lock a wallet (in Bitcoins)
    "PEG": 1, If a test of peg is needed (only for the first intall)

#### For sidechains install only (do not change for a node install)

    "BITCOIN_MAIN_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create
    "BITCOIN_PEG_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create for pegs
    "BITCOIN_BLOCK_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create for mine (regtest and test environments only)
    "PEG_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for peg in/out (multisignatures)
    "BLOCK_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for sign the blocs (multisignatures)
    "BLOCK_PARTICIPANT_MAX": 5, Number max of participant to select of the block sign into the 15 max total signatures
    "BLOCK_PARTICIPANT_MIN": 1, Number min of participant to select of the block sign into the 15 max total signatures
    "PEG_PARTICIPANT_MAX": 5, Number max of participant to select of the peg sign into the 15 max total signatures
    "PEG_PARTICIPANT_MIN": 1, Number min of participant to select of the peg sign into the 15 max total signatures
    "PEG_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for this role
    "BLOCK_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for this role
    "MAIN_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "FROM_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "TO_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "NODE_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "LOCK_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "BACKUP_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "COSIGNER_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "WITNESS_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "SHARE_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "OLD_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "MEMBER_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "BOARD_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "BAN_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "WITNESSORG_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "COSIGNEROR_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "PARENTTYPE1_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role
    "CHILDTYPE1_PARTICIPANT_NUMBER":3, Number of Elements wallet to create for this role

 




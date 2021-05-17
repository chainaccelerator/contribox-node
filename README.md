# contribox-node

## Configure

<env ex:regtest>/conf/install.json

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
    "BITCOIN_MAIN_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create
    "BITCOIN_PEG_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create for pegs
    "BITCOIN_BLOCK_PARTICIPANT_NUMBER": 15, Number of bitcoin wallet to create for mine (regtest and test environments only)
    "BACKUP_PARTICIPANT_NUMBER": 3, Number of Elements wallet to create for backup other wallets (multisignatures)
    "WITNESS_PARTICIPANT_NUMBER": 3, Number of Elements wallet to create for co-sign other wallets (multisignatures)
    "LOCK_PARTICIPANT_NUMBER": 3, Number of Elements wallet to create for lock other wallets (multisignatures)
    "PEG_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for peg in/out (multisignatures)
    "BLOCK_PARTICIPANT_NUMBER": 15, Number of Elements wallet to create for sign the blocs (multisignatures)
    "PEG_SIGNER_AMOUNT": 0.0001, Recommanded amount for be able to sign the pegs (in Bitcoins)
    "BLOCK_SIGNER_AMOUNT": 0.0001, Recommanded amount for be able to sign the blocks (in Bitcoins)
    "NODE_AMOUNT": 0.0001, Recommanded a for be able to publis a node (in Bitcoins)
    "NODE_INITIAL_AMOUNT": 21000000, Recommanded a of initial tokens
    "BACKUP_AMOUNT": 0.0001, Recommanded a for ask for a backup a wallet (in Bitcoins)
    "WITNESS_AMOUNT": 0.0001, Recommanded a for ask for a co-sign a wallet (in Bitcoins)
    "LOCK_AMOUNT": 0.0001, Recommanded amount for ask for a lock a wallet (in Bitcoins)
    "PEG_AMOUNT": 0.0001, Recommanded amount for ask for a peg (in Bitcoins)
    "BLOCK_AMOUNT": 0.0001, Recommanded amount for ask for a lock a wallet (in Bitcoins)
    "PEG": 1, If a test of peg is needed (only for the first intall)
    "BLOCK_PARTICIPANT_MAX": 5, Number max of participant to select of the block sign into the 15 max total signatures
    "BLOCK_PARTICIPANT_MIN": 1, Number min of participant to select of the block sign into the 15 max total signatures
    "PEG_PARTICIPANT_MAX": 5, Number max of participant to select of the peg sign into the 15 max total signatures
    "PEG_PARTICIPANT_MIN": 1, Number min of participant to select of the peg sign into the 15 max total signatures

## Install a node

On debian, with root:

    # apt install curl -y && curl -o install_node.sh https://raw.githubusercontent.com/chainaccelerator/contribox-node/main/install/install_node.sh && bash install_node.sh <chain ex:regtest> <user ex:Nicolas> <file rights ex:077> <external IP> <host IP> <first node IP to connect ex: 10.0.0.14>

## Install a sidechain

On debian, with root:

    # if [ ! -d "/var/www" ];then
    #   mkdir "/var/www"
    #   chmod <user ex:Nicolas> "/var/www"
    #   chown <file rights ex:077> "/var/www"
    # fi
    # if [ -d "/var/www/contribox-node" ];then    
    #   rm -rf /var/www/contribox-node
    # fi
    # apt install git -y
    # git clone 'https://github.com/chainaccelerator/contribox-node.git' /var/www/contribox-node
    # cd /var/www/contribox-node/install
    # source /var/www/contribox-node/install/install_sidechain.sh <chain ex:regtest> 1 <user ex:Nicolas> <file rights ex:077> <external IP> <host IP> <first node IP to connect ex: 10.0.0.14>

 




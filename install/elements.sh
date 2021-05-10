#!/bin/bash

shopt -s expand_aliases

echo ""
echo -e "${CYAN_LIGHT}[NODE ELEMENTS $1]$NCOLOR"
export BC_INST=$1
export BITCOIN_CONF_FILE=$2
export BITCOIN_WALLET_CONF_FILE=$3
export BLOCK_REDEEMSCRIPT="$4"
export PEG_REDEEMSCRIPT="$5"
export BLOCK_SIGN_PUBKEY_LIST="$6"
export PEG_SIGN_PUBKEY_LIST="$7"
# echo "BC_INST=$BC_INST"
# echo "BITCOIN_CONF_FILE=$BITCOIN_CONF_FILE"
# echo "BITCOIN_WALLET_CONF_FILE=$BITCOIN_WALLET_CONF_FILE"
# echo "BLOCK_SIGN_PUBKEY_LIST=$BLOCK_SIGN_PUBKEY_LIST"
# echo "PEG_SIGN_PUBKEY_LIST=$PEG_SIGN_PUBKEY_LIST"
# $BC_SERVER_DIR
# $ELEMENTS_VERSION
# $APT_UPDATE_UPGRADE
# $BC_ENV

export ELEMENTS_DIR=$BC_SERVER_DIR/elements-$ELEMENTS_VERSION/bin
if [ ! -d $ELEMENTS_DIR ]; then

  if [ $APT_UPDATE_UPGRADE -eq 1 ]; then
    apt install build-essential libtool autotools-dev autoconf pkg-config libssl-dev -y -qq
    apt install libboost-all-dev -y -qq
    apt install libqt5gui5 libqt5core5a libqt5dbus5 qttools5-dev qttools5-dev-tools libprotobuf-dev protobuf-compiler imagemagick librsvg2-bin -y -qq
    apt install libqrencode-dev autoconf openssl libssl-dev libevent-dev -y -qq
    apt install libminiupnpc-dev -y -qq
  fi
  cd $BC_SERVER_DIR
  ELEMENTS_INSTALL="elements-$ELEMENTS_VERSION-x86_64-linux-gnu.tar.gz"
  wget "https://github.com/ElementsProject/elements/releases/download/elements-$ELEMENTS_VERSION/$ELEMENTS_INSTALL"
  tar -xvzf $ELEMENTS_INSTALL
  rm $ELEMENTS_INSTALL
fi

if [ "$BC_ENV" == "mainnet" ]; then
  export ELEMENTS_ENV_INDEX="1"
  export ELEMENTS_CHAIN_VAL="main"
fi
if [ "$BC_ENV" == "regtest" ]; then
  export ELEMENTS_ENV_INDEX="2"
  export ELEMENTS_CHAIN_VAL="elementsregtest"
fi
if [ "$BC_ENV" == "testnet" ]; then
  export ELEMENTS_ENV_INDEX="3"
  export ELEMENTS_CHAIN_VAL="elementsregtest"
fi
if [ "$BC_ENV" == "liquidmainnet" ]; then
  export ELEMENTS_ENV_INDEX="4"
  export ELEMENTS_CHAIN_VAL="liquidv1"
fi
if [ "$BC_ENV" == "liquidregtest" ]; then
  export ELEMENTS_ENV_INDEX="5"
  export ELEMENTS_CHAIN_VAL="liquidregtest"
fi
if [ "$BC_ENV" == "liquidtestnet" ]; then
  export ELEMENTS_ENV_INDEX="6"
  export ELEMENTS_CHAIN_VAL="liquidtestnet"
fi
export NODE1=$(expr $BC_INST - 1)
export NODE2=$(expr $BC_INST - 2)
export NODE_CONNECT=$(expr $BC_INST - 1)
if [ $BC_INST -eq 1 ]; then
  NODE1=2
  NODE2=3
  NODE_CONNECT=2
fi
if [ $BC_INST -eq 2 ]; then
  NODE2=3
fi
export ENV2=$BC_ENV"_"$BC_INST
export ELEMENTS_CONF_FILE=$BC_CONF_DIR/"elements_"$ENV2".conf"
export ELEMENTS_DATA_PATH=$ELEMENTS_DATA_ROOT_PATH/$ENV2
export ELEMENTS_HOST_IP=$HOST_IP
export ELEMENTS_BIND="bind=$ELEMENTS_HOST_IP"
export ELEMENTS_RPC_BIND_VAL="$ELEMENTS_HOST_IP"
export ELEMENTS_RPC_BIND="rpcbind=$ELEMENTS_RPC_BIND_VAL"
export ELEMENTS_CHAIN="chain=$ELEMENTS_CHAIN_VAL"
export ELEMENTS_SECTION="[$ELEMENTS_CHAIN_VAL]"
export ELEMENTS_SECTION_ACTIVE="[$ELEMENTS_CHAIN_VAL]"
export ELEMENTS_SECTION_PREFIX="$ELEMENTS_CHAIN_VAL."
export PORT_ELEMENTS=$PORT_PREFIX_SERVER$ELEMENTS_ENV_INDEX$BC_INST
export PORT_ELEMENTS_RPC=$PORT_PREFIX_RPC$ELEMENTS_ENV_INDEX$BC_INST
export MAINCHAIN_RPC_BIND="mainchainrpchost=$BITCOIN_RPC_BIND_VAL"
export MAINCHAIN_RPC_PORT="mainchainrpcport=$PORT_BITCOIN_RPC"
export MAINCHAIN_RPC_USER="mainchainrpcuser=$BITCOIN_RPC_USER_VAL"
export MAINCHAIN_RPC_PASSWORD="mainchainrpcpassword=$BITCOIN_RPC_PASSWORD_VAL"
export ELEMENTS_PORT="port=$PORT_ELEMENTS"
export ELEMENTS_RPC_PORT_VAL=$PORT_ELEMENTS_RPC
export ELEMENTS_RPC_PORT="rpcport=$ELEMENTS_RPC_PORT_VAL"
export ELEMENTS_RPC_USER_VAL="e_"$BC_ENV"_"$BC_INST
export ELEMENTS_RPC_USER="rpcuser=$ELEMENTS_RPC_USER_VAL"
export ELEMENTS_RPC_PASSWORD_VAL="e_mdp_$BC_ENV"_"$BC_INST"
export ELEMENTS_RPC_PASSWORD="rpcpassword=$ELEMENTS_RPC_PASSWORD_VAL"
export ELEMENTS_DATADIR_VAL="$ELEMENTS_DATA_PATH"
export ELEMENTS_DATADIR="datadir=$ELEMENTS_DATADIR_VAL"
export WALLET_URI=$(elementsGetWalletUri "$BC_ENV" $BC_INST 0 "node" "$ELEMENTS_DATADIR_VAL" "$ELEMENTS_CHAIN_VAL")
export ELEMENTS_DEBUG_FILE_VAL="$BC_APP_LOG_DIR/elementsd_$ENV2.log"
rm -rf $ELEMENTS_DEBUG_FILE_VAL
export ELEMENTS_DEBUG_FILE="debuglogfile=$ELEMENTS_DEBUG_FILE_VAL"
export ELEMENTS_ADD_NODE1="addnode=$ELEMENTS_HOST_IP:$PORT_PREFIX_SERVER$ELEMENTS_ENV_INDEX$NODE1"
export ELEMENTS_ADD_NODE2="addnode=$ELEMENTS_HOST_IP:$PORT_PREFIX_SERVER$ELEMENTS_ENV_INDEX$NODE2"
export ELEMENTS_CONNECT="connect=$ELEMENTS_HOST_IP:$PORT_PREFIX_SERVER$ELEMENTS_ENV_INDEX$NODE_CONNECT"
export ELEMENTS_PARAMS="-conf="$ELEMENTS_CONF_FILE
export NODE_INSTANCE=$BC_INST
export WALLET_INSTANCE=1
export NODE_CONF_FILE=$BC_CONF_DIR/e_node_${BC_ENV}_${NODE_INSTANCE}.json
export ELEMENTS_NOTIFY="walletnotify=\"bash $BC_APP_SCRIPT_DIR/notify.sh $BC_ENV %s\""
export ENV2=$BC_ENV"_"$NODE_INSTANCE
export CLI="$ELEMENTS_DIR/elements-cli $ELEMENTS_PARAMS -rpcconnect=$ELEMENTS_RPC_BIND_VAL -rpcport=$ELEMENTS_RPC_PORT_VAL -rpcuser='$ELEMENTS_RPC_USER_VAL' -rpcpassword='$ELEMENTS_RPC_PASSWORD_VAL'"
export E_DEAMON="${ELEMENTS_DIR}/elementsd ${ELEMENTS_PARAMS}"
export E_QT="${ELEMENTS_DIR}/elements-qt ${ELEMENTS_PARAMS}"
export E_DEBUG="tail -f ${ELEMENTS_DEBUG_FILE}"
export E_CLI="${CLI}"
export E_CLI_CREATEWALLET="${CLI} createwallet"
export E_CLI_LOADWALLET="${CLI} loadwallet"
export E_CLI_GETNEWADDRESS2="${CLI} getnewaddress"
export E_CLI_DUMPPRIVKEY2="${CLI} dumpprivkey"
export E_CLI_DUMPWALLET2="${CLI} dumpwallet"
export E_CLI_STOP="${CLI} stop"
export E_CLI_GENERATETOADDRESS2="${CLI} generatetoaddress"
export E_CLI_GETWALLETINFO2="${CLI} getwalletinfo"
export E_CLI_GETTRANSACTION2="${CLI} gettransaction"
export E_CLI_SENDTOADDRESS2="${CLI} sendtoaddress"
export E_CLI_GETSIDECHAININFO2="${CLI} getsidechaininfo"
export E_CLI_GETBLOCKCOUNT="${CLI} getblockcount"
export E_CLI_GETMEMPOOL="${CLI} getmempoolinfo"
export E_CLI_GETPEERINFO="${CLI} getpeerinfo"
export E_CLI_GETTOUT="${CLI} gettxout"
export E_CLI_CREATEMULTISIG="${CLI} createmultisig"
export E_DATA_BASE_DIR=$ELEMENTS_DATADIR_VAL
export ELEMENTS_API_BIND_VAL=${ELEMENTS_RPC_BIND_VAL}
export ELEMENTS_API_PORT_VAL="800"${BC_INST}

if [ -z $BLOCK_REDEEMSCRIPT ];then
    export BLOCKSCRIPT='signblockscript=51'
else
    export BLOCKSCRIPT=$(echo -e "\nsignblockscript=${BLOCK_REDEEMSCRIPT}\ncon_max_block_sig_size=150\ncon_dyna_deploy_start=9999999999999")
fi
if [ -z $PEG_REDEEMSCRIPT ];then
    export PEGSCRIPT='fedpegscript=51'
else
    export PEGSCRIPT=$(echo -e "\nfedpegscript=${PEG_REDEEMSCRIPT}")
fi
if [ -z "$BLOCK_SIGN_PUBKEY_LIST" ];then
    BLOCK_SIGN_PUBKEY_LIST='[]'
fi
if [ -z "$PEG_SIGN_PUBKEY_LIST" ];then
    PEG_SIGN_PUBKEY_LIST='[]'
fi

cat >$ELEMENTS_CONF_FILE <<EOL

${ELEMENTS_CHAIN}
${ELEMENTS_DATADIR}
${ELEMENTS_DEBUG_FILE}
${MAINCHAIN_RPC_BIND}
${MAINCHAIN_RPC_PORT}
${MAINCHAIN_RPC_USER}
${MAINCHAIN_RPC_PASSWORD}
daemon=1
txindex=1
listen=1
server=1
debug=1
validatepegin=1
${BLOCKSCRIPT}
${PEGSCRIPT}

blindedaddresses=0
initialfreecoins=2100000000000000
blockmintxfee=0.00000000
minrelaytxfee=0.00000000
txconfirmtarget=1
printtoconsole=1
noonion=1
listenonion=0
logips=1
fallbackfee=0.0002
whitelist=127.0.0.1
whitelist=${HOST_IP}
whitelist=${EXTERNAL_IP}
whitelist=192.168.1.45
# externalip=${EXTERNAL_IP}
rpcallowip=127.0.0.1
rpcallowip=${HOST_IP}
rpcallowip=${EXTERNAL_IP}
rpcallowip=192.168.1.45
${ELEMENTS_NOTIFY}
choosedatadir=0
lang=FR
min=1
splash=0

${ELEMENTS_SECTION}
# ${ELEMENTS_CONNECT}
${ELEMENTS_BIND}
${ELEMENTS_PORT}
${ELEMENTS_ADD_NODE1}
${ELEMENTS_ADD_NODE2}
${ELEMENTS_RPC_USER}
${ELEMENTS_RPC_PASSWORD}
${ELEMENTS_RPC_BIND}
${ELEMENTS_RPC_PORT}
EOL

# echo "ELEMENTS_CONF_FILE=$ELEMENTS_CONF_FILE"
chmod $BC_RIGHTS_FILES $ELEMENTS_CONF_FILE
chown $BC_USER $ELEMENTS_CONF_FILE

serverStart "$ELEMENTS_CONF_FILE" "$E_DATA_BASE_DIR" "$QT" "$E_QT" "$E_DEAMON" 1 1 "$E_CLI_STOP"

export wallet_nameBitcoin=$(eval "cat ${BITCOIN_WALLET_CONF_FILE} | jq '.wallet_name'")
wallet_nameBitcoin=$(eval echo $wallet_nameBitcoin)
export wallet_uriBitcoin=$(eval "cat ${BITCOIN_WALLET_CONF_FILE} | jq '.wallet_uri'")
wallet_uriBitcoin=$(eval echo $wallet_uriBitcoin)
export pubAddressBitcoin=$(eval "cat ${BITCOIN_WALLET_CONF_FILE} | jq '.pubAddress'")
pubAddressBitcoin=$(eval echo $pubAddressBitcoin)
export B_CLI_GETWALLETINFO=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETWALLETINFO')
export B_CLI_SENDTOADDRESS=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_SENDTOADDRESS')
export B_CLI_GENERATETOADDRESS=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GENERATETOADDRESS')
export B_CLI_GETPEGINADDRESS=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETPEGINADDRESS')
export BITCOIN_pubAddress=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.pubAddress')
export B_CLI_GETTXOUTPROOF=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETTXOUTPROOF')
export B_CLI_GETRAWTRANSACTION=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETRAWTRANSACTION')  
export B_CLI_GETBLOCKCOUNT=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETBLOCKCOUNT')
export B_CLI_GETTOUT=$(cat ${BITCOIN_WALLET_CONF_FILE} | jq -r '.B_CLI_GETTOUT')
  
cat > $NODE_CONF_FILE <<EOL
{
  "WALLET_URI": "${ELEMENTS_DATA_PATH}/${ELEMENTS_CHAIN_VAL}/wallets/wallet.dat",
  "BLOCK_REDEEMSCRIPT": "${BLOCK_REDEEMSCRIPT}",
  "PEG_REDEEMSCRIPT": "${PEG_REDEEMSCRIPT}",
  "BLOCK_SIGN_PUBKEY_LIST": ${BLOCK_SIGN_PUBKEY_LIST},
  "PEG_SIGN_PUBKEY_LIST": ${PEG_SIGN_PUBKEY_LIST},
  "BC_ENV": "${BC_ENV}",
  "NODE_INSTANCE": "${BC_INST}",
  "ELEMENTS_DATA_ROOT_PATH": "${ELEMENTS_DATA_ROOT_PATH}",
  "BC_CONF_DIR": "${BC_CONF_DIR}",
  "ELEMENTS_API_BIND_VAL": "${ELEMENTS_API_BIND_VAL}",
  "ELEMENTS_API_PORT_VAL": "${ELEMENTS_API_PORT_VAL}",
  "ELEMENTS_RPC_USER_VAL": "${ELEMENTS_RPC_USER_VAL}",
  "ELEMENTS_RPC_PASSWORD_VAL": "${ELEMENTS_RPC_PASSWORD_VAL}",
  "ELEMENTS_RPC_BIND_VAL": "${ELEMENTS_RPC_BIND_VAL}",
  "ELEMENTS_RPC_PORT_VAL": "${ELEMENTS_RPC_PORT_VAL}",
  "ELEMENTS_DATADIR_VAL": "${ELEMENTS_DATADIR_VAL}",
  "ELEMENTS_CONF_ROOT_PATH": "${ELEMENTS_CONF_ROOT_PATH}",
  "ELEMENTS_CHAIN_VAL": "${ELEMENTS_CHAIN_VAL}",
  "ELEMENTS_PARAMS": "${ELEMENTS_PARAMS}",
  "QT": "${QT}",
  "ELEMENTS_DEBUG_FILE": "${ELEMENTS_DEBUG_FILE}",
  "BITCOIN_CONF_FILE": "${BITCOIN_CONF_FILE}",
  "BITCOIN_WALLET_CONF_FILE": "${BITCOIN_WALLET_CONF_FILE}",
  "BC_APP_SCRIPT_DIR": "${BC_APP_SCRIPT_DIR}",
  "BC_APP_DATA_DIR": "${BC_APP_DATA_DIR}",
  "BC_APP_API_DIR": "${BC_APP_API_DIR}",
  "BC_APP_INSTALL_DIR": "${BC_APP_INSTALL_DIR}",
  "BC_APP_DIR": "${BC_APP_DIR}",
  "BC_APP_LOG_DIR": "${BC_APP_LOG_DIR}",
  "NUMBER_NODES": "${NUMBER_NODES}",
  "MBLOCK_PARTICIPANT_NUMBER": "${BLOCK_PARTICIPANT_NUMBER}",
  "PEG_PARTICIPANT_NUMBER": "${PEG_PARTICIPANT_NUMBER}",
  "HOST_IP": "${HOST_IP}",
  "EXTERNAL_IP": "${EXTERNAL_IP}",
  "BC_USER": "${BC_USER}",
  "BC_RIGHTS_FILES": "${BC_RIGHTS_FILES}",
  "BC_WEB_ROOT_DIR": "${BC_WEB_ROOT_DIR}",
  "ENV2": "${ENV2}",
  "CLI": "${CLI}",
  "E_DEAMON": "${E_DEAMON}",
  "E_QT": "${E_QT}",
  "E_DEBUG": "${E_DEBUG}",
  "E_CLI": "${E_CLI}",
  "E_CLI_CREATEWALLET": "${E_CLI_CREATEWALLET}",
  "E_CLI_LOADWALLET": "${E_CLI_LOADWALLET}",
  "E_CLI_GETNEWADDRESS2": "${E_CLI_GETNEWADDRESS2}",
  "E_CLI_DUMPPRIVKEY2": "${E_CLI_DUMPPRIVKEY2}",
  "E_CLI_DUMPWALLET2": "${E_CLI_DUMPWALLET2}",
  "E_CLI_STOP": "${E_CLI_STOP}",
  "E_CLI_GENERATETOADDRESS2": "${E_CLI_GENERATETOADDRESS2}",
  "E_CLI_GETWALLETINFO2": "${E_CLI_GETWALLETINFO2}",
  "E_CLI_GETTRANSACTION2": "${E_CLI_GETTRANSACTION2}",
  "E_CLI_SENDTOADDRESS2": "${E_CLI_SENDTOADDRESS2}",
  "E_CLI_GETSIDECHAININFO2": "${E_CLI_GETSIDECHAININFO2}",
  "E_CLI_GETBLOCKCOUNT": "${E_CLI_GETBLOCKCOUNT}",
  "E_CLI_GETMEMPOOL": "${E_CLI_GETMEMPOOL}",
  "E_CLI_GETPEERINFO": "${E_CLI_GETPEERINFO}",
  "E_CLI_GETTOUT": "${E_CLI_GETTOUT}",
  "E_CLI_CREATEMULTISIG": "${E_CLI_CREATEMULTISIG}",
  "wallet_nameBitcoin": "${wallet_nameBitcoin}",
  "wallet_uriBitcoin": "${wallet_uriBitcoin}",
  "pubAddressBitcoin": "${pubAddressBitcoin}",
  "B_CLI_SENDTOADDRESS": "${B_CLI_SENDTOADDRESS}",
  "B_CLI_GETPEGINADDRESS": "${B_CLI_GETPEGINADDRESS}",
  "B_CLI_GETTXOUTPROOF": "${B_CLI_GETTXOUTPROOF}",
  "B_CLI_GETRAWTRANSACTION": "${B_CLI_GETRAWTRANSACTION}",
  "B_CLI_GETBLOCKCOUNT": "${B_CLI_GETBLOCKCOUNT}",
  "B_CLI_GETTOUT": "${B_CLI_GETTOUT}",
  "B_CLI_GETWALLETINFO": "${B_CLI_GETWALLETINFO}",
  "B_CLI_GENERATETOADDRESS": "${B_CLI_GENERATETOADDRESS}",
  "API_PORT": "${API_PORT}"
}
EOL
chmod $BC_RIGHTS_FILES $NODE_CONF_FILE
chown $BC_USER $NODE_CONF_FILE

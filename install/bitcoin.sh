#!/bin/bash

shopt -s expand_aliases

echo ""
echo -e "${CYAN_LIGHT}[NODE BITCOIN]$NCOLOR"

rm -rf $BITCOIN_DEBUG_FILE_VAL
if [ ! -d $BITCOIN_DIR ];then

  if [ $APT_UPDATE_UPGRADE -eq 1 ];then
    apt install build-essential gcc make clang -y -qq
    apt install libtool autotools-dev automake pkg-config bsdmainutils python3 -y -qq
    apt install libevent-dev libboost-dev libboost-system-dev libboost-filesystem-dev libboost-test-dev -y -qq
    apt install libsqlite3-dev -y -qq
    apt install libminiupnpc-dev libnatpmp-dev -y -qq
    apt install libzmq3-dev -y -qq
    apt install libqt5gui5 libqt5core5a libqt5dbus5 qttools5-dev qttools5-dev-tools -y -qq
    apt install libqrencode-dev -y -qq
  fi
  cd $BC_SERVER_DIR
  wget "https://bitcoincore.org/bin/bitcoin-core-$BITCOIN_VERSION/$BITCOIN_INSTALL"
  tar -xvzf $BITCOIN_INSTALL
  rm $BITCOIN_INSTALL
fi
export NODE_INSTANCE=1
export WALLET_INSTANCE=1
export ADDRESS_TYPE="main"
export WALLET=$(bitcoinGetWalletName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
export ADDRESS=$(bitcoinGetAddressName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
export WALLET_URI=$(bitcoinGetWalletUri "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" "$BITCOIN_DATA_ROOT_PATH", "$BITCOIN_CHAIN_VAL")
export BITCOIN_RPC_BIND_VAL="$BITCOIN_HOST_IP"
export BITCOIN_BIND="bind=$BITCOIN_BIND_VAL"
export BITCOIN_RPC_BIND="rpcbind=$BITCOIN_RPC_BIND_VAL"
export PORT_BITCOIN_RPC=$PORT_PREFIX_RPC$BITCOIN_ENV_INDEX
export BITCOIN_RPC_USER_VAL="b_"$BC_ENV
export BITCOIN_RPC_PASSWORD_VAL="b_mdp_$BC_ENV"
export BITCOIN_RPC_USER="rpcuser=$BITCOIN_RPC_USER_VAL"
export BITCOIN_RPC_PASSWORD="rpcpassword=$BITCOIN_RPC_PASSWORD_VAL"
export BITCOIN_RPC_PORT_VAL=$PORT_BITCOIN_RPC
export BITCOIN_RPC_PORT="rpcport=$BITCOIN_RPC_PORT_VAL"
export NODE_CONF_FILE=$BC_CONF_DIR/b_node_${BC_ENV}_1.json
export CODE_CONF_FILE=$(bitcoinGetAddressConf "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" "$BC_CONF_DIR")
export BITCOIN_NOTIFY="walletnotify='$BC_APP_SCRIPT_DIR/notify_bitcoin.sh $BC_ENV %s'"
export INITIAL_AMOUNT=$NODE_INITIAL_AMOUNT
export AMOUNT=$NODE_AMOUNT
export CLI="${BITCOIN_DIR}/bitcoin-cli ${BITCOIN_PARAMS} -rpcconnect=$BITCOIN_RPC_BIND_VAL -rpcport=$BITCOIN_RPC_PORT_VAL -rpcuser='$BITCOIN_RPC_USER_VAL' -rpcpassword='$BITCOIN_RPC_PASSWORD_VAL'"
export B_CLI="${CLI}"
export B_CLI_STOP="${CLI} stop"
export B_CLI_GETWALLETINFO2="${CLI} getwalletinfo"
export B_CLI_CREATEWALLET="${CLI} createwallet"
export B_CLI_LOADWALLET="${CLI} loadwallet"
export B_CLI_GETPEGINADDRESS="${CLI} getpeginaddress"
export B_CLI_GETTXOUTPROOF="${CLI} gettxoutproof"
export B_CLI_GETRAWTRANSACTION="${CLI} getrawtransaction"
export B_CLI_GETBLOCKCOUNT="${CLI} getblockcount"
export B_CLI_IMPORTPRIVKEY="${CLI} importprivkey"
export B_CLI_GETTOUT="${CLI} gettxout"

cat > $BITCOIN_CONF_FILE << EOL

${BITCOIN_CHAIN}
# ${BITCOIN_SECTION_ACTIVE}
${BITCOIN_DATADIR}
${BITCOIN_DEBUG_FILE}
daemon=1
txindex=1
debug=1
listen=1
server=1
# externalip=${EXTERNAL_IP}
noonion=1
listenonion=0
logips=1
fallbackfee=0.0002
${BITCOIN_RPC_USER}
${BITCOIN_RPC_PASSWORD}
whitelist=127.0.0.1
whitelist=0.0.0.0
whitelist=${HOST_IP}
whitelist=${BITCOIN_HOST_IP}
whitelist=${EXTERNAL_IP}
rpcallowip=127.0.0.1
rpcallowip=0.0.0.0
rpcallowip=${HOST_IP}
rpcallowip=${BITCOIN_HOST_IP}
rpcallowip=${EXTERNAL_IP}
${BITCOIN_NOTIFY}
choosedatadir=0
lang=FR
min=1
splash=0

${BITCOIN_SECTION}
${BITCOIN_PORT}
${BITCOIN_BIND}
${BITCOIN_RPC_PORT}
${BITCOIN_RPC_BIND}

EOL
# echo "BITCOIN_CONF_FILE=$BITCOIN_CONF_FILE"
chmod $BC_RIGHTS_FILES $BITCOIN_CONF_FILE
chown $BC_USER $BITCOIN_CONF_FILE

serverStart "$BITCOIN_CONF_FILE" "$BITCOIN_DATADIR_VAL" "$QT" "$B_QT" "$B_DAEMON" 1 1 "$B_CLI_STOP"

cat > $NODE_CONF_FILE <<EOL
{
  "BC_ENV": "${BC_ENV}",
  "NODE_INSTANCE": "${NODE_INSTANCE}",
  "WALLET_INSTANCE": "${WALLET_INSTANCE}",
  "BITCOIN_DATA_ROOT_PATH": "${BITCOIN_DATA_ROOT_PATH}",
  "BC_CONF_DIR": "${BC_CONF_DIR}",
  "AMOUNT": "${AMOUNT}",
  "ADDRESS_TYPE": "b_${ADDRESS_TYPE}",
  "BITCOIN_RPC_USER_VAL": "${BITCOIN_RPC_USER_VAL}",
  "BITCOIN_RPC_PASSWORD_VAL": "${BITCOIN_RPC_PASSWORD_VAL}",
  "BITCOIN_RPC_BIND_VAL": "${BITCOIN_RPC_BIND_VAL}",
  "BITCOIN_RPC_PORT_VAL": "${BITCOIN_RPC_PORT_VAL}",
  "BITCOIN_DATADIR_VAL": "${BITCOIN_DATADIR_VAL}",
  "BITCOIN_CONF_ROOT_PATH": "${BITCOIN_CONF_ROOT_PATH}",
  "BITCOIN_CHAIN_VAL": "${BITCOIN_CHAIN_VAL}",
  "BITCOIN_PARAMS": "${BITCOIN_PARAMS}",
  "QT": "${QT}",
  "BITCOIN_DEBUG_FILE": "${BITCOIN_DEBUG_FILE}",
  "INITIAL_AMOUNT": "${INITIAL_AMOUNT}",
  "BC_APP_SCRIPT_DIR": "${BC_APP_SCRIPT_DIR}",
  "BC_APP_DATA_DIR": "${BC_APP_DATA_DIR}",
  "BC_APP_API_DIR": "${BC_APP_API_DIR}",
  "BC_APP_INSTALL_DIR": "${BC_APP_INSTALL_DIR}",
  "BC_APP_DIR": "${BC_APP_DIR}",
  "BC_APP_LOG_DIR": "${BC_APP_LOG_DIR}",
  "NUMBER_NODES": "${NUMBER_NODES}",
  "BLOCK_PARTICIPANT_NUMBER": "${BLOCK_PARTICIPANT_NUMBER}",
  "PEG_PARTICIPANT_NUMBER": "${PEG_PARTICIPANT_NUMBER}",
  "HOST_IP": "${HOST_IP}",
  "EXTERNAL_IP": "${EXTERNAL_IP}",
  "BC_USER": "${BC_USER}",
  "BC_RIGHTS_FILES": "${BC_RIGHTS_FILES}",
  "BC_WEB_ROOT_DIR": "${BC_WEB_ROOT_DIR}",
  "CLI": "${CLI}",
  "B_DAEMON": "${B_DAEMON}",
  "B_QT": "${B_QT}",
  "B_DEBUG": "${B_DEBUG}",
  "B_CLI": "${B_CLI}",
  "B_CLI_STOP": "${B_CLI_STOP}",
  "B_CLI_GETWALLETINFO2": "${B_CLI_GETWALLETINFO2}",
  "B_CLI_CREATEWALLET": "${B_CLI_CREATEWALLET}",
  "B_CLI_LOADWALLET": "${B_CLI_LOADWALLET}",
  "B_CLI_GETPEGINADDRESS": "${B_CLI_GETPEGINADDRESS}",
  "B_CLI_GETTXOUTPROOF": "${B_CLI_GETTXOUTPROOF}",
  "B_CLI_GETRAWTRANSACTION": "${B_CLI_GETRAWTRANSACTION}",
  "B_CLI_GETBLOCKCOUNT": "${B_CLI_GETBLOCKCOUNT}",
  "B_CLI_IMPORTPRIVKEY": "${B_CLI_IMPORTPRIVKEY}",
  "B_CLI_GETTOUT": "${B_CLI_GETTOUT}",
  "API_PORT": "${API_PORT}"
}
EOL
# echo "NODE_CONF_FILE=$NODE_CONF_FILE"
chmod $BC_RIGHTS_FILES $NODE_CONF_FILE
chown $BC_USER $NODE_CONF_FILE




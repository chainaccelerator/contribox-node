#!/bin/bash

shopt -s expand_aliases

function bitcoinCreateWallet() {

  local NODE_CONF_FILE=$1
  local WALLET_INSTANCE=$2
  local ADDRESS_TYPE="$3"

  echo -e "${CYAN}[WALLET BITCOIN $ADDRESS_TYPE $WALLET_INSTANCE]$NCOLOR" >&2
  # echo "NODE_CONF_FILE=$NODE_CONF_FILE" >&2
  # echo "WALLET_INSTANCE=$WALLET_INSTANCE" >&2
  # echo "ADDRESS_TYPE=$ADDRESS_TYPE" >&2

  local NODE_CONF="$(<$NODE_CONF_FILE)"
  local BC_ENV=$(echo $NODE_CONF | jq -r '.BC_ENV')
  local NODE_INSTANCE=$(echo $NODE_CONF | jq -r '.NODE_INSTANCE')
  local BITCOIN_DATA_ROOT_PATH=$(echo $NODE_CONF | jq -r '.BITCOIN_DATA_ROOT_PATH')
  local BC_CONF_DIR=$(echo $NODE_CONF | jq -r '.BC_CONF_DIR')
  local BITCOIN_RPC_USER_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_RPC_USER_VAL')
  local BITCOIN_RPC_PASSWORD_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_RPC_PASSWORD_VAL')
  local BITCOIN_RPC_BIND_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_RPC_BIND_VAL')
  local BITCOIN_RPC_PORT_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_RPC_PORT_VAL')
  local BITCOIN_DATADIR_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_DATADIR_VAL')
  local BITCOIN_CONF_ROOT_PATH=$(echo $NODE_CONF | jq -r '.BITCOIN_CONF_ROOT_PATH')
  local BITCOIN_CHAIN_VAL=$(echo $NODE_CONF | jq -r '.BITCOIN_CHAIN_VAL')
  local BITCOIN_PARAMS=$(echo $NODE_CONF | jq -r '.BITCOIN_PARAMS')
  local BC_APP_SCRIPT_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_SCRIPT_DIR')
  local QT=$(echo $NODE_CONF | jq -r '.QT')
  local BITCOIN_DEBUG_FILE=$(echo $NODE_CONF | jq -r '.BITCOIN_DEBUG_FILE')
  local BC_APP_SCRIPT_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_SCRIPT_DIR')
  local BC_APP_DATA_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_DATA_DIR')
  local BC_APP_API_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_API_DIR')
  local BC_APP_INSTALL_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_INSTALL_DIR')
  local BC_APP_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_DIR')
  local BC_APP_LOG_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_LOG_DIR')
  local NUMBER_NODES=$(echo $NODE_CONF | jq -r '.NUMBER_NODES')
  local BLOCK_PARTICIPANT_NUMBER=$(echo $NODE_CONF | jq -r '.BLOCK_PARTICIPANT_NUMBER')
  local PEG_PARTICIPANT_NUMBER=$(echo $NODE_CONF | jq -r '.PEG_PARTICIPANT_NUMBER')
  local HOST_IP=$(echo $NODE_CONF | jq -r '.HOST_IP')
  local EXTERNAL_IP=$(echo $NODE_CONF | jq -r '.EXTERNAL_IP')
  local BC_USER=$(echo $NODE_CONF | jq -r '.BC_USER')
  local BC_RIGHTS_FILES=$(echo $NODE_CONF | jq -r '.BC_RIGHTS_FILES')
  local BC_WEB_ROOT_DIR=$(echo $NODE_CONF | jq -r '.BC_WEB_ROOT_DIR')
  local CLI="$(echo $NODE_CONF | jq -r '.CLI')"
  local B_DAEMON="$(echo $NODE_CONF | jq -r '.B_DAEMON')"
  local B_QT="$(echo $NODE_CONF | jq -r '.B_QT')"
  local B_DEBUG="$(echo $NODE_CONF | jq -r '.B_DEBUG')"
  local B_CLI="$(echo $NODE_CONF | jq -r '.B_CLI')"
  local B_CLI_STOP="$(echo $NODE_CONF | jq -r '.B_CLI_STOP')"
  local B_CLI_GETWALLETINFO2="$(echo $NODE_CONF | jq -r '.B_CLI_GETWALLETINFO2')"
  local B_CLI_CREATEWALLET="$(echo $NODE_CONF | jq -r '.B_CLI_CREATEWALLET')"
  local B_CLI_LOADWALLET="$(echo $NODE_CONF | jq -r '.B_CLI_LOADWALLET')"
  local B_CLI_SENDTOADDRESS="$(echo $NODE_CONF | jq -r '.B_CLI_SENDTOADDRESS')"
  local B_CLI_GETPEGINADDRESS="$(echo $NODE_CONF | jq -r '.B_CLI_GETPEGINADDRESS')"
  local B_CLI_GETTXOUTPROOF="$(echo $NODE_CONF | jq -r '.B_CLI_GETTXOUTPROOF')"
  local B_CLI_GETRAWTRANSACTION="$(echo $NODE_CONF | jq -r '.B_CLI_GETRAWTRANSACTION')"
  local B_CLI_GETBLOCKCOUNT="$(echo $NODE_CONF | jq -r '.B_CLI_GETBLOCKCOUNT')"
  local B_CLI_IMPORTPRIVKEY="$(echo $NODE_CONF | jq -r '.B_CLI_IMPORTPRIVKEY')"
  local B_CLI_GETTOUT="$(echo $NODE_CONF | jq -r '.B_CLI_GETTOUT')"
  local WALLET=$(bitcoinGetWalletName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
  WALLET=$(echo $WALLET)
  local ADDRESS=$(bitcoinGetAddressName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
  ADDRESS=$(echo $ADDRESS)
  local WALLET_URI=$(bitcoinGetWalletUri "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" $BITCOIN_DATADIR_VAL "$BITCOIN_CHAIN_VAL")
  WALLET_URI=$(echo $WALLET_URI)
  local CODE_CONF_FILE=$(bitcoinGetAddressConf "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" $BC_CONF_DIR)
  local CLI_WALLET="$CLI -rpcwallet='$WALLET'"
  local B_CLI_WALLET="${CLI_WALLET}"
  local B_CLI_GETWALLETINFO="${CLI_WALLET} getwalletinfo"
  local B_CLI_GETNEWADDRESS="${CLI_WALLET} getnewaddress"
  local B_CLI_GENERATETOADDRESS="${CLI_WALLET} generatetoaddress"
  local B_CLI_GETADDRESSINFO="${CLI_WALLET} getaddressinfo"
  local B_CLI_DUMPPRIVKEY="${CLI_WALLET} dumpprivkey"
  local B_CLI_CREATEMULTISIG="${CLI_WALLET} createmultisig"
  local B_CLI_DUMPWALLET="${CLI_WALLET} dumpwallet"
  local B_CLI_IMPORTWALLET="${CLI_WALLET} importwallet"
  local B_CLI_SENDTOADDRESS="${CLI_WALLET} sendtoaddress"
  local B_CLI_GETTRANSACTION="${CLI_WALLET} gettransaction"

  local CW="$(eval "$B_CLI_CREATEWALLET $WALLET | jq -r .name")"
  # sleep 2
  local NODE_PUB_ADDRESS=$(eval "$B_CLI_GETNEWADDRESS \"$ADDRESS\" \"legacy\"")
  # sleep 2
  local NODE_PUB_KEY=$(eval "$B_CLI_GETADDRESSINFO $NODE_PUB_ADDRESS | jq -r .pubkey")
  local NODE_PRIV_KEY=$(eval "$B_CLI_DUMPPRIVKEY $NODE_PUB_ADDRESS")

  if [ "$ADDRESS_TYPE" = "block" ];then
    echo "B_CLI_GENERATETOADDRESS" >&2
    local BITCOIN_BLOCK_GEN=$(eval "$B_CLI_GENERATETOADDRESS 101 $NODE_PUB_ADDRESS")
  fi
  if [ "$ADDRESS_TYPE" = "peg" ];then

    local blockTx=$(getWalletConfFileParamCMD "b_block" 1 "B_CLI_SENDTOADDRESS" $BC_CONF_DIR $NODE_PUB_ADDRESS 2 "creditForPeg")
    sleep 2
  fi
  CODE_CONF_FILE=$BC_CONF_DIR/${WALLET}".json"
  echo $CODE_CONF_FILE

  cat > $CODE_CONF_FILE <<EOL
{
  "wallet_name": "${WALLET}",
  "wallet_uri": "${WALLET_URI}",
  "pubKey_name": "${ADDRESS}",
  "pubAddress": "${NODE_PUB_ADDRESS}",
  "pubKey": "${NODE_PUB_KEY}",
  "prvKey": "${NODE_PRIV_KEY}",
  "rpcUser": "${BITCOIN_RPC_USER_VAL}",
  "rpcPassword": "${BITCOIN_RPC_PASSWORD_VAL}",
  "rpcBind": "${BITCOIN_RPC_BIND_VAL}",
  "rpcPort": "${BITCOIN_RPC_PORT_VAL}",
  "env": "${BC_ENV}",
  "nodeInstance": "${NODE_INSTANCE}",
  "walletInstance": "${WALLET_INSTANCE}",
  "addressType": "b_${ADDRESS_TYPE}",
  "chain": "${BITCOIN_CHAIN_VAL}",
  "CLI": "${CLI}",
  "CLI_WALLET": "${CLI_WALLET}",
  "B_DAEMON": "${B_DAEMON}",
  "B_QT": "${B_QT}",
  "B_DEBUG": "${B_DEBUG}",
  "B_CLI": "${B_CLI}",
  "B_CLI_WALLET": "${CLI_WALLET}",
  "B_CLI_STOP": "${B_CLI_STOP}",
  "B_CLI_GETWALLETINFO": "${B_CLI_GETWALLETINFO}",
  "B_CLI_LOADWALLET": "${B_CLI_LOADWALLET}",
  "B_CLI_GETNEWADDRESS": "${B_CLI_GETNEWADDRESS}",
  "B_CLI_GENERATETOADDRESS": "${B_CLI_GENERATETOADDRESS}",
  "B_CLI_GETADDRESSINFO": "${B_CLI_GETADDRESSINFO}",
  "B_CLI_DUMPPRIVKEY": "${B_CLI_DUMPPRIVKEY}",
  "B_CLI_CREATEMULTISIG": "${B_CLI_CREATEMULTISIG}",
  "B_CLI_IMPORTPRIVKEY": "${B_CLI_IMPORTPRIVKEY}",
  "B_CLI_DUMPWALLET": "${B_CLI_DUMPWALLET}",
  "B_CLI_IMPORTWALLET": "${B_CLI_IMPORTWALLET}",
  "B_CLI_SENDTOADDRESS": "${B_CLI_SENDTOADDRESS}",
  "B_CLI_GETPEGINADDRESS": "${B_CLI_GETPEGINADDRESS}",
  "B_CLI_GETTXOUTPROOF": "${B_CLI_GETTXOUTPROOF}",
  "B_CLI_GETTRANSACTION": "${B_CLI_GETTRANSACTION}",
  "B_CLI_GETRAWTRANSACTION": "${B_CLI_GETRAWTRANSACTION}",
  "B_CLI_GETBLOCKCOUNT": "${B_CLI_GETBLOCKCOUNT}",
  "B_CLI_GETTOUT": "${B_CLI_GETTOUT}",
  "API_PORT": "${API_PORT}"
}
EOL
  chmod $BC_RIGHTS_FILES $CODE_CONF_FILE
  chown $BC_USER $CODE_CONF_FILE

  cp $CODE_CONF_FILE $BC_CONF_DIR/b_a_${NODE_PUB_ADDRESS}".json"
  chmod $BC_RIGHTS_FILES $BC_CONF_DIR/b_a_${NODE_PUB_ADDRESS}".json"
  chown $BC_USER $BC_CONF_DIR/b_a_${NODE_PUB_ADDRESS}".json"

}
export -f bitcoinCreateWallet

CODE_CONF_FILE="$(bitcoinCreateWallet "$1" $2 "$3")"

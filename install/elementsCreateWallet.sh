#!/bin/bash

shopt -s expand_aliases

function elementsCreateWallet() {

  local NODE_CONF_FILE=$1
  local WALLET_INSTANCE=$2
  local ADDRESS_TYPE="$3"
  local PRIKEY="$4"

  echo -e "${CYAN}[WALLET ELEMENTS $3$2]$NCOLOR" >&2
  # echo "NODE_CONF_FILE=$NODE_CONF_FILE" >&2
  # echo "WALLET_INSTANCE=$WALLET_INSTANCE" >&2
  # echo "ADDRESS_TYPE=$ADDRESS_TYPE" >&2
  # echo "PRIKEY=$PRIKEY" >&2
      
  local NODE_CONF="$(<$NODE_CONF_FILE)"
  local WALLETB=$(echo $NODE_CONF | jq '.wallet_nameBitcoin')
  WALLETB=$(eval "echo $WALLETB")
  local WALLETB_URI=$(echo $NODE_CONF | jq '.wallet_uriBitcoin')
  WALLETB_URI=$(eval "echo $WALLETB_URI")
  local ADDRGENB=$(echo $NODE_CONF | jq '.pubAddressBitcoin')
  ADDRGENB=$(eval "echo $ADDRGENB")
  local BC_ENV=$(echo $NODE_CONF | jq -r '.BC_ENV')
  local NODE_INSTANCE=$(echo $NODE_CONF | jq -r '.NODE_INSTANCE')

  local BLOCK_REDEEMSCRIPT=$(echo $NODE_CONF | jq -r '.BLOCK_REDEEMSCRIPT')
  local PEG_REDEEMSCRIPT=$(echo $NODE_CONF | jq -r '.PEG_REDEEMSCRIPT')
  local BLOCK_SIGN_PUBKEY_LIST=$(echo $NODE_CONF | jq -r '.BLOCK_SIGN_PUBKEY_LIST')
  local PEG_SIGN_PUBKEY_LIST=$(echo $NODE_CONF | jq -r '.PEG_SIGN_PUBKEY_LIST')
  local NUMBER_NODES=$(echo $NODE_CONF | jq -r '.NUMBER_NODES')
  local BLOCK_PARTICIPANT_NUMBER=$(echo $NODE_CONF | jq -r '.BLOCK_PARTICIPANT_NUMBER')
  local PEG_PARTICIPANT_NUMBER=$(echo $NODE_CONF | jq -r '.PEG_PARTICIPANT_NUMBER')
  local HOST_IP=$(echo $NODE_CONF | jq -r '.HOST_IP')
  local EXTERNAL_IP=$(echo $NODE_CONF | jq -r '.EXTERNAL_IP')
  local ENV2=$(echo $NODE_CONF | jq -r '.ENV2')
  local QT=$(echo $NODE_CONF | jq -r '.QT')
  local CLI=$(echo $NODE_CONF | jq -r '.CLI')
  local BC_APP_SCRIPT_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_SCRIPT_DIR')
  local BC_APP_DATA_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_DATA_DIR')
  local BC_APP_API_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_API_DIR')
  local BC_APP_INSTALL_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_INSTALL_DIR')
  local BC_APP_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_DIR')
  local BC_APP_LOG_DIR=$(echo $NODE_CONF | jq -r '.BC_APP_LOG_DIR')
  local BC_OWNER_FILES=$(echo $NODE_CONF | jq -r '.BC_OWNER_FILES')
  local BC_USER=$(echo $NODE_CONF | jq -r '.BC_USER')
  local BC_RIGHTS_FILES=$(echo $NODE_CONF | jq -r '.BC_RIGHTS_FILES')
  local BC_WEB_ROOT_DIR=$(echo $NODE_CONF | jq -r '.BC_WEB_ROOT_DIR')
  local BC_CONF_DIR=$(echo $NODE_CONF| jq -r '.BC_CONF_DIR')
  local BITCOIN_CONF_FILE=$(echo $NODE_CONF | jq -r '.BITCOIN_CONF_FILE')
  local BITCOIN_WALLET_CONF_FILE=$(echo $NODE_CONF | jq -r '.BITCOIN_WALLET_CONF_FILE')
  local BITCOIN_pubAddress=$(echo $NODE_CONF | jq -r '.pubAddress')
  local B_CLI_GETWALLETINFO=$(echo $NODE_CONF | jq -r '.B_CLI_GETWALLETINFO')
  local B_CLI_SENDTOADDRESS=$(echo $NODE_CONF | jq -r '.B_CLI_SENDTOADDRESS')
  local B_CLI_GENERATETOADDRESS=$(echo $NODE_CONF | jq -r '.B_CLI_GENERATETOADDRESS')
  local B_CLI_GETPEGINADDRESS=$(echo $NODE_CONF | jq -r '.B_CLI_GETPEGINADDRESS')
  local B_CLI_GETTXOUTPROOF=$(echo $NODE_CONF | jq -r '.B_CLI_GETTXOUTPROOF')
  local B_CLI_GETRAWTRANSACTION=$(echo $NODE_CONF | jq -r '.B_CLI_GETRAWTRANSACTION')
  local B_CLI_GETBLOCKCOUNT=$(echo $NODE_CONF | jq -r '.B_CLI_GETBLOCKCOUNT')
  local B_CLI_GETTOUT=$(echo $NODE_CONF | jq -r '.B_CLI_GETTOUT')
  local ELEMENTS_DATA_ROOT_PATH=$(echo $NODE_CONF | jq -r '.ELEMENTS_DATA_ROOT_PATH')
  local ELEMENTS_API_BIND_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_API_BIND_VAL')
  local ELEMENTS_API_PORT_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_API_PORT_VAL')
  local ELEMENTS_RPC_USER_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_RPC_USER_VAL')
  local ELEMENTS_RPC_PASSWORD_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_RPC_PASSWORD_VAL')
  local ELEMENTS_RPC_BIND_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_RPC_BIND_VAL')
  local ELEMENTS_RPC_PORT_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_RPC_PORT_VAL')
  local ELEMENTS_DATADIR_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_DATADIR_VAL')
  local ELEMENTS_CONF_ROOT_PATH=$(echo $NODE_CONF | jq -r '.ELEMENTS_CONF_ROOT_PATH')
  local ELEMENTS_CHAIN_VAL=$(echo $NODE_CONF | jq -r '.ELEMENTS_CHAIN_VAL')
  local ELEMENTS_PARAMS=$(echo $NODE_CONF | jq -r '.ELEMENTS_PARAMS')
  local ELEMENTS_DEBUG_FILE=$(echo $NODE_CONF | jq -r '.ELEMENTS_DEBUG_FILE')
  local E_DEAMON=$(echo $NODE_CONF | jq -r '.E_DEAMON')
  local E_QT=$(echo $NODE_CONF | jq -r '.E_QT')
  local E_DEBUG=$(echo $NODE_CONF | jq -r '.E_DEBUG')
  local E_CLI=$(echo $NODE_CONF | jq -r '.E_CLI')
  local E_CLI_CREATEWALLET=$(echo $NODE_CONF| jq -r '.E_CLI_CREATEWALLET')
  local E_CLI_LOADWALLET=$(echo $NODE_CONF | jq -r '.E_CLI_LOADWALLET')
  local E_CLI_GETNEWADDRESS2=$(echo $NODE_CONF | jq -r '.E_CLI_GETNEWADDRESS2')
  local E_CLI_DUMPPRIVKEY2=$(echo $NODE_CONF | jq -r '.E_CLI_DUMPPRIVKEY2')
  local E_CLI_DUMPWALLET2=$(echo $NODE_CONF | jq -r '.E_CLI_DUMPWALLET2')
  local E_CLI_STOP=$(echo $NODE_CONF | jq -r '.E_CLI_STOP')
  local E_CLI_GENERATETOADDRESS2=$(echo $NODE_CONF | jq -r '.E_CLI_GENERATETOADDRESS2')
  local E_CLI_GETWALLETINFO2=$(echo $NODE_CONF | jq -r '.E_CLI_GETWALLETINFO2')
  local E_CLI_GETTRANSACTION2=$(echo $NODE_CONF | jq -r '.E_CLI_GETTRANSACTION2')
  local E_CLI_SENDTOADDRESS2=$(echo $NODE_CONF | jq -r '.E_CLI_SENDTOADDRESS2')
  local E_CLI_GETSIDECHAININFO2=$(echo $NODE_CONF | jq -r '.E_CLI_GETSIDECHAININFO2')
  local E_CLI_GETBLOCKCOUNT=$(echo $NODE_CONF | jq -r '.E_CLI_GETBLOCKCOUNT')
  local E_CLI_GETMEMPOOL=$(echo $NODE_CONF | jq -r '.E_CLI_GETMEMPOOL')
  local E_CLI_GETPEERINFO=$(echo $NODE_CONF | jq -r '.E_CLI_GETPEERINFO')
  local E_CLI_GETTOUT=$(echo $NODE_CONF | jq -r '.E_CLI_GETTOUT')
  local E_CLI_CREATEMULTISIG=$(echo $NODE_CONF | jq -r '.E_CLI_CREATEMULTISIG')
  local WALLET=$(elementsGetWalletName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
  local ADDRESS=$(elementsGetAddressName "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE")
  local WALLET_URI=$(elementsGetWalletUri "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" "$ELEMENTS_DATADIR_VAL" "$ELEMENTS_CHAIN_VAL")
  local CODE_CONF_FILE=$(elementsGetAddressConf "$BC_ENV" $NODE_INSTANCE $WALLET_INSTANCE "$ADDRESS_TYPE" "$BC_CONF_DIR")
  local BITCOIN_CODE_CONF_FILE=$(bitcoinGetAddressConf "$BC_ENV" 1 1 "main" "$BC_CONF_DIR")
  local CLI_WALLET="$CLI -rpcwallet='$WALLET'"
  local E_CLI_WALLET="${CLI_WALLET}"
  local E_CLI_GETNEWADDRESS="${CLI_WALLET} getnewaddress"
  local E_CLI_GETADDRESSINFO="${CLI_WALLET} getaddressinfo"
  local E_CLI_DUMPPRIVKEY="${CLI_WALLET} dumpprivkey"
  local E_CLI_CREATEMULTISIG="${CLI_WALLET} createmultisig"
  local E_CLI_DUMPWALLET="${CLI_WALLET} dumpwallet"
  local E_CLI_IMPORTWALLET="${CLI_WALLET} importwallet"
  local E_CLI_IMPORTPRIVKEY="${CLI_WALLET} importprivkey"
  local E_CLI_GENERATETOADDRESS="${CLI_WALLET} generatetoaddress"
  local E_CLI_GETPEGINADDRESS="${CLI_WALLET} getpeginaddress"
  local E_CLI_GETWALLETINFO="${CLI_WALLET} getwalletinfo"
  local E_CLI_CLAIMPEGIN="${CLI_WALLET} claimpegin"
  local E_CLI_GETRAWTRANSACTION="${CLI_WALLET} getrawtransaction"
  local E_CLI_SENDTOMAINCHAIN="${CLI_WALLET} sendtomainchain"
  local E_CLI_GETTRANSACTION="${CLI_WALLET} gettransaction"
  local E_CLI_SENDTOADDRESS="${CLI_WALLET} sendtoaddress"
  local E_CLI_SENDTOADDRESS="${CLI_WALLET} sendtoaddress"
  local E_CLI_SIGNBLOCK="${CLI_WALLET} signblock"
  local E_CLI_SUBMITBLOCK="${CLI_WALLET} submitblock"
  local E_CLI_COMBINEBLOCKSIGS="${CLI_WALLET} combineblocksigs"
  local E_CLI_GETNEWBLOCKHEX="${CLI_WALLET} getnewblockhex"
  local E_CLI_COMBINERAWTRANSACTION="${CLI_WALLET} combinerawtransaction"
  local E_CLI_SIGNRAWTRANSACTIONWITHKEY="${CLI_WALLET} signrawtransactionwithkey"
  local E_CLI_SENDRAWTRANSACTION="${CLI_WALLET} sendrawtransaction"
  local E_CLI_LISTUNSPENT="${CLI_WALLET} listunspent"

  if [ "$ADDRESS_TYPE" == "block" ] && [ $NODE_INSTANCE -eq 1 ] && [ $WALLET_INSTANCE -eq 1 ];then
      echo "E_CLI_DUMPPRIVKEY2" >&2
      echo $(eval "$CLI listwallets")
      local DUMP_INITIAL_ADDRESS=$(eval "$CLI getnewaddress" \"legacy\")
      local DUMP_INITIAL_KEY=$(eval "$E_CLI_DUMPPRIVKEY2 $DUMP_INITIAL_ADDRESS")
  fi
  local WN=$(eval "$E_CLI_CREATEWALLET '$WALLET' | jq -r .name")

  local BLOCKCOUNT=$(eval "$E_CLI_GETBLOCKCOUNT")

  local PEGGED_ASSET=$(eval "$E_CLI_GETBLOCKCOUNT")

  if [ -z "$PRIKEY" ];then
    echo "E_CLI_DUMPPRIVKEY" >&2
    local NODE_PUB_ADDRESS=$(eval "$E_CLI_GETNEWADDRESS \"$ADDRESS\" \"legacy\"")
    local NODE_PRIV_KEY=$(eval "$E_CLI_DUMPPRIVKEY $NODE_PUB_ADDRESS")
    local NODE_PUB_KEY=$(eval "$E_CLI_GETADDRESSINFO $NODE_PUB_ADDRESS | jq -r .pubkey")
  else
    echo "E_CLI_IMPORTPRIVKEY" >&2
    local IMPORT=$(eval "$E_CLI_IMPORTPRIVKEY $PRIKEY")
    sleep 120
    local NODE_PRIV_KEY=$(getWalletConfFileParam $ADDRESS_TYPE $WALLET_INSTANCE "prvKey" $BC_CONF_DIR "" "" "")
    local NODE_PUB_ADDRESS=$(getWalletConfFileParam $ADDRESS_TYPE $WALLET_INSTANCE "pubAddress" $BC_CONF_DIR "" "" "")
    local NODE_PUB_KEY=$(getWalletConfFileParam $ADDRESS_TYPE $WALLET_INSTANCE "pubKey" $BC_CONF_DIR "" "" "")
  fi
  if [ "$ADDRESS_TYPE" == "block" ] && [ -z $PRIKEY ];then
    echo "E_CLI_GENERATETOADDRESS" >&2
    local ELEMENTS_BLOCK_GEN=$(eval "$E_CLI_GENERATETOADDRESS 101 $NODE_PUB_ADDRESS")
  fi
  if [ "$ADDRESS_TYPE" == "peg" ] && [ -z $PRIKEY ];then

    local addr=$(getWalletConfFileParam "block" 1 "pubAddress" $BC_CONF_DIR)
    local blockTx=$(getWalletConfFileParamCMD "block" 1 "E_CLI_SENDTOADDRESS" $BC_CONF_DIR $NODE_PUB_ADDRESS 0.0003 "creditForPeg" "''" true true)
    local blockg=$(getWalletConfFileParamCMD "block" 1 "E_CLI_GENERATETOADDRESS" $BC_CONF_DIR 101 $addr)
  fi
  if [ -z "$BLOCK_SIGN_PUBKEY_LIST" ];then
    BLOCK_SIGN_PUBKEY_lIST='""'
  fi
  if [ -z "$PEG_SIGN_PUBKEY_LIST" ];then
    PEG_SIGN_PUBKEY_lIST='""'
  fi
  if [ "$ADDRESS_TYPE" == "block" ] && [ $NODE_INSTANCE -eq 1 ] && [ $WALLET_INSTANCE -eq 1 ];then
      echo "INITIAL IMPORT" >&2
      local IMPORT_INITIAL=$(eval "$E_CLI_IMPORTPRIVKEY $DUMP_INITIAL_KEY")
      echo "end import" >&2
      # local SEND_INITIAL=$(eval "$E_CLI_SENDTOADDRESS $NODE_PUB_ADDRESS 21000000 'InitialTokens' "''" true true")
      echo "end send" >&2
      local ELEMENTS_BLOCK_GEN=$(eval "$E_CLI_GENERATETOADDRESS 101 $NODE_PUB_ADDRESS")
  fi
  rm -rf $CODE_CONF_FILE
  cat > $CODE_CONF_FILE <<EOL
{
  "BLOCKCOUNT": "${BLOCKCOUNT}",
  "BLOCK_REDEEMSCRIPT": "${BLOCK_REDEEMSCRIPT}",
  "PEG_REDEEMSCRIPT": "${PEG_REDEEMSCRIPT}",
  "BLOCK_SIGN_PUBKEY_LIST": ${BLOCK_SIGN_PUBKEY_LIST},
  "PEG_SIGN_PUBKEY_LlIST": ${PEG_SIGN_PUBKEY_LIST},
  "wallet_name": "${WALLET}",
  "wallet_uri": "${WALLET_URI}",
  "pubKey_name": "${ADDRESS}",
  "pubAddress": "${NODE_PUB_ADDRESS}",
  "pubKey": "${NODE_PUB_KEY}",
  "prvKey": "${NODE_PRIV_KEY}",
  "rpcUser": "${ELEMENTS_RPC_USER_VAL}",
  "rpcPassword": "${ELEMENTS_RPC_PASSWORD_VAL}",
  "rpcBind": "${ELEMENTS_RPC_BIND_VAL}",
  "rpcPort": "${ELEMENTS_RPC_PORT_VAL}",
  "apiBind": "${ELEMENTS_API_BIND_VAL}",
  "apiPort": "${ELEMENTS_API_PORT_VAL}",
  "peggedAsset": "${PEGGED_ASSET}",
  "env": "${BC_ENV}",
  "nodeInstance": "${NODE_INSTANCE}",
  "walletInstance": "${WALLET_INSTANCE}",
  "addressType": "${ADDRESS_TYPE}",
  "chain": "${ELEMENTS_CHAIN_VAL}",
  "NODE_CONF_FILE": "${NODE_CONF_FILE}",
  "CLI": "${CLI}",
  "CLI_WALLET": "${CLI_WALLET}",
  "ENV2": "${ENV2}",
  "E_DEAMON": "${E_DEAMON}",
  "E_QT": "${E_QT}",
  "E_DEBUG": "${E_DEBUG}",
  "E_CLI": "${E_CLI}",
  "E_CLI_WALLET": "${E_CLI_WALLET}",
  "E_CLI_CREATEWALLET": "${E_CLI_CREATEWALLET}",
  "E_CLI_LOADWALLET": "${E_CLI_LOADWALLET}",
  "E_CLI_GETNEWADDRESS": "${E_CLI_GETNEWADDRESS}",
  "E_CLI_GETADDRESSINFO": "${E_CLI_GETADDRESSINFO}",
  "E_CLI_DUMPPRIVKEY": "${E_CLI_DUMPPRIVKEY}",
  "E_CLI_CREATEMULTISIG": "${E_CLI_CREATEMULTISIG}",
  "E_CLI_DUMPWALLET": "${E_CLI_DUMPWALLET}",
  "E_CLI_IMPORTWALLET": "${E_CLI_IMPORTWALLET}",
  "E_CLI_STOP": "${E_CLI_STOP}",
  "E_CLI_IMPORTPRIVKEY": "${E_CLI_IMPORTPRIVKEY}",
  "E_CLI_GENERATETOADDRESS": "${E_CLI_GENERATETOADDRESS}",
  "E_CLI_GETPEGINADDRESS": "${E_CLI_GETPEGINADDRESS}",
  "E_CLI_GETWALLETINFO": "${E_CLI_GETWALLETINFO}",
  "E_CLI_CLAIMPEGIN": "${E_CLI_CLAIMPEGIN}",
  "E_CLI_GETRAWTRANSACTION": "${E_CLI_GETRAWTRANSACTION}",
  "E_CLI_SENDTOMAINCHAIN": "${E_CLI_SENDTOMAINCHAIN}",
  "E_CLI_GETTRANSACTION": "${E_CLI_GETTRANSACTION}",
  "E_CLI_GETPEERINFO": "${E_CLI_GETPEERINFO}",
  "E_CLI_SENDTOADDRESS": "${E_CLI_SENDTOADDRESS}",
  "E_CLI_SENDTOADDRESS2": "${E_CLI_SENDTOADDRESS2}",
  "E_CLI_GETSIDECHAININFO2": "${E_CLI_GETSIDECHAININFO2}",
  "E_CLI_GETBLOCKCOUNT": "${E_CLI_GETBLOCKCOUNT}",
  "E_CLI_GETTOUT": "${E_CLI_GETTOUT}",
  "E_CLI_GETNEWADDRESS2": "${E_CLI_GETNEWADDRESS2}",
  "E_CLI_DUMPPRIVKEY2": "${E_CLI_DUMPPRIVKEY2}",
  "E_CLI_DUMPWALLET2": "${E_CLI_DUMPWALLET2}",
  "E_CLI_GENERATETOADDRESS2": "${E_CLI_GENERATETOADDRESS2}",
  "E_CLI_GETWALLETINFO2": "${E_CLI_GETWALLETINFO2}",
  "E_CLI_GETTRANSACTION2": "${E_CLI_GETTRANSACTION2}",
  "E_CLI_SIGNBLOCK": "${E_CLI_SIGNBLOCK}",
  "E_CLI_SUBMITBLOCK": "${E_CLI_SUBMITBLOCK}",
  "E_CLI_COMBINEBLOCKSIGS": "${E_CLI_COMBINEBLOCKSIGS}",
  "E_CLI_GETMEMPOOL": "${E_CLI_GETMEMPOOL}",
  "E_CLI_GETNEWBLOCKHEX": "${E_CLI_GETNEWBLOCKHEX}",
  "E_CLI_COMBINERAWTRANSACTION": "${E_CLI_COMBINERAWTRANSACTION}",
  "E_CLI_SENDRAWTRANSACTION": "${E_CLI_SENDRAWTRANSACTION}",
  "E_CLI_SIGNRAWTRANSACTIONWITHKEY": "${E_CLI_SIGNRAWTRANSACTIONWITHKEY}",
  "E_CLI_LISTUNSPENT": "${E_CLI_LISTUNSPENT}",
  "ELEMENTS_DATA_ROOT_PATH": "${ELEMENTS_DATA_ROOT_PATH}",
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
  "NODE_INSTANCE": "${BC_INST}",
  "BC_ENV": "${BC_ENV}",
  "BC_APP_SCRIPT_DIR": "${BC_APP_SCRIPT_DIR}",
  "BC_APP_DATA_DIR": "${BC_APP_DATA_DIR}",
  "BC_APP_API_DIR": "${BC_APP_API_DIR}",
  "BC_APP_INSTALL_DIR": "${BC_APP_INSTALL_DIR}",
  "BC_APP_DIR": "${BC_APP_DIR}",
  "BC_APP_LOG_DIR": "${BC_APP_LOG_DIR}",
  "BC_CONF_DIR": "${BC_CONF_DIR}",
  "BC_USER": "${BC_USER}",
  "BC_RIGHTS_FILES": "${BC_RIGHTS_FILES}",
  "BC_WEB_ROOT_DIR": "${BC_WEB_ROOT_DIR}",
  "NUMBER_NODES": "${NUMBER_NODES}",
  "BLOCK_PARTICIPANT_NUMBER": "${BLOCK_PARTICIPANT_NUMBER}",
  "PEG_PARTICIPANT_NUMBER": "${PEG_PARTICIPANT_NUMBER}",
  "HOST_IP": "${HOST_IP}",
  "EXTERNAL_IP": "${EXTERNAL_IP}",
  "BITCOIN_CONF_FILE": "${BITCOIN_CONF_FILE}",
  "BITCOIN_WALLET_CONF_FILE": "${BITCOIN_WALLET_CONF_FILE}",
  "bitcoinConfFile": "${BC_CONF_DIR}/b_n_${BC_ENV}.json",
  "wallet_nameBitcoin": "${WALLETB}",
  "wallet_uriBitcoin": "${WALLETB_URI}",
  "pubAddressBitcoin": "${ADDRGENB}",
  "B_CLI_SENDTOADDRESS": "${B_CLI_SENDTOADDRESS}",
  "B_CLI_GETPEGINADDRESS": "${B_CLI_GETPEGINADDRESS}",
  "B_CLI_GETTXOUTPROOF": "${B_CLI_GETTXOUTPROOF}",
  "B_CLI_GETRAWTRANSACTION": "${B_CLI_GETRAWTRANSACTION}",
  "B_CLI_GETTOUT": "${B_CLI_GETTOUT}",
  "B_CLI_GETWALLETINFO": "${B_CLI_GETWALLETINFO}",
  "B_CLI_GENERATETOADDRESS": "${B_CLI_GENERATETOADDRESS}",
  "API_PORT": "${API_PORT}"
}
EOL
  chmod $BC_RIGHTS_FILES $CODE_CONF_FILE
  chown $BC_USER $CODE_CONF_FILE
  
  if [ "$ADDRESS_TYPE" = "block" ] || [ "$ADDRESS_TYPE" = "peg" ] || [ "$ADDRESS_TYPE" = "node" ];then

    local SHARE_FILE=$BC_CONF_DIR/shared/${WALLET}.json
    rm -rf $SHARE_FILE
    cat > $SHARE_FILE <<EOL
{
  "wallet_name": "${WALLET}",
  "wallet_uri": "${WALLET_URI}",
  "pubKey_name": "${ADDRESS}",
  "pubAddress": "${NODE_PUB_ADDRESS}",
  "pubKey": "${NODE_PUB_KEY}",
  "apiBind": "${ELEMENTS_API_BIND_VAL}",
  "apiPort": "${ELEMENTS_API_PORT_VAL}",
  "nodeId": "${NODEID}",
  "env": "${BC_ENV}",
  "nodeInstance": "${NODE_INSTANCE}",
  "walletInstance": "${WALLET_INSTANCE}",
  "addressType": "${ADDRESS_TYPE}"
}
EOL
    chmod $BC_RIGHTS_FILES $SHARE_FILE
    chown $BC_USER $SHARE_FILE
  fi
  echo $CODE_CONF_FILE
}
export -f elementsCreateWallet

export E_BLOCK_GEN_CONF=$(elementsCreateWallet ${1} ${2} "${3}" ${4})

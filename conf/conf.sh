#!/bin/bash

shopt -s expand_aliases

contribox_mkdir() {

  if [ ! -d $1 ]; then
    mkdir $1
  fi
  chmod $BC_RIGHTS_FILES -R $1
  chown $BC_OWNER_FILES -R $1
}
export -f contribox_mkdir

contribox_rmfile() {

  if [ -f $1 ]; then
    rm -rf $1
  fi
}
export -f contribox_rmfile

contribox_rmdir() {

  if [ -d $1 ]; then
    rm -rf $1
  fi
}
export -f contribox_rmdir

serverStart() {

    local CONF_FILE=$1
    local DATADIR_VAL=$2
    local QT=$3
    local QT_START=$4
    local DAEMON_START=$5
    local STOP=$6
    local RM_DATA=$7
    local CLI_STOP=$8

    if [ $STOP = 1 ];then
        echo -e "${RED_LIGHT}STOP${NCOLOR}"
        eval "$CLI_STOP > /dev/null 2>&1 &"
        sleep 3
        
        if [ $RM_DATA -eq 1 ];then
            contribox_rmdir $DATADIR_VAL
            sleep 2
            contribox_mkdir $DATADIR_VAL
            sleep 2
        fi
        echo -e "${GREEN_LIGHT}START${NCOLOR}"
        if [ $QT -eq 1 ];then
            eval "$QT_START > /dev/null 2>&1 &"
        else
            eval "$DAEMON_START > /dev/null 2>&1 &"
        fi
        sleep 5
    fi
}
export -f serverStart

serversUp() {

  ss -tlnp | grep "$1"
}
export -f serversUp

confJsonGet() {

  eval "export $2=$(cat $1 | jq -r .$2)"
}
export -f confJsonGet

elementsGetWalletName() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local WALLET="e_"${ADDRESS_TYPE}"_"${INSTANCE}

  echo $WALLET

  return 1
}
export -f elementsGetWalletName

bitcoinGetWalletName() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local WALLET="b_"${ADDRESS_TYPE}"_"${INSTANCE}

  echo $WALLET

  return 1
}
export -f bitcoinGetWalletName

bitcoinGetAddressName() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local ADDRESS="b_a_"${ADDRESS_TYPE}"_"${INSTANCE}

  echo $ADDRESS

  return 1
}
export -f bitcoinGetAddressName

elementsGetAddressName() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local ADDRESS="e_a_"${ADDRESS_TYPE}"_"${INSTANCE}

  echo $ADDRESS

  return 1
}
export -f elementsGetAddressName


bitcoinGetWalletUri() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local BITCOIN_DATA_ROOT_PATH=$5
  local BITCOIN_CHAIN_VAL="$6"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local WALLET=$(bitcoinGetWalletName "${BC_ENV}" ${NODE_INSTANCE} ${WALLET_INSTANCE} "${ADDRESS_TYPE}")
  local WALLET_URI=${BITCOIN_DATA_ROOT_PATH}/${BITCOIN_CHAIN_VAL}/wallets/${WALLET}

  echo $WALLET_URI

  return 1
}
export -f bitcoinGetWalletUri

elementsGetWalletUri() {

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local ELEMENTS_DATA_ROOT_PATH=$5
  local ELEMENTS_CHAIN_VAL="$6"
  local NODE=${BC_ENV}"_cli"${NODE_INSTANCE}
  local INSTANCE=${NODE}"_wallet"${WALLET_INSTANCE}
  local WALLET=$(elementsGetWalletName "${BC_ENV}" ${NODE_INSTANCE} ${WALLET_INSTANCE} "${ADDRESS_TYPE}")
  local WALLET_URI=${ELEMENTS_DATA_ROOT_PATH}/${ELEMENTS_CHAIN_VAL}/wallets/${WALLET}

  echo $WALLET_URI
}
export -f elementsGetWalletUri

elementsGetAddressConf(){

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local BC_CONF_DIR=$5
  local WALLET=$(elementsGetWalletName "${BC_ENV}" ${NODE_INSTANCE} ${WALLET_INSTANCE} "${ADDRESS_TYPE}")
  local CODE_CONF_FILE=${BC_CONF_DIR}/${WALLET}.json

  echo $CODE_CONF_FILE
}
export -f elementsGetAddressConf

function createMultisigPubKeyList() {

  local BC_ENV=$1
  local TYPE=$2
  local PARTICIPANT_NUMBER=$3
  local BC_CONF_DIR=$4

   for a in `seq 1 $PARTICIPANT_NUMBER`;
    do
        PUBKEY=$(getWalletConfFileParam $TYPE $a "pubKey" $BC_CONF_DIR)

        if [ $a -eq 1 ];then
            PUBKEY_LIST='"'$PUBKEY'"'
        else
            PUBKEY_LIST=$PUBKEY_LIST',"'$PUBKEY'"'
        fi
    done
    echo $PUBKEY_LIST
}
export -f createMultisigPubKeyList

function createMultisig(){

  local BC_ENV=$1
  local TYPE=$2
  local PUBKEY_LIST=$3
  local PARTICIPANT_MIN=$4
  local BC_CONF_DIR=$5

  local PUBKEY_LIST0='['$PUBKEY_LIST']'
  echo ''${PUBKEY_LIST0}'' > $BC_CONF_DIR/"e_$TYPE_"${BC_ENV}"_pubKey_list.json"
  local MULTISIG=$(getWalletConfFileParamCMD $TYPE 1 "E_CLI_CREATEMULTISIG" $BC_CONF_DIR $PARTICIPANT_MIN "'[$PUBKEY_LIST]'" "")
  local REDEEMSCRIPT=$(echo $MULTISIG | jq -r '.redeemScript')
  echo "" >&2
  echo "REDEEMSCRIPT=$REDEEMSCRIPT" >&2

  echo $REDEEMSCRIPT
}
export -f createMultisig

bitcoinGetAddressConf(){

  local BC_ENV="$1"
  local NODE_INSTANCE=$2
  local WALLET_INSTANCE=$3
  local ADDRESS_TYPE="$4"
  local BC_CONF_DIR=$5
  local WALLET=$(bitcoinGetWalletName "${BC_ENV}" ${NODE_INSTANCE} ${WALLET_INSTANCE} "${ADDRESS_TYPE}")
  local CODE_CONF_FILE=${BC_CONF_DIR}/${WALLET}.json

  echo $CODE_CONF_FILE
}
export -f bitcoinGetAddressConf

function bitcoinWallet_gen(){

    local ADDRESS_TYPE="$1"
    local PARTICIPANT_NUMBER=$2
    local BC_APP_INSTALL_DIR=$3
    local NODE_1_ELEMENTS_CONF_FILE=$4
    local CYAN=$5
    local NCOLOR=$6
    local BC_ENV="$7"
    local BC_CONF_DIR=$8

    # echo "" >&2
    # echo ADDRESS_TYPE="$1" >&2
    # echo PARTICIPANT_NUMBER=$3 >&2
    # echo BC_APP_INSTALL_DIR=$4 >&2
    # echo NODE_1_ELEMENTS_CONF_FILE=$5 >&2
    # echo CYAN=$7 >&2
    # echo NCOLOR=$8 >&2
    # echo BC_ENV="$9" >&2
    # echo BC_CONF_DIR=${10} >&2

    # echo -e "${CYAN}[$ADDRESS_TYPE WALLETS]${NCOLOR}" >&2
    declare -a CONF_FILE_LIST
    for i in `seq 1 $PARTICIPANT_NUMBER`;
    do
        WALLET_INSTANCE=$i
        source $BC_APP_INSTALL_DIR/bitcoinCreateWallet.sh $NODE_1_ELEMENTS_CONF_FILE $WALLET_INSTANCE "$ADDRESS_TYPE" "" ""
        CONF_FILE_LIST[$i]=$(bitcoinGetAddressConf "$BC_ENV" 1 $WALLET_INSTANCE "$ADDRESS_TYPE" $BC_CONF_DIR)
    done
    local separator='","'
    local regex="$( printf "${separator}%s" ${CONF_FILE_LIST[@]} )"
    local regex="${regex:${#separator}}"
    local CONF=$BC_CONF_DIR/b_${ADDRESS_TYPE}_wallets.json
    echo '["'$regex'"]' > $CONF

    echo $CONF
}
export -f bitcoinWallet_gen

function wallet_gen(){

    local ADDRESS_TYPE="$1"
    local PARTICIPANT_NUMBER=$2
    local BC_APP_INSTALL_DIR=$3
    local NODE_1_ELEMENTS_CONF_FILE=$4
    local CYAN=$5
    local NCOLOR=$6
    local BC_ENV="$7"
    local BC_CONF_DIR=$8
    
    # echo ADDRESS_TYPE="$1" >&2
    # echo PARTICIPANT_NUMBER=$3 >&2
    # echo BC_APP_INSTALL_DIR=$4 >&2
    # echo NODE_1_ELEMENTS_CONF_FILE=$5 >&2
    # echo CYAN=$7 >&2
    # echo NCOLOR=$8 >&2
    # echo BC_ENV="$9" >&2
    # echo BC_CONF_DIR=${10} >&2

    declare -a CONF_FILE_LIST
    for i in `seq 1 $PARTICIPANT_NUMBER`;
    do
        WALLET_INSTANCE=$i
        PRIVKEY=""
        local CONF_FILE=$(elementsGetAddressConf $BC_ENV 1 $i $ADDRESS_TYPE $BC_CONF_DIR)

        if [ -f $CONF_FILE ];then
          echo "IMPORT KEY" >&2
          PRIVKEY=$(getWalletConfFileParam $ADDRESS_TYPE $i "prvKey" $BC_CONF_DIR)
        fi
        source $BC_APP_INSTALL_DIR/elementsCreateWallet.sh $NODE_1_ELEMENTS_CONF_FILE $WALLET_INSTANCE "$ADDRESS_TYPE" $PRIVKEY ""
        CONF_FILE_LIST[$i]=$(elementsGetAddressConf "$BC_ENV" 1 $WALLET_INSTANCE "$ADDRESS_TYPE" $BC_CONF_DIR)
    done    
    local separator='","'
    local regex="$( printf "${separator}%s" ${CONF_FILE_LIST[@]} )"
    local regex="${regex:${#separator}}"
    local CONF=$BC_CONF_DIR/${ADDRESS_TYPE}_wallets.json
    echo '["'$regex'"]' > $CONF

    echo $CONF
}
export -f wallet_gen

function getWalletConfFile() {

  local ADDRESS_TYPE=$1
  local INDEX=$2
  local BC_CONF_DIR=$3

  # echo "ADDRESS_TYPE=$ADDRESS_TYPE" >&2
  # echo "INDEX=$INDEX" >&2
  # echo "BC_CONF_DIR=$BC_CONF_DIR" >&2

  local LIST=$(cat "$BC_CONF_DIR/${ADDRESS_TYPE}_wallets.json")
  declare -a CONF_FILE_LIST
  INDEX=$(($INDEX-1))
  local CONF_FILE=$(echo $LIST | jq '.['$INDEX']')
  CONF_FILE=$(eval echo $CONF_FILE)
  local CONTENT=$(cat $CONF_FILE)
  
  echo $CONTENT
}
export getWalletConfFile

function getWalletConfFileParam() {

  local ADDRESS_TYPE=$1
  local INDEX=$2
  local PARAM=$3
  local BC_CONF_DIR=$4

  # echo "->PARAM" >&2
  # echo "ADDRESS_TYPE=$ADDRESS_TYPE" >&2
  # echo "INDEX=$INDEX" >&2
  # echo "PARAM=$PARAM" >&2
  # echo "BC_CONF_DIR=$BC_CONF_DIR" >&2

  local CONTENT=$(getWalletConfFile $ADDRESS_TYPE $INDEX $BC_CONF_DIR)
  local VAL=$(echo $CONTENT | jq '.'$PARAM)
  local VAL=$(eval echo $VAL)
  
  echo $VAL
}
export getWalletConfFileParam

function getWalletConfFileParamCMD() {

  local ADDRESS_TYPE=$1
  local INDEX=$2
  local PARAM=$3
  local BC_CONF_DIR=$4
  local P1=$5
  local P2=$6
  local P3=$7

  # echo "" >&2
  # echo "->CMD" >&2
  # echo "ADDRESS_TYPE=$ADDRESS_TYPE" >&2
  # echo "INDEX=$INDEX" >&2
  # echo "PARAM=$PARAM" >&2
  # echo "BC_CONF_DIR=$BC_CONF_DIR" >&2
  # echo "P1=$P1" >&2
  # echo "P2=$P2" >&2
  # echo "P3=$P3" >&2

  # PARAM=$(eval echo $PARAM)
  local CMD=$(getWalletConfFileParam $ADDRESS_TYPE $INDEX $PARAM $BC_CONF_DIR)
  # CMD=$(eval echo $CMD)
  echo "$PARAM $P1 $P2 $P3" >&2
  local VAL=$(eval "$CMD $P1 $P2 $P3")
  # echo "RESULT=$VAL" >&2
  
  echo $VAL
}
export getWalletConfFileParamCMD

function addressFindType(){

    local ADDRESS=$1
    local TYPE=$2
    local MAX=$3
    local BC_CONF_DIR=$4

    for j in $(seq 1 $MAX);
    do
        local tmp=$(getWalletConfFileParam $TYPE $j "pubAddress" $BC_CONF_DIR "" "" "")
        local nodeInstance=$(getWalletConfFileParam $TYPE $j "nodeInstance" $BC_CONF_DIR "" "" "")
        local walletInstance=$(getWalletConfFileParam $TYPE $j "walletInstance" $BC_CONF_DIR "" "" "")
        local bc_env=$(getWalletConfFileParam $TYPE $j "BC_ENV" $BC_CONF_DIR "" "" "")
        if [ ! $tmp == "" ];then

            local R=$(elementsGetAddressConf $bc_env $nodeInstance $walletInstance $TYPE $BC_CONF_DIR)
            echo $R
            exit
        fi
    done
    echo ""
}
export -f addressFindType

function addressFind(){

    local ADDRESS=$1
    local MAX_PEG=$2
    local MAX_BLOCK=$3
    local MAX_MAIN=$4
    local MAX_BACKUP=$5
    local MAX_LOCK=$6
    local MAX_WITNESS=$7
    local BC_CONF_DIR=$8

    local tmp=$(addressFindType $ADDRESS "peg" $MAX_PEG, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    tmp=$(addressFindType $ADDRESS "bloc" $MAX_BLOCK, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    tmp=$(addressFindType $ADDRESS "main" $MAX_MAIN, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    tmp=$(addressFindType $ADDRESS "backup" $MAX_BACKUP, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    tmp=$(addressFindType $ADDRESS "lock" $MAX_LOCK, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    tmp=$(addressFindType $ADDRESS "witness" $MAX_WITNESS, $BC_CONF_DIR)

    if [ ! $tmp == "" ];then

        echo $tmp
        exit
    fi
    echo ""
}
export -f addressFind

function askFor(){

    local addressFrom=$1
    local addressFromType=$2
    local BC_CONF_DIR=$3
    local PARTICIPANT_NUMBER=$4
    local amount=$5
    local bc_env=$6
    local addressType=$7
    local method=$8
    local hex=$9
    local script=${10}
    local proof=${11}

    # echo "" >&2
    # echo "addressFrom=$addressFrom" >&2
    # echo "addressFromType=$addressFromType" >&2
    # echo "BC_CONF_DIR=$BC_CONF_DIR" >&2
    # echo "PARTICIPANT_NUMBER=$PARTICIPANT_NUMBER" >&2
    # echo "amount=$amount" >&2
    # echo "bc_env=$bc_env" >&2
    # echo "addressType=$addressType" >&2
    # echo "method=$method" >&2
    # echo "hex=$hex" >&2

    local RESULT='['
    local block=$(getWalletConfFileParamCMD $addressType 1 "E_CLI_GETBLOCKCOUNT" $BC_CONF_DIR "" "" "")
    block=$(($block+1))
    local O=5
    for j in $(seq 1 $O);
    do

        if [ $j -eq 1 ];then
            local participant2=$(($PARTICIPANT_NUMBER/2))
            # participant2=$(echo $participant2 | awk '{print int('.$participant2.')}')
            participant2=$(($participant2+1))
            local index2=$(($block % $participant2))
        elif [ $j -lt $O ];then

            index2=$(($index2/2))
            # index2=$(echo $index2 | awk '{print int('$index2')}')
            index2=$(($index2+1))
            RESULT=$RESULT','
        elif [ $j -eq $O ];then
            index2=$(($index2/2))
            # index2=$(echo $index2 | awk '{print int('$index2')}')
            index2=$(($index2+1))
            RESULT=$RESULT','
        fi
        local addressTo=$(getWalletConfFileParam $addressType $index2 "pubAddress" $BC_CONF_DIR)
        local pubKeyTo=$(getWalletConfFileParam $addressType $index2 "pubKey" $BC_CONF_DIR)
        echo -e "${CYAN}[$method index: $index2 $addressTo $pubKeyTo]$NCOLOR" >&2

        local addressTo=$(getWalletConfFileParam $addressType $index2 "pubAddress" $BC_CONF_DIR)
        local addressToType=$(getWalletConfFileParam $addressType $index2 "addressType" $BC_CONF_DIR)
        local HOST=$(getWalletConfFileParam $addressType $index2 "HOST_IP" $BC_CONF_DIR)
        local PORT=$(getWalletConfFileParam $addressType $index2 "API_PORT" $BC_CONF_DIR)
        local DATA=$(cat <<EOF
{
    "jsonrpc": "1.0",
    "id": "curltest",
    "block": ${block},
    "bc_env": "${bc_env}",
    "method": "${method}",
    "from": {
        "address": "${addressFrom}",
        "type": "${addressFromType}"
    },
    "to": {
        "address": "${addressTo}",
        "type": "${addressType}"
    },
    "params": {
        "amount": ${amount},
        "hex": "${hex}",
        "script": "${script}",
        "proof": "${proof}"
    }
}
EOF
)
        echo "DATA=$DATA" >&2
        # echo ''--digest -s -H "Accept: application/json" -H "Content-Type:application/json" -X POST --data "${DATA}" "http://${HOST}:${PORT}/index.php"'' >&2
        local RESULT_TMP=$(curl --digest -s -H "Accept: application/json" -H "Content-Type:application/json" -X POST --data "$DATA" "http://$HOST:$PORT/index.php")
        # zcho "RESULT_TMP=$RESULT_TMP" >&2
        RESULT_TMP=$(echo $RESULT_TMP | jq '.success')
        # echo "VALIDATION=$RESULT_TMP" >&2
        RESULT=$RESULT$(eval echo $RESULT_TMP)
    done
    RESULT=$RESULT"]"
    echo "VALIDATION=$RESULT" >&2
    echo $RESULT
}
export -f askFor

function bitcoinMine(){

    BC_ENV=$1
    BITCOIN_BLOCK_PARTICIPANT_NUMBER=$2
    BC_CONF_DIR=$3

    if [ $BC_ENV == "main" ];then
       local SLEEP=$((60*10*2))
       sleep $SLEEP
    else
      for a in `seq 1 $BITCOIN_BLOCK_PARTICIPANT_NUMBER`;
      do
        local BITCOIN_ADDRESS2=$(getWalletConfFileParam "b_block" $a "pubAddress" $BC_CONF_DIR)
        local BITCOIN_BLOCK_GEN=$(getWalletConfFileParamCMD "b_block" $a "B_CLI_GENERATETOADDRESS" $BC_CONF_DIR 101 $BITCOIN_ADDRESS2 "")
      done
    fi
    sleep 20
}
export -f bitcoinMine

function bitcoinAddressInfo(){

    local INDEX=$1
    local TYPE=$2
    local BC_CONF_DIR=$3

    local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
    local WALLET=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR)
    local WALLET_INFO=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETWALLETINFO" $BC_CONF_DIR "" "" "")
    local BALANCE=$(echo $WALLET_INFO | jq -r '.balance')
    local BALANCE_IMMATURE=$(echo $WALLET_INFO | jq -r '.immature_balance')
    echo "ADDRESS=$ADDRESS WALLET=$WALLET BALANCE=$BALANCE BALANCE_IMMMATURE=$BALANCE_IMMMATURE" >&2

    echo $ADDRESS
}
export -f bitcoinAddressInfo

function elementsAddressInfo(){

    local INDEX=$1
    local TYPE=$2
    local BC_CONF_DIR=$3

    local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
    local WALLET=$(getWalletConfFileParam $TYPE $INDEX "wallet_name" $BC_CONF_DIR)
    local WALLET_INFO=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETWALLETINFO" $BC_CONF_DIR "" "" "")
    local BALANCE=$(echo $WALLET_INFO | jq -r '.balance.bitcoin')
    local BALANCE_IMMMATURE=$(echo $WALLET_INFO | jq -r '.immature_balance.bitcoin')
    echo "ADDRESS=$ADDRESS WALLET=$WALLET BALANCE=$BALANCE BALANCE_IMMMATURE=$BALANCE_IMMMATURE" >&2

    echo $ADDRESS
}
export -f elementsAddressInfo

function bitcoinTxInfo(){

    local INDEX=$1
    local TYPE=$2
    local TXID=$3
    local BC_CONF_DIR=$4
    local COMMENT=$5

    echo "COMMENT=$COMMENT" >&2
    local ADDRESS=$(getWalletConfFileParam $TYPE $INDEX "pubAddress" $BC_CONF_DIR)
    local WALLET=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETTRANSACTION" $BC_CONF_DIR $TXID "" "" "")
    local WALLET_AMOUNT=$(echo $WALLET | jq '.amount')
    local WALLET_FEE=$(echo $WALLET | jq '.fee')
    local WALLET_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
    local WALLET_CATEGORY=$(echo $WALLET | jq '.details[0].category')
    local WALLET_ABANDONED=$(echo $WALLET | jq '.details[0].abandoned')
    local WALLET_HEX=$(echo $WALLET | jq '.hex')
    echo "ADDRESS=$ADDRESS $WALLET txid=${TXID} amount:${WALLET_AMOUNT} fee:${WALLET_FEE} confirmations:${WALLET_CONFIRMATION} category:${WALLET_CATEGORY} abandoned:${WALLET_ABANDONED}" >&2
    local BC=$(getWalletConfFileParamCMD $TYPE $INDEX "B_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID 1 "")
    local BC_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
    local BC_CATEGORY=$(echo $WALLET | jq '.vout[0].value')
    local BC_ADDRESS0=$(echo $WALLET | jq '.vout[0].addresses[0]')
    echo "BC txid=${TXID} confirmations:${BC_CONFIRMATION} address0:${BC_ADDRESS0}" >&2

    echo $WALLET_HEX
}
export -f bitcoinTxInfo

function elementsTxInfo(){

    local INDEX=$1
    local TYPE=$2
    local TXID=$3
    local BC_CONF_DIR=$4
    local COMMENT=$5

    echo "COMMENT=$COMMENT" >&2
    local WALLET=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETTRANSACTION" $BC_CONF_DIR $TXID "" "" "")
    local WALLET_AMOUNT=$(echo $WALLET | jq '.amount.bitcoin')
    local WALLET_FEE=$(echo $WALLET | jq '.fee.bitcoin')
    local WALLET_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
    local WALLET_CATEGORY=$(echo $WALLET | jq '.details[0].category')
    local WALLET_ABANDONED=$(echo $WALLET | jq '.details[0].abandoned')
    local WALLET_HEX=$(echo $WALLET | jq '.hex')
    echo "WALLET txid=${CLAIMTXID} amount:${WALLET_AMOUNT} fee:${WALLET_FEE} confirmations:${WALLET_CONFIRMATION} category:${WALLET_CATEGORY} abandoned:${WALLET_ABANDONED}" >&2
    local BC=$(getWalletConfFileParamCMD $TYPE $INDEX "E_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID 1 "")
    local BC_CONFIRMATION=$(echo $WALLET | jq '.confirmations')
    local BC_VALUE=$(echo $WALLET | jq '.vout[0].value')
    local BC_ASSET=$(echo $WALLET | jq '.vout[0].asset')
    echo "BC txid=${BC_TXID} confirmations:${BC_CONFIRMATION} value:${BC_VALUE} asset:${BC_ASSET}" >&2

    echo $WALLET_HEX
}

function pegBlockAddressesInfo(){

  local BC_ENV=$1
  local BITCOIN_BLOCK_PARTICIPANT_NUMBER=$2
  local BITCOIN_PEG_PARTICIPANT_NUMBER=$3
  local BLOCK_PARTICIPANT_NUMBER=$4
  local PEG_PARTICIPANT_NUMBER=$5
  local BC_CONF_DIR=$6

  local MINE=$(bitcoinMine $BC_ENV $BITCOIN_BLOCK_PARTICIPANT_NUMBER $BC_CONF_DIR)
  local NEWBLOCK=$($BC_APP_SCRIPT_DIR/blockProposal.sh $BC_ENV 1 "none")

  for a in `seq 1 $BITCOIN_BLOCK_PARTICIPANT_NUMBER`;
  do
    bitcoinAddressInfo $a "b_block" $BC_CONF_DIR >&2
  done
  for a in `seq 1 $BITCOIN_PEG_PARTICIPANT_NUMBER`;
  do
      bitcoinAddressInfo $a "b_peg" $BC_CONF_DIR >&2
  done
  for a in `seq 1 $BLOCK_PARTICIPANT_NUMBER`;
  do
    elementsAddressInfo $a "block" $BC_CONF_DIR >&2
  done
  for a in `seq 1 $PEG_PARTICIPANT_NUMBER`;
  do
    elementsAddressInfo $a "peg" $BC_CONF_DIR >&2
  done
}

export BC_ENV=$1
export CONF_FILE=/var/www/contribox-node/$BC_ENV/conf/install.json
export BLACK='\033[0;30m'
export GREY_DARK='\033[0;30m'
export RED='\033[0;31m'
export GREEN='\033[0;32m'
export BROWN='\033[0;33m'
export BLUE='\033[0;34m'
export PURPLE='\033[0;35m'
export CYAN='\033[0;36m'
export GREY_LIGHT='\033[0;37m'
export RED_LIGHT='\033[1;31m'
export GREEN_LIGHT='\033[1;32m'
export BROWN_LIGHT='\033[1;33m'
export BLUE_LIGHT='\033[1;34m'
export PURPLE_LIGHT='\033[1;35m'
export CYAN_LIGHT='\033[1;36m'
export GREY_LIGHT='\033[1;37m'
export NCOLOR='\033[0m'

confJsonGet $CONF_FILE "HOST_IP_INTERFACE"
confJsonGet $CONF_FILE "BC_ENV"
confJsonGet $CONF_FILE "NUMBER_NODES"
confJsonGet $CONF_FILE "BLOCK_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "PEG_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "EXTERNAL_IP"
confJsonGet $CONF_FILE "BC_USER"
confJsonGet $CONF_FILE "BC_RIGHTS_FILES"
confJsonGet $CONF_FILE "BC_WEB_ROOT_DIR"
confJsonGet $CONF_FILE "BC_GIT_INSTALL"
confJsonGet $CONF_FILE "BITCOIN_VERSION"
confJsonGet $CONF_FILE "ELEMENTS_VERSION"
confJsonGet $CONF_FILE "PORT_PREFIX_SERVER"
confJsonGet $CONF_FILE "PORT_PREFIX_RPC"
confJsonGet $CONF_FILE "BC_SERVER_DIR"
confJsonGet $CONF_FILE "BITCOIN_DATA_ROOT_PATH"
confJsonGet $CONF_FILE "BITCOIN_CONF_ROOT_PATH"
confJsonGet $CONF_FILE "BITCOIN_LOG_ROOT_PATH"
confJsonGet $CONF_FILE "ELEMENTS_DATA_ROOT_PATH"
confJsonGet $CONF_FILE "ELEMENTS_LOG_ROOT_PATH"
confJsonGet $CONF_FILE "ELEMENTS_CONF_ROOT_PATH"
confJsonGet $CONF_FILE "APT_UPDATE_UPGRADE"
confJsonGet $CONF_FILE "PEG"
confJsonGet $CONF_FILE "PEG_SIGNER_AMOUNT"
confJsonGet $CONF_FILE "BLOCK_SIGNER_AMOUNT"
confJsonGet $CONF_FILE "NODE_AMOUNT"
confJsonGet $CONF_FILE "NODE_INITIAL_AMOUNT"
confJsonGet $CONF_FILE "BACKUP_AMOUNT"
confJsonGet $CONF_FILE "WITNESS_AMOUNT"
confJsonGet $CONF_FILE "LOCK_AMOUNT"
confJsonGet $CONF_FILE "QT"
confJsonGet $CONF_FILE "BITCOIN_MAIN_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "BITCOIN_PEG_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "BITCOIN_BLOCK_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "BITCOIN_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "BACKUP_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "WITNESS_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "LOCK_PARTICIPANT_NUMBER"
confJsonGet $CONF_FILE "PEG_AMOUNT"
confJsonGet $CONF_FILE "BLOCK_AMOUNT"
confJsonGet $CONF_FILE "API_PORT"
confJsonGet $CONF_FILE "BLOCK_PARTICIPANT_MAX"
confJsonGet $CONF_FILE "BLOCK_PARTICIPANT_MIN"
confJsonGet $CONF_FILE "PEG_PARTICIPANT_MAX"
confJsonGet $CONF_FILE "PEG_PARTICIPANT_MIN"
confJsonGet $CONF_FILE "NEW_NODE"
confJsonGet $CONF_FILE "PHP_V"

export HOST_IP=$(/sbin/ip -o -4 addr list $HOST_IP_INTERFACE | awk '{print $4}' | cut -d/ -f1)

if [ "$BC_ENV" == "main" ];then
  export BITCOIN_ENV_INDEX="1"
  export BITCOIN_CHAIN_VAL="main"
  export ELEMENTS_ENV_INDEX="1"
  export ELEMENTS_CHAIN_VAL="main"
fi
if [ "$BC_ENV" == "regtest" ];then
  export BITCOIN_ENV_INDEX="2"
  export BITCOIN_CHAIN_VAL="regtest"
  export ELEMENTS_ENV_INDEX="2"
  export ELEMENTS_CHAIN_VAL="elementsregtest"
fi
if [ "$BC_ENV" == "testnet" ];then
  export BITCOIN_ENV_INDEX="3"
  export BITCOIN_CHAIN_VAL="testnet"
  export ELEMENTS_ENV_INDEX="3"
  export ELEMENTS_CHAIN_VAL="elementsregtest"
fi
if [ "$BC_ENV" == "liquidmainnet" ];then
  export BITCOIN_ENV_INDEX="4"
  export BITCOIN_CHAIN_VAL="main"
  export ELEMENTS_ENV_INDEX="4"
  export ELEMENTS_CHAIN_VAL="liquidv1"
fi
if [ "$BC_ENV" == "liquidregtest" ];then
  export BITCOIN_ENV_INDEX="5"
  export BITCOIN_CHAIN_VAL="regtest"
  export ELEMENTS_ENV_INDEX="5"
  export ELEMENTS_CHAIN_VAL="liquidregtest"
fi
if [ "$BC_ENV" == "liquidtestnet" ];then
  export BITCOIN_ENV_INDEX="6"
  export BITCOIN_CHAIN_VAL="testnet"
  export ELEMENTS_ENV_INDEX="6"
  export ELEMENTS_CHAIN_VAL="liquidtestnet"
fi
export BC_APP_ROOT_DIR=$BC_WEB_ROOT_DIR/contribox-node
export BC_APP_API_DIR=$BC_APP_ROOT_DIR/api
export BC_APP_INSTALL_DIR=$BC_APP_ROOT_DIR/install
export BC_APP_DIR=$BC_APP_ROOT_DIR/$BC_ENV
export BC_APP_LOG_DIR=$BC_APP_DIR/log
export BC_APP_DATA_DIR=$BC_APP_DIR/data
export BC_CONF_DIR=$BC_APP_DIR/conf
export BC_APP_SCRIPT_DIR=$BC_APP_DIR/script
export BC_OWNER_FILES=$BC_USER
export BITCOIN_DATA_PATH=$BITCOIN_DATA_ROOT_PATH/$BC_ENV
export BITCOIN_DATA_PATH=$BITCOIN_DATA_ROOT_PATH/$BC_ENV
export BITCOIN_CONF_FILE=$BC_CONF_DIR/"bitcoin_"$BC_ENV".conf"
export BITCOIN_DIR=$BC_SERVER_DIR/bitcoin-$BITCOIN_VERSION/bin
export BITCOIN_INSTALL="bitcoin-$BITCOIN_VERSION-x86_64-linux-gnu.tar.gz"
export BITCOIN_HOST_IP=$HOST_IP
export BITCOIN_BIND_VAL="$BITCOIN_HOST_IP"
export BITCOIN_BIND="bind=$BITCOIN_BIND_VAL"
export BITCOIN_CHAIN_VAL=$BC_ENV
export BITCOIN_CHAIN="chain=$BC_ENV"
export BITCOIN_SECTION="[$BC_ENV]"
export BITCOIN_SECTION_ACTIVE="$BC_ENV=1"
export BITCOIN_SECTION_PREFIX="$BC_ENV."
export BITCOIN_CHAIN="chain=$BITCOIN_CHAIN_VAL"
export BITCOIN_SECTION="[$BITCOIN_CHAIN_VAL]"
export BITCOIN_SECTION_ACTIVE="$BITCOIN_CHAIN_VAL=1"
export BITCOIN_SECTION_PREFIX="chain=$BITCOIN_CHAIN_VAL."
export PORT_BITCOIN=$PORT_PREFIX_SERVER$BITCOIN_ENV_INDEX
export BITCOIN_PORT="port=$PORT_BITCOIN"
export BITCOIN_DATADIR_VAL=$BITCOIN_DATA_PATH
export BITCOIN_DATADIR="datadir=$BITCOIN_DATA_PATH"
export BITCOIN_DEBUG_FILE_VAL="$BC_APP_LOG_DIR/bitcoind_"$BC_ENV".log"
export BITCOIN_DEBUG_FILE="debuglogfile=$BITCOIN_DEBUG_FILE_VAL"
export BITCOIN_PARAMS="-conf="$BITCOIN_CONF_FILE
export B_DAEMON="${BITCOIN_DIR}/bitcoind ${BITCOIN_PARAMS}"
export B_QT="${BITCOIN_DIR}/bitcoin-qt ${BITCOIN_PARAMS}"
export B_DEBUG="tail -f ${BITCOIN_DEBUG_FILE_VAL}"
export BC_OWNER_FILES=$BC_USER
export ELEMENTS_DIR=$BC_SERVER_DIR/elements-$ELEMENTS_VERSION/bin
export ELEMENTS_INSTALL="elements-$ELEMENTS_VERSION-x86_64-linux-gnu.tar.gz"
export ELEMENTS_HOST_IP=$HOST_IP
export ELEMENTS_BIND="bind=$ELEMENTS_HOST_IP"
export ELEMENTS_CHAIN="chain=$ELEMENTS_CHAIN_VAL"
export ELEMENTS_SECTION="[$ELEMENTS_CHAIN_VAL]"
export ELEMENTS_SECTION_ACTIVE="[$ELEMENTS_CHAIN_VAL]"
export ELEMENTS_SECTION_PREFIX="$ELEMENTS_CHAIN_VAL."
export BC_API_LOG_FILE=$BC_APP_LOG_DIR/api.log
export PHP_V=$PHP_V
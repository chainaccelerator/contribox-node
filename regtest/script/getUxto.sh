 #!/bin/bash

shopt -s expand_aliases

function getUtxoFromAddress() {

    # echo "" >&2
    # echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local COUNT=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_BLOCKCOUNT" $BC_CONF_DIR "" "" "")

    for a in `seq 1 $COUNT`;
    do
      local COUNT=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_BLOCKCOUNT" $BC_CONF_DIR "" "" "")
    done


    local BC_ENV="$1"
    local TXID=$2
    local INDEX=$3

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV
    HEX=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_GETTXOUT" $BC_CONF_DIR $TXID 1 "")

    echo $BLOCKCOUNT2
}
export -f blockProposal

RES=$(getUtxo ${1} ${2})

echo $RES


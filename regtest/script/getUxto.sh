 #!/bin/bash

shopt -s expand_aliases

function getUtxoFromAddress() {

    # echo "" >&2
    # echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local BC_ENV="$1"

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    local COUNT=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_BLOCKCOUNT" $BC_CONF_DIR "" "" "")
    local VOUTUNSPENT

    for a in `seq 0 $COUNT`;
    do
      local BLOCKCHASH=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_GETBLOCKHASH" $BC_CONF_DIR $a)
      local BLOCK=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_GETBLOCK" $BC_CONF_DIR $BLOCKCHASH)

     for TXID in $(echo "${BLOCK}" | jq -r '.tx[] | @base64');
     do
          local TX=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_GETRAWTRANSACTION" $BC_CONF_DIR $TXID true)
          local VOUTSPEND=$(echo $TX | jq '.vout.value')
          local VOUT=$(getWalletConfFileParamCMD "federation/node" $INDEX "E_CLI_GETTOUT" $BC_CONF_DIR $TXID 1 1)
          local VOUTUNSPENT=$(echo $VOUT | jq '.value')
          local RES='{"tx": "''", vout: "'$VOUTSPEND'", voutunspent: "'$VOUTUNSPENT'"}'
      done
    done
    echo $BLOCKCOUNT2
}
export -f blockProposal

RES=$(getUtxo ${1} ${2})

echo $RES


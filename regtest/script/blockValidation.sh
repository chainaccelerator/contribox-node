 #!/bin/bash

shopt -s expand_aliases

function blockValidation() {

    #echo "" >&2
    #echo -e "${CYAN_LIGHT}[BLOCK]$NCOLOR" >&2

    local BC_ENV=$1
    local INDEX=$2
    local HEX=$3
    # echo "BC_ENV=$BC_ENV" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    local REDEEMSCRIPT=$(getWalletConfFileParam "block" $INDEX "BLOCK_REDEEMSCRIPT" $BC_CONF_DIR "" "" "")
    local SIGN1=$(getWalletConfFileParamCMD "block" $INDEX "E_CLI_SIGNBLOCK" $BC_CONF_DIR $HEX "$REDEEMSCRIPT" "")
    local SIGN1DATA=$(echo $SIGN1 | jq '.[0]')
    echo $SIGN1DATA
}
export -f blockValidation

RES=$(blockValidation ${1} ${2} ${3})

echo $RES


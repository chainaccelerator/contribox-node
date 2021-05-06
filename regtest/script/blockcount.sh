 #!/bin/bash

shopt -s expand_aliases

function blockcount() {

    # echo "" >&2
    # echo -e "${CYAN_LIGHT}[BLOCK COUNT]$NCOLOR" >&2

    local BC_ENV=$1

    # echo "BC_ENV=$BC_ENV" >&2

    local BASEDIR0=$(dirname "$0")
    source $BASEDIR0/../../conf/conf.sh $BC_ENV

    local BLOCK=$(getWalletConfFileParamCMD "block" 1 "E_CLI_GETBLOCKCOUNT" $BC_CONF_DIR "" "" "")

    echo $BLOCK
}
export -f blockcount

BLOCKCOUNT=$(blockcount ${1})

echo $BLOCKCOUNT

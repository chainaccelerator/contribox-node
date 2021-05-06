 #!/bin/bash

shopt -s expand_aliases


function pegIn() {

    echo "" >&2
    echo -e "${CYAN_LIGHT}[PEG IN]$NCOLOR" >&2

    local BC_ENV=$1
    local TXID=$2

    echo "BC_ENV=$BC_ENV" >&2
    echo "TXID=$TXID" >&2

    local BASEDIR=$(dirname "$0")
    source $BASEDIR/../../conf/conf.sh $BC_ENV

    local ADDRESS_CONF_FILE=$(addressFind $ADDRESS $MAX_PEG $MAX_BLOCK $MAX_MAIN $MAX_BACKUP $MAX_LOCK $MAX_WITNESS $BC_CONF_DIR)
    local ADDRESS_TYPE=$(cat $ADDRESS_CONF_FILE | jq '.addressType')

  cat > $BC_DATA_DIR/tx_${TXID}.json / <<EOL
{
    "BC_ENV": "${BC_ENV}",
    "TXID": "${TXID}",
    "ADDRESS_CONF_FILE": "${ADDRESS_CONF_FILE}",
    "ADDRESS_TYPE": "${ADDRESS_TYPE}"
}
EOL

}
export -f notify

export NOTIFY=$(notify ${1} ${2})


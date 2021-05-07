 #!/bin/bash

shopt -s expand_aliases

function notify() {

    # echo "" >&2
    # echo -e "${CYAN_LIGHT}[NOTIFY]$NCOLOR" >&2

    local BC_ENV=$1
    local TXID=$2

    # echo "BC_ENV=$BC_ENV" >&2
    # echo "TXID=$TXID" >&2

    local BASEDIR=$(dirname "$0")
    # echo $BASEDIR >&2
    source $BASEDIR/../../conf/conf.sh $BC_ENV
    # echo $BC_APP_DATA_DIR >&2
    local FILE="$BC_APP_DATA_DIR/e_tx_${TXID}.json"
    echo "FILE=$FILE" >&2

    echo $FILE

  cat >$FILE <<EOL
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


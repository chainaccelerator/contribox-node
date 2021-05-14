#!/bin/bash

shopt -s expand_aliases

clear

apt update -q=2 -y  > /dev/null 2>&1
apt full-upgrade -y -qq  > /dev/null 2>&1
apt install curl git jq wget lsb-release apt-transport-https ca-certificates sed dos2unix -y -qq  > /dev/null  2>&1

export BITCOIN_PID=$(pidof 'bitcoin-qt')
if [ -n "$BITCOIN_PID" ];then
  kill -9 $BITCOIN_PID
fi

export ELEMENTS_PID=$(pidof 'elements-qt')
if [ -n "$ELEMENTS_PID" ];then
  kill -9 $ELEMENTS_PID
fi

export BASEDIR=$(dirname "$0")
export BC_CFILE=$BASEDIR/../conf/conf.sh
source $BC_CFILE $1
export CONF_FILE=$BC_CONF_DIR/conf.json

export NEW_NODE=$2
export BC_USER=$3
export BC_RIGHTS_FILES=$4
export HOST_IP=$5
export EXTERNAL_IP=$6
export FIRST_CONNECT=$7

echo  "HOST_IP=$HOST_IP"
echo  "FIRST_CONNECT=$FIRST_CONNECT"

cat > $CONF_FILE <<EOL
{
    "NUMBER_NODES": ${NUMBER_NODES},
    "HOST_IP": "${HOST_IP}",
    "EXTERNAL_IP": "${EXTERNAL_IP}",
    "FIRST_CONNECT": "${FIRST_CONNECT}",
    "FIRST_CONNECT": "${FIRST_CONNECT}",
    "PORT_PREFIX_SERVER": "${PORT_PREFIX_SERVER}",
    "PORT_PREFIX_RPC": "${PORT_PREFIX_RPC}",
    "BC_SERVER_DIR": "${BC_SERVER_DIR}",
    "PEG_SIGNER_AMOUNT": ${PEG_SIGNER_AMOUNT},
    "BLOCK_SIGNER_AMOUNT": ${BLOCK_SIGNER_AMOUNT},
    "NODE_AMOUNT": ${NODE_AMOUNT},
    "BACKUP_AMOUNT": ${BACKUP_AMOUNT},
    "WITNESS_AMOUNT": ${WITNESS_AMOUNT},
    "LOCK_AMOUNT": ${LOCK_AMOUNT},
    "PEG_AMOUNT": ${PEG_AMOUNT},
    "BLOCK_AMOUNT": ${BLOCK_AMOUNT},
    "API_PORT": "${API_PORT}",
    "BITCOIN_MAIN_PARTICIPANT_NUMBER": ${BITCOIN_MAIN_PARTICIPANT_NUMBER},
    "BITCOIN_PEG_PARTICIPANT_NUMBER": ${BITCOIN_PEG_PARTICIPANT_NUMBER},
    "BITCOIN_BLOCK_PARTICIPANT_NUMBER": ${BITCOIN_BLOCK_PARTICIPANT_NUMBER},
    "BLOCK_PARTICIPANT_NUMBER": ${BLOCK_PARTICIPANT_NUMBER},
    "PEG_PARTICIPANT_NUMBER": ${PEG_PARTICIPANT_NUMBER},
    "BACKUP_PARTICIPANT_NUMBER": ${BACKUP_PARTICIPANT_NUMBER},
    "WITNESS_PARTICIPANT_NUMBER": ${WITNESS_PARTICIPANT_NUMBER},
    "LOCK_PARTICIPANT_NUMBER": ${LOCK_PARTICIPANT_NUMBER},
    "BLOCK_PARTICIPANT_MAX": ${BLOCK_PARTICIPANT_MAX},
    "BLOCK_PARTICIPANT_MIN": ${BLOCK_PARTICIPANT_MIN},
    "PEG_PARTICIPANT_MAX": ${PEG_PARTICIPANT_MAX},
    "PEG_PARTICIPANT_MIN": ${PEG_PARTICIPANT_MIN},
    "BC_ENV": "${BC_ENV}",
    "BC_USER": "${BC_USER}",
    "BC_RIGHTS_FILES": ${BC_RIGHTS_FILES},
    "BC_WEB_ROOT_DIR": "${BC_WEB_ROOT_DIR}",
    "BC_GIT_INSTALL": "${BC_GIT_INSTALL}",
    "BC_APP_ROOT_DIR": "${BC_APP_ROOT_DIR}",
    "BC_APP_API_DIR": "${BC_APP_API_DIR}",
    "BC_APP_INSTALL_DIR": "${BC_APP_INSTALL_DIR}",
    "BC_APP_DIR": "${BC_APP_DIR}",
    "BC_APP_LOG_DIR": "${BC_APP_LOG_DIR}",
    "BC_APP_DATA_DIR": "${BC_APP_DATA_DIR}",
    "BC_CONF_DIR": "${BC_CONF_DIR}",
    "BC_SCRIPT_DIR": "${BC_APP_SCRIPT_DIR}",
    "BITCOIN_VERSION": "${BITCOIN_VERSION}",
    "BITCOIN_ENV_INDEX": ${BITCOIN_ENV_INDEX},
    "BITCOIN_CHAIN_VAL": "${BITCOIN_CHAIN_VAL}",
    "BITCOIN_CONF_FILE": "${BITCOIN_CONF_FILE}",
    "BITCOIN_DIR": "${BITCOIN_DIR}",
    "BITCOIN_INSTALL": "${BITCOIN_INSTALL}",
    "BITCOIN_HOST_IP": "${BITCOIN_HOST_IP}",
    "BITCOIN_BIND_VAL": "${BITCOIN_BIND_VAL}",
    "BITCOIN_BIND": "${BITCOIN_BIND}",
    "BITCOIN_CHAIN": "${BITCOIN_CHAIN}",
    "BITCOIN_SECTION": "${BITCOIN_SECTION}",
    "BITCOIN_SECTION_ACTIVE": "${BITCOIN_SECTION_ACTIVE}",
    "BITCOIN_SECTION_PREFIX": "${BITCOIN_SECTION_PREFIX}",
    "PORT_BITCOIN": "${PORT_BITCOIN}",
    "BITCOIN_PORT": "${BITCOIN_PORT}",
    "BITCOIN_DATADIR_VAL": "${BITCOIN_DATADIR_VAL}",
    "BITCOIN_DATADIR": "${BITCOIN_DATADIR}",
    "BITCOIN_DEBUG_FILE_VAL": "${BITCOIN_DEBUG_FILE_VAL}",
    "BITCOIN_DEBUG_FILE": "${BITCOIN_DEBUG_FILE}",
    "BITCOIN_PARAMS": "${BITCOIN_PARAMS}",
    "B_DAEMON": "${B_DAEMON}",
    "B_QT": "${B_QT}",
    "B_DEBUG": "${B_DEBUG}",
    "ELEMENTS_VERSION": "${ELEMENTS_VERSION}",
    "ELEMENTS_ENV_INDEX": ${ELEMENTS_ENV_INDEX},
    "ELEMENTS_CHAIN_VAL": "${ELEMENTS_CHAIN_VAL}",
    "ELEMENTS_DIR": "${ELEMENTS_DIR}",
    "ELEMENTS_INSTALL": "${ELEMENTS_INSTALL}",
    "ELEMENTS_HOST_IP": "${ELEMENTS_HOST_IP}",
    "ELEMENTS_BIND": "${ELEMENTS_BIND}",
    "ELEMENTS_CHAIN": "${ELEMENTS_CHAIN}",
    "ELEMENTS_SECTION": "${ELEMENTS_SECTION}",
    "ELEMENTS_SECTION_ACTIVE": "${ELEMENTS_SECTION_ACTIVE}",
    "ELEMENTS_SECTION_PREFIX": "${ELEMENTS_SECTION_PREFIX}",
    "PHP_V": "${PHP_V}"
}
EOL
chmod $BC_RIGHTS_FILES $CONF_FILE
chown $BC_USER $CONF_FILE

PHP_V_TMP=$(php -r 'echo PHP_VERSION;')

if [ $APT_UPDATE_UPGRADE -eq 1 ] && [ ! "$PHP_V_TMP" == '8.0.5' ]; then

    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" |tee /etc/apt/sources.list.d/php.list
    apt install php8.0 php8.0-fpm php8.0-{curl,cli,common,mbstring,gd,intl,bcmath,gmp,mcrypt} php-sodium -y
    contribox_mkdir '/var/log/php'
    php -r 'echo PHP_VERSION;'
fi
contribox_mkdir $BC_WEB_ROOT_DIR

if [ ! -d $BC_APP_ROOT_DIR ]; then
  contribox_mkdir $BC_WEB_ROOT_DIR
  cd $BC_WEB_ROOT_DIR
  get clone $BC_GIT_INSTALL
  chmod $BC_RIGHTS_FILES $BC_APP_ROOT_DIR -R
  chown $BC_OWNER_FILES $BC_APP_ROOT_DIR -R
fi
cd $BC_APP_INSTALL_DIR

if [ -z "$BC_CONF_DIR" ];then
  echo "BAD CONFIGURATION FILE"
  exit
fi

rm -rf $BC_CONF_DIR/b_node_regtest_1.json
rm -rf $BC_CONF_DIR/*wallets.json
rm -rf $BC_CONF_DIR/b_*
rm -rf $BC_CONF_DIR/e_*
rm -rf $BC_APP_LOG_DIR/*
rm -rf $BC_APP_DATA_DIR/*
contribox_mkdir $BC_APP_DIR
contribox_mkdir $BC_APP_LOG_DIR
contribox_mkdir $BC_APP_DATA_DIR
contribox_rmdir $BITCOIN_DATA_ROOT_PATH
contribox_mkdir $BITCOIN_DATA_ROOT_PATH
contribox_rmdir $BITCOIN_CONF_ROOT_PATH
contribox_mkdir $BITCOIN_CONF_ROOT_PATH
contribox_rmdir $BITCOIN_LOG_ROOT_PATH
contribox_mkdir $BITCOIN_LOG_ROOT_PATH
contribox_rmdir $BITCOIN_DATA_PATH
contribox_mkdir $BITCOIN_DATA_PATH
contribox_rmdir $ELEMENTS_DATA_ROOT_PATH
contribox_mkdir $ELEMENTS_DATA_ROOT_PATH
contribox_rmdir $ELEMENTS_CONF_ROOT_PATH
contribox_mkdir $ELEMENTS_CONF_ROOT_PATH
contribox_rmdir $ELEMENTS_LOG_ROOT_PATH
contribox_mkdir $ELEMENTS_LOG_ROOT_PATH
contribox_rmdir ${BC_CONF_DIR}/federation
contribox_mkdir ${BC_CONF_DIR}/federation
contribox_rmdir ${BC_CONF_DIR}/local
contribox_mkdir ${BC_CONF_DIR}/local
contribox_rmdir ${BC_CONF_DIR}/shared
contribox_mkdir ${BC_CONF_DIR}/shared

source $BC_APP_INSTALL_DIR/configure.sh

serversUp "php"
serversUp "bitcoin"
serversUp "elements"

#!/bin/bash

shopt -s expand_aliases

clear

export BC_ENV=$1
export BC_USER=$2
export FIRST_CONNECT=$3
export EXTERNAL_IP=$4
export NEW_NODE=1

source /var/www/contribox-node/install/install_sidechain.sh $BC_ENV $BC_USER $FIRST_CONNECT $EXTERNAL_IP


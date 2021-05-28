#!/bin/bash

shopt -s expand_aliases

clear

export BC_ENV=$1
export BC_USER=$2
export BC_RIGHTS_FILES=$3
export EXTERNAL_IP=$4
export FIRST_CONNECT=$5

export IP=$(ip -j address | jq '.[1].addr_info[0].local')
export HOST_IP=$IP

# echo  "BC_ENV=$BC_ENV"
# echo  "BC_USER=$BC_USER"
# echo  "BC_RIGHTS_FILES=$BC_RIGHTS_FILES"
# echo  "EXTERNAL_IP=$EXTERNAL_IP"
# echo  "HOST_IP=$HOST_IP"
# echo  "FIRST_CONNECT=$FIRST_CONNECT"
# export EXTERNAL_IP="10.10.242.30"
# export FIRST_CONNECT="10.0.0.2"

if [ ! -d "/var/www" ];then

  mkdir "/var/www"
  chmod $BC_USER "/var/www"
  chown $BC_RIGHTS_FILES "/var/www"
fi
if [ -d "/var/www/contribox-node" ];then

  rm -rf /var/www/contribox-node
fi

apt install git -y
git clone 'https://github.com/chainaccelerator/contribox-node.git' /var/www/contribox-node
cd /var/www/contribox-node/install
source /var/www/contribox-node/install/install_sidechain.sh $BC_ENV 1 $BC_USER $BC_RIGHTS_FILES $EXTERNAL_IP $HOST_IP $FIRST_CONNECT


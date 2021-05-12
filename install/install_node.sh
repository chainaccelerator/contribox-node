#!/bin/bash

shopt -s expand_aliases

clear

export BC_ENV=$1
export BC_USER=$2
export BC_RIGHTS_FILES=$3
export EXTERNAL_IP=$4
export FIRST_CONNECT=$5
# export EXTERNAL_IP="10.10.242.30"
# export FIRST_CONNECT="10.0.0.2"

if [ ! -d "/var/www/" ];then

  mkdir "/var/www/"
  chmod $BC_USER "/var/www/"
  chown $BC_RIGHTS_FILES "/var/www/"
fi

cd /var/www/

git clone 'https://github.com/ncantu/contribox-node-php.git'
cd contribox-node-php/install/install
source /var/www/contribox-node-php/install/install_sidechain.sh $BC_ENV 1 $BC_USER $BC_RIGHTS_FILES $EXTERNAL_IP $FIRST_CONNECT

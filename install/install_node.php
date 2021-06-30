<?php

require_once '../lib/_require.php';

if(isset($argv[0]) === true) Shell::$BC_ENV=$argv[0];
else return false;
if(isset($argv[1]) === true) Shell::$BC_USER=$argv[1];
else return false;
if(isset($argv[2]) === true) Shell::$FIRST_CONNECT=$argv[2];
else return false;
if(isset($argv[3]) === true) Shell::$EXTERNAL_IP=$argv[3];
else {
    Shell::$EXTERNAL_IP = Shell::ipGet();
}
Shell::cmdPhp('install_sidechain.php '.Shell::$BC_ENV.' '.Shell::$BC_USER .' '.Shell::$EXTERNAL_IP.' '.Shell::$FIRST_CONNECT.' 1');


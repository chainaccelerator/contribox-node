<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set("log_errors", "1");
ini_set("error_log", "/var/log/api.log");

require_once 'lib/conf.php';
require_once 'lib/node.php';
require_once 'lib/address.php';
require_once 'lib/wallet.php';
require_once 'lib/rpc.php';

<?php

require_once '../lib/_require.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

SdkReceivedData::run();

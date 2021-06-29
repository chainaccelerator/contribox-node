<?php

class SdkReceived {

    public static array $peerList = [];
    public static SdkRequest $request;
    public static SdkRequestRoute $route;
    public static SdkReceiveValidation $validation;

    public static function run(){

    }
    public static function send(){

        header('Content-Type: application/json');

        echo '{
  "peerList": [
    {
      "rpcBitcoin": {
        "connect": "",
        "user": "",
        "pwd": ""
      },
      "rpcElements": {
        "connect": "",
        "user": "",
        "pwd": ""
      },
      "api": {
        "connect": "10.10.214.118:7002",
        "user": "",
        "pwd": ""
      }
    }
  ],
  "request": {
    "timestamp": 1624975306845,
    "peerList": [],
    "pow": {
      "nonce": 31692,
      "difficulty": 4,
      "difficultyPatthern": "d",
      "hash": "7e5cebffe6b88b8c49600845a3c06e5296014b114213ee5a35f666c7bed41bc2c853ea576c0f0c2ede63ab225146aed2b0a8da832b2c72590904b770e25be45d",
      "pow": "dddd073085ca6cbef3886ca63da32d8f1ecbd04fbeccce0bd32aff051134b632ffe603e60d112dabec0458e58e09a37f7eb4b0a3d3c63fa56b6927a15f9d2fea",
      "previousHash": "default"
    },
    "sig": {
      "hash": "a52c5a4e3064cb4d32d16ba663b1ce00d5f2c8480a03cd2f619d5d6ee25aa77417a59f68704b6631a830711d2ed336f22a288c81d758df17127c5dff8d81783b",
      "xpub": "tpubD6NzVbkrYhZ4YSHpPfgiqFd75jEGeMit2L4xPKs2373mWWChBjGaHov6DMVLqXB8WAKbX2JQAd81Bi8nU5uiFvHmwWjRsJtuMJApQcynY9i",
      "hdPath": "0/0",
      "range": 0,
      "address": "2dq3kYsVxdu4cJGVwSZvxe3TsGfgyunAn95",
      "signature": "IGj5O14aeefIzmyjJQtTR4NJyiUBwnW9/m3JqWGo0EW6eq53UjcFV2EcxE8uGTxYWa/XIzY36+lARMZMr8/zrFk="
    }
  },
  "route": {
    "id": "default",
    "version": "0.1",
    "env": "regtest",
    "template": "default"
  },
  "result": {
    "status": true,
    "code": 0,
    "message": "",
    "hash": "",
    "data": {}
  }
}';
    }
}


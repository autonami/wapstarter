<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {}
  },
  "exec": {
    "steps": [
      "SecurityProviders/siteSecurity",
      {
        "name": "",
        "module": "auth",
        "action": "logout",
        "options": {
          "provider": "siteSecurity"
        }
      },
      {
        "name": "loggedin",
        "module": "core",
        "action": "setsession",
        "options": {
          "value": 0
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>
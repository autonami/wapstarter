<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
    "$_SESSION": [
      {
        "type": "boolean",
        "name": "loggedin"
      },
      {
        "type": "text",
        "name": "username"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/db",
      "SecurityProviders/siteSecurity",
      {
        "name": "identity",
        "module": "auth",
        "action": "login",
        "options": {
          "provider": "siteSecurity"
        },
        "output": false,
        "meta": []
      },
      {
        "name": "loggedin",
        "module": "core",
        "action": "setsession",
        "options": {
          "value": 1
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>
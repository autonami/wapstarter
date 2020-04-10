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
    "$_POST": [
      {
        "type": "text",
        "name": "password"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/db",
      "SecurityProviders/siteSecurity",
      {
        "name": "",
        "module": "auth",
        "action": "restrict",
        "options": {
          "provider": "siteSecurity"
        }
      },
      {
        "name": "updatePassword",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "db",
          "sql": {
            "type": "update",
            "values": [
              {
                "table": "users",
                "column": "password",
                "type": "text",
                "value": "{{$_POST.password}}"
              }
            ],
            "table": "users",
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "userid",
                  "field": "userid",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{siteSecurity.identity}}",
                  "data": {
                    "column": "userid"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "UPDATE users\nSET password = :P1 /* {{$_POST.password}} */\nWHERE userid = :P2 /* {{siteSecurity.identity}} */",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.password}}"
              },
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P2",
                "value": "{{siteSecurity.identity}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>
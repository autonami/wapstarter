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
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
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
        "name": "get_user_details",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "db",
          "sql": {
            "type": "SELECT",
            "columns": [],
            "table": {
              "name": "users"
            },
            "joins": [],
            "wheres": {
              "condition": "AND",
              "rules": [
                {
                  "id": "users.userid",
                  "field": "users.userid",
                  "type": "double",
                  "operator": "equal",
                  "value": "{{siteSecurity.identity}}",
                  "data": {
                    "table": "users",
                    "column": "userid",
                    "type": "number"
                  },
                  "operation": "="
                }
              ],
              "conditional": null,
              "valid": true
            },
            "query": "SELECT *\nFROM users\nWHERE userid = :P1 /* {{siteSecurity.identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{siteSecurity.identity}}"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "userid",
            "type": "number"
          },
          {
            "name": "username",
            "type": "text"
          },
          {
            "name": "password",
            "type": "text"
          },
          {
            "name": "email",
            "type": "text"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>
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
    ],
    "$_POST": [
      {
        "type": "text",
        "name": "username"
      },
      {
        "type": "text",
        "name": "password"
      },
      {
        "type": "text",
        "name": "email"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/db",
      {
        "name": "userunique",
        "module": "validator",
        "action": "validate",
        "options": {
          "data": [
            {
              "name": "validate_username",
              "value": "{{$_POST.username}}",
              "rules": {
                "db:notexists": {
                  "param": {
                    "connection": "db",
                    "table": "users",
                    "column": "username"
                  },
                  "message": "This username is already taken. Please select a new username."
                }
              }
            },
            {
              "name": "validate_email",
              "value": "{{$_POST.email}}",
              "rules": {
                "db:notexists": {
                  "param": {
                    "connection": "db",
                    "table": "users",
                    "column": "email"
                  },
                  "message": "This email is already registered."
                }
              }
            }
          ]
        }
      },
      {
        "name": "insert_user",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "db",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "users",
                "column": "username",
                "type": "text",
                "value": "{{$_POST.username}}"
              },
              {
                "table": "users",
                "column": "password",
                "type": "text",
                "value": "{{$_POST.password.passwordHash(\"argon2id\")}}"
              },
              {
                "table": "users",
                "column": "email",
                "type": "text",
                "value": "{{$_POST.email}}"
              }
            ],
            "table": "users",
            "query": "INSERT INTO users\n(username, password, email) VALUES (:P1 /* {{$_POST.username}} */, :P2 /* {{$_POST.password.passwordHash(\"argon2id\")}} */, :P3 /* {{$_POST.email}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.username}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.password.passwordHash(\"argon2id\")}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.email}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ],
        "output": false
      },
      {
        "name": "get_registered_user",
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
                  "value": "{{insert_user.identity}}",
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
            "query": "SELECT *\nFROM users\nWHERE userid = :P1 /* {{insert_user.identity}} */",
            "params": [
              {
                "operator": "equal",
                "type": "expression",
                "name": ":P1",
                "value": "{{insert_user.identity}}"
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
      },
      {
        "name": "loginrepeat",
        "module": "core",
        "action": "repeat",
        "options": {
          "repeat": "{{get_registered_user}}",
          "exec": {
            "steps": [
              {
                "name": "hash",
                "module": "core",
                "action": "setvalue",
                "options": {
                  "key": "hash",
                  "value": "{{email.sha1(password)}}"
                }
              },
              {
                "name": "email",
                "module": "core",
                "action": "setvalue",
                "options": {
                  "key": "email",
                  "value": "{{email}}"
                }
              },
              {
                "name": "mailer",
                "module": "mail",
                "action": "setup",
                "options": {},
                "disabled": true
              },
              {
                "name": "",
                "module": "mail",
                "action": "send",
                "options": {
                  "instance": "mailer",
                  "subject": "App - Verify your email.",
                  "fromName": "Site Name",
                  "fromEmail": "auto@email.com",
                  "toEmail": "{{email}}",
                  "toName": "{{username}}",
                  "contentType": "html",
                  "body": "<p>Click this <a href=\"http://localhost:8100/verify_email.php?email={{email}}&amp;id={{hash}}\">link</a> to verify your email.</p>"
                },
                "disabled": true
              }
            ]
          }
        },
        "meta": [
          {
            "name": "$index",
            "type": "number"
          },
          {
            "name": "$number",
            "type": "number"
          },
          {
            "name": "$name",
            "type": "text"
          },
          {
            "name": "$value",
            "type": "object"
          },
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
          },
          {
            "name": "identity",
            "type": "text",
            "sub": []
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
<?php
$exports = <<<'JSON'
{
  "name": "siteSecurity",
  "module": "auth",
  "action": "provider",
  "options": {
    "secret": "35TdcAiIk66Gu1K",
    "provider": "Database",
    "connection": "db",
    "users": {
      "table": "users",
      "identity": "userid",
      "username": "username",
      "password": "password"
    },
    "permissions": {},
    "passwordVerify": true
  },
  "meta": [
    {
      "name": "identity",
      "type": "text"
    }
  ]
}
JSON;
?>
# pre_city
Proof of concept for [City](https://github.com/Openpoint/City) in PHP

Requires: 
PHP >=5
PHP PDO and pdo_pgsql 
Postgresql server >=9 with PostGIS

Runs with apache2 webserver.

Create a new pg database and user. Give user "superuser" privelidge (strange bug with permissions I couldn't figure). Assign user to db

Using pg_restore (phppgadmin is choking) restore \<approot\>/dbpopulate.sql to your new database.

Create \<approot\>/php/settings.php:

```php
<?php
//-----------------------------------------Database---------------------------------------------------
$settings = new stdClass;
$settings->dbase=array(
    'username'=>'city',
    'password'=>'localpassword',
    'db_name'=>'pre_city',
    'host'=>'localhost',
    'port'=>'5432'
);
```
Configure your Apache2 .conf file for you environment and you should be good to go with the demo.

# JadarBank

## Crear Base de datos
Debes primero crear una base de datos con el nombre jadarbank

```sql
  CREATE DATABASE jadarbank CHARACTER SET utf8 COLLATE utf8_general_ci;
```
Después debes importar la base de datos que esta dentro de `database/jadarbank.sql` ya sea con mysql, phpmyadmin, etc.

## Cofigurar base de datos 
Una vez realizado el paso anterior debes editar el archivo que se encuentra en `config/config.php` estando ahí debes modificar el USER, PASSWORD y HOST según sea tu caso, si cambiaste el nombre a la base de datos tambien deberas cambiasr el campo DB.

```php
<?php
    define('PASSWORD','Your password');
    define('DB','jadarbank');
    define('USER','Your user');
    define('CHARSET','utf8mb4');
    define('HOST','localhost');
?>
```

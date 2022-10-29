# JadarBank

## Crear Base de datos
Debes primero crear una base de datos con el nombre jadarbank

```sql
  CREATE DATABASE jadarbank CHARACTER SET utf8 COLLATE utf8_general_ci;
```
Después debes importar la base de datos que esta dentro de database/jadarbank.sql ya sea con mysql, phpmyadmin, etc.

## Cofigurar base de datos 
Para utilizar la base de datos debes entrar al directorio config dentro estar el archivo config.php dentro deberas cambiar las variables segun corresponda tu caso

```php
<?php
    define('PASSWORD','Your password');
    define('USER','Your user');
?>
```

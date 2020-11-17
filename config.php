<?php

define('DB_NAME', 'proyecto27_db');
define('DB_USER', 'bryan12');
define('DB_PASSWORD', 'Bryan-123');
define('DB_HOST', 'localhost');

$mysqli =  new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

date_default_timezone_set('America/La_Paz');

?>
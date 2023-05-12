<?php
$host="localhost"; // адрес сервера с базой данных MS SQL
$user='***********';  //имя пользователя для подключения к базе данных
$pwd="************";  //пароль для подключения к базе данных
$islocal=false; // режим локальной версии позволяет просматривать ФИО и редактировать карточки процессов без авторизации (меняем значение на true)
$db_name='processes'; // имя базы данных
ini_set('mssql.charset', 'utf8');
$db=mssql_connect($host,$user,$pwd);              
if (isset($_COOKIE['org_id'])) {echo'';}else{setcookie("org_id", 0);}
if (mssql_select_db($db_name,$db)){}else{echo "Ошибка подключения к базе данных.<br>".mssql_get_last_message()."<br>Проверьте настройки подключения в файле /var/www/html/config.php";die();};
?>
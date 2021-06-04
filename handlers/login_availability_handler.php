<?php
$config = include("../config.php");

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$wanted_login = $_GET['login'];

$check_login = "SELECT * FROM client WHERE login='$wanted_login';";
$result = pg_query($check_login) or die ('Ошибка запроса: ' . pg_last_error());

if (pg_num_rows($result) == 0) {
    echo json_encode(array('status' => true), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('status' => false), JSON_UNESCAPED_UNICODE);
}

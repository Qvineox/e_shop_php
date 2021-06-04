<?php
$config = include("../config.php");

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$wanted_email = $_GET['email'];

$check_email = "SELECT * FROM client WHERE email='$wanted_email';";
$result = pg_query($check_email) or die ('Ошибка запроса: ' . pg_last_error());

if (pg_num_rows($result) == 0) {
    echo json_encode(array('status' => true), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('status' => false), JSON_UNESCAPED_UNICODE);
}

<?php
session_start();
$config = include("../config.php");

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

if (isset($_SESSION['user_id'])) {
    $items = @$_SESSION['items'];

    $json = array();

    foreach ($items as $id => $count) {
        $query = "SELECT name, image, price FROM item WHERE id=$id";
        $data = pg_fetch_array(pg_query($query));

        $item_data = array('id' => $id, 'count' => $count, 'price' => $data['price'], 'name' => $data['name'], 'image' => $data['image']);
        array_push($json, $item_data);
    }

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
} else {
    header('Location: ' . '../auth/login.php', true, 303);
}






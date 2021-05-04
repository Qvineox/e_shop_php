<?php
session_start();
$functions = include "../functions.php";

$config = include "../config.php";
$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$item_id = $_POST['item_id'];
$count = (int)$_POST['count'];
$method = $_POST['method'];

if (!empty($method)) {
    if ($method == 'delete') {
        unset($_SESSION['items'][$item_id]);
    } elseif ($method == 'add') {
        if (array_key_exists($item_id, $_SESSION['items'])) {
            $_SESSION['items'][$item_id] = $_SESSION['items'][$item_id] + $count;
        } else {
            $_SESSION['items'][$item_id] = $count;
        }
    } elseif ($method == 'remove') {
        if (array_key_exists($item_id, $_SESSION['items'])) {
            $_SESSION['items'][$item_id] = $_SESSION['items'][$item_id] - $count;
        }
        if ($_SESSION['items'][$item_id] <= 0) {
            unset($_SESSION['items'][$item_id]);
        }
    }
}

$total_count = 0;
$total_price = 0;

foreach ($_SESSION['items'] as $item_id => $count) {
    $total_count += $count;
    $query = "SELECT price FROM item WHERE id=$item_id";
    $price = pg_fetch_array(pg_query($query))['price'] * $count;
    $total_price += $price;
}

$data = array(
    'total_price' => $total_price,
    'total_count' => $total_count
);

echo json_encode($data);
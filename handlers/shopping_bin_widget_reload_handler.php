<?php
session_start();

if (isset($_SESSION['items'])) {
    $config = include('../config.php');

    $connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
    or die('Не удалось соединиться: ' . pg_last_error());

    $total_count = 0;
    $total_price = 0;

    $items_json = array();

    foreach ($_SESSION['items'] as $item_id => $count) {
        $total_count += $count;
        $query = "SELECT price FROM item WHERE id=$item_id";
        $price = pg_fetch_array(pg_query($query))['price'] * $count;
        $total_price += $price;
    }

    $last_symbol = substr($total_count, -1);

    if ($last_symbol == '1') {
        echo "{$total_count} товар на {$total_price}₽";
    } elseif ($last_symbol == '2' or $last_symbol == '3' or $last_symbol == '4') {
        echo "{$total_count} товара на {$total_price}₽";
    } else {
        echo "{$total_count} товаров на {$total_price}₽";
    }
} else {
    echo "Требуется вход в аккаунт!";
}
<?php
function refresh_basket()
{
    if (isset($_SESSION['items'])) {
        $config = include('config.php');

        $connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
        or die('Не удалось соединиться: ' . pg_last_error());

        $total_count = 0;
        $total_price = 0;

        foreach ($_SESSION['items'] as $item_id => $count) {
            $total_count += $count;
            $query = "SELECT price FROM item WHERE id=$item_id";
            $price = pg_fetch_array(pg_query($query))['price'] * $count;
            $total_price += $price;
        }

        echo "{$total_count} товаров на {$total_price}₽";
    } else {
        echo "Требуется вход в аккаунт!";
    }
}


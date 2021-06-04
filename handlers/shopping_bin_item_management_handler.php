<?php

session_start();

$config = include "../config.php";
$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$itemID = $_POST['id'];
$itemName = $_POST['name'];
$change = $_POST['change'];

if (array_key_exists($itemID, $_SESSION['items'])) {
    if ($change == 0) {
        unset($_SESSION['items'][$itemID]);
        if (isset($itemName)) {
            echo 'Убрано из корзины:+' . $itemName;
        }
    } else {
        $_SESSION['items'][$itemID] = $_SESSION['items'][$itemID] + $change;
        if (isset($itemName)) {
            echo 'Добавлен ' . $_POST['change'] . ' экземпляр:+' . $itemName;
        }
        if ($_SESSION['items'][$itemID] == 0) {
            unset($_SESSION['items'][$itemID]);
            echo 'Убран последний экземпляр: ' . $itemName;
        }
    }
} else {
    $_SESSION['items'][$itemID] = $change;
    if (isset($itemName)) {
        echo 'Добавлено в корзину:+' . $itemName;
    }
}

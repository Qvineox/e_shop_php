<?php
session_start();
$items = @$_SESSION['items'];
?>

<html>
<title>
    Звершение покупки
</title>
<style>
    div.progress {
        border-radius: 15px;
        margin: 5px;
        padding: 10px 10px;
    }

    div.success {
        background-image: linear-gradient(60deg, #abecd6 0%, #fbed96 100%);
    }

    div.failure {
        background-image: linear-gradient(-20deg, #ddd6f3 0%, #faaca8 100%, #faaca8 100%);
    }

    div.progress p {
        font-size: 2rem;
        margin: 2px 5px;
    }
</style>
<link rel="stylesheet" href="../styles.css">

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$first_name = @$_POST['first_name'];
$last_name = @$_POST['last_name'];
$phone = @$_POST['phone'];

$items_json = json_encode($items);

$check = True;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO commission(\"user\", first_name, last_name, phone, items, date) VALUES ('$user_id', '$first_name', '$last_name', '$phone', '$items_json', current_timestamp)";
} else {
    $query = "INSERT INTO commission(first_name, last_name, phone, items, date) VALUES ('$first_name', '$last_name', '$phone', '$items_json', current_timestamp)";
}
$result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../resources/sun_auth.svg); height: 300px; background-repeat: no-repeat">

        </td>
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="../index.php">
                    <li class="menu-article home">
                        Главная<img src="../resources/home.svg"></li>
                </a>

                <a href="../catalog/sections.php">
                    <li class="menu-article catalog">
                        Разделы<img src="../resources/flower.svg"></li>
                </a>

                <a href="../catalog/items.php">
                    <li class="menu-article all-items ">
                        Товары<img src="../resources/brush.svg"></li>
                </a>

                <a href="../contacts.php">
                    <li class="menu-article contacts">
                        Контакты<img src="../resources/contacts.svg"></li>
                </a>

                <a href="../auth/profile.php">
                    <li class="menu-article profile">

                        Профиль<img src="../resources/profile.svg"></li>
                </a>
                <?php if (@$_SESSION['is_admin'] == 't') { ?>
                    <a href="../admin">
                        <li class="menu-article admin">
                            Админ<img src="../admin/resources/gear.svg"></li>
                    </a>
                <?php } ?>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td colspan="2">
                        <?php
                        if ($check) {
                            echo "<div class=\"progress success\">
                                        <p>Ваш заказ принят!</p>
                                    </div>";
                        } else {
                            echo "<div class=\"progress failure\">
                                        <p>Ваш заказ не был принят! </p>
                                    </div>";
                        }
                        ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul style="margin: 5px 2px; list-style-type: none;">
                            <?php
                            if (!$check) {
                                echo "<li>
                                <a class=\"link recall\" href=\"../catalog/basket.php\">
                                    Вернуться к корзине
                                </a>
                            </li>";
                            }
                            ?>
                            <li>
                                <a class="link recall" href="../auth/profile.php">
                                    Войти в профиль
                                </a>
                            </li>
                            <li>
                                <a class="link recall" href="../index.php">
                                    Вернуться на главную
                                </a>
                            </li>
                        </ul>

                    </td>
                </tr>
            </table>
        </td>
        <td class="right-zone">

        </td>
    </tr>
    <tr class="spacer" style="height: 12px"></tr>
</table>
</body>
</html>

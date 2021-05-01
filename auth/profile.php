<?php
session_start();
$functions = include("../functions.php");
$config = include("../config.php");

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$login = @$_POST['login'];
$password = @$_POST['password'];
$mode = @$_GET['mode'];

//начало проверок
if (isset($_SESSION['user_id'])) {
    //если пользователь уже вошел => получаем его данные
    $query = "SELECT * FROM client WHERE id = {$_SESSION['user_id']}";
    $result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());

    $client = pg_fetch_array($result);
} elseif (!empty($login) and !empty($password)) {
    //если пользователь собиается войти => проверяем и получаем его данные
    $loginOK = False;
    $query = "SELECT * FROM client WHERE login='$login';";
    $result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());
    if (pg_num_rows($result) != 0) {
        $client = pg_fetch_array($result);

        if (password_verify($password, $client['password'])) {
            $loginOK = True;

            $_SESSION['user_id'] = $client['id'];
            $_SESSION['is_admin'] = $client['is_admin'];
            $_SESSION['items'] = [];
        } else {
            $message = 'Указан неправильный пароль!';
        }
    } else {
        $message = 'Учетной записи не существует!';
    }
} else {
    //если пользователь не вошел в аккаунт и не собиратся => переадресуем на вход
    header('Location: ' . 'login.php', true, 303);
}
?>

<html>
<title>
    <?php echo "Пользователь #{$client['id']}" ?>
</title>
<style>
    p.client-name {
        font-size: 2.5rem;
        color: #434343;
        margin: 5px 10px;
    }

    p.client-data {
        font-size: 2rem;
        color: #434343;
        margin: 2px 5px;
    }

    a.button-logout {
        float: right;
        background-image: linear-gradient(-20deg, #ddd6f3 0%, #faaca8 100%, #faaca8 100%);
        border-radius: 50%;
    }

    a.button-logout:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .5);
        background-image: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
    }

    img.button-logout {
        height: 50px;
        margin: 10px 10px;
    }
</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="auth_styles.css">

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../resources/sun_auth.svg); height: 300px; background-repeat: no-repeat">
            <a class="link" href="basket.php">
                <div class="bin">
                    <table class="bin">
                        <tr>
                            <td rowspan="2" style="width: 60px">
                                <img src="../resources/basket.svg" style="height: 60px; width: 60px;">
                            </td>
                            <td style="padding: 0">
                                <p class="bin" style="font-size: 1.5rem; text-decoration: underline">Ваша Корзина</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0">
                                <p id="basket-value" class="bin"
                                   style="font-size: 1rem;"><?php refresh_basket() ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </a>
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

                <a href="profile.php">
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
                <?php if (isset($loginOK)) { ?>
                    <tr>
                        <td>
                            <?php
                            if ($loginOK) {
                                echo "<div class=\"progress success\">
                                        <p>Произведен вход в аккаунт!</p>
                                    </div>";
                            } else {
                                echo "<div class=\"progress failure\">
                                        <p>Войти в аккаунт не удалось! $message </p>
                                    </div>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (isset($client)) { ?>
                    <tr>
                        <td colspan="2">
                            <div>
                                <p style="display: inline-block" class="zone-header">Ваш профиль</p>
                                <a class="button-logout" href="login.php?exit=True">
                                    <img class="button-logout" src="../resources/logout.svg">
                                </a>
                            </div>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p class="client-name">
                                <?php echo "{$client['first_name']}  {$client['last_name']} {$client['middle_name']}" ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="margin-top: 20px">
                                <tr>
                                    <td style="width: 40%">
                                        <p class="client-data">
                                            Электронная почта
                                        </p>
                                    </td>
                                    <td>
                                        <p class="client-data">
                                            <?php echo "{$client['email']}" ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">
                                        <p class="client-data">
                                            Телефон
                                        </p>
                                    </td>
                                    <td>
                                        <p class="client-data">
                                            <?php echo "{$client['phone']}" ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="margin-top: 20px; float: right">
                                <tr>
                                    <td style="width: 20%">
                                        <p class="client-data">
                                            Персональная скидка
                                        </p>
                                    </td>
                                    <td style="width: 10%">
                                        <p class="client-data">
                                            <?php echo "{$client['discount']}%" ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>

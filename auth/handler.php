<html>
<title>
    Регистрация
</title>
<style>

</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="auth_styles.css">

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$first_name = @$_POST['first_name'];
$last_name = @$_POST['last_name'];
$middle_name = @$_POST['middle_name'];
$email = @$_POST['email'];
$phone = @$_POST['phone'];

$login = @$_POST['login'];
$password = @$_POST['password'];

//начало проверок
$registerOK = False;

$check_login = "SELECT * FROM client WHERE login='$login';";
$result = pg_query($check_login) or die ('Ошибка запроса: ' . pg_last_error());

if (pg_num_rows($result) == 0) {
    $check_email = "SELECT * FROM client WHERE email='$email';";
    $result = pg_query($check_email) or die ('Ошибка запроса: ' . pg_last_error());
    if (pg_num_rows($result) == 0) {
        $check_phone = "SELECT * FROM client WHERE phone='$phone';";
        $result = pg_query($check_phone) or die ('Ошибка запроса: ' . pg_last_error());
        if (pg_num_rows($result) == 0) {
            $registerOK = True;
        } else {
            $message = 'Учетная запись с таким телефоном уже существует!';
        }
    } else {
        $message = 'Учетная запись с такой почтой уже существует!';
    }
} else {
    $message = 'Учетная запись с таким логином уже существует!';
}

if ($registerOK) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (!empty($middle_name)) {
        $query = "INSERT INTO client(login, password, first_name, last_name, middle_name, phone, email) 
VALUES ('$login', '$password_hash', '$first_name', '$last_name', '$middle_name', '$phone', '$email');";
    } else {
        $query = "INSERT INTO client(login, password, first_name, last_name, phone, email) 
VALUES ('$login', '$password_hash', '$first_name', '$last_name', '$phone', '$email');";
    }
    $result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());
}
?>

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
                                <p class="bin" style="font-size: 1rem;">10 товаров на $70.00</p>
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
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td colspan="2">
                        <?php
                        if ($registerOK) {
                            echo "<div class=\"progress success\">
                                        <p>Учетная запись создана!</p>
                                    </div>";
                        } else {
                            echo "<div class=\"progress failure\">
                                        <p>Создать учетную запись не удалось! {$message} </p>
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
                            if (!$registerOK) {
                                echo "<li>
                                <a class=\"link recall\" href=\"registration.php\">
                                    Вернуться к регистрации
                                </a>
                            </li>";
                            }
                            ?>
                            <li>
                                <a class="link recall" href="login.php">
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
    <tr>
        <td class="footer curved" colspan="3">
            <table>
                <tr>
                    <td colspan="2" class="info">
                        <p class="info" style="opacity: 80%">
                            МИРЭА, 2021<br>
                            Лысак Ярослав Денисович, БСБО-09-18</p>
                    </td>
                </tr>
                <tr>
                    <td class="info left-footer">
                        <p class="info" style="text-align: justify; ">Проект: eShop<br>
                            Версия: 0.01<br>
                            Публикация: 26.02.2021
                        </p>
                    </td>
                    <td class="info right-footer">
                        <p class="info" style="text-align: justify; ">
                            Место для приколов
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

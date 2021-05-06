<html>
<title>
    Главная страница
</title>
<style>

</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="admin_styles.css"

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../resources/sun_admin.svg); height: 300px; background-repeat: no-repeat">

        </td>
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="news/">
                    <li class="menu-article home">
                        Новости<img src="resources/newspaper.svg"></li>
                </a>
                <a href="items">
                    <li class="menu-article catalog">
                        Товары<img src="../resources/flower.svg"></li>
                </a>
                <a href="users">
                    <li class="menu-article catalog" style="font-size: 29px">
                        Пользователи<img src="resources/user.svg"></li>
                </a>
                <a href="commisions">
                    <li class="menu-article catalog">
                        Заказы<img src="resources/money.svg"></li>
                </a>
                <a href="../index.php">
                    <li class="menu-article admin-options">
                        На главную<img src="resources/undo.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <p style="font-size: 2rem">Новости</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <p style="font-size: 3rem">
                                            <?php
                                            $query = 'SELECT COUNT(id) FROM article';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                                            $item = pg_fetch_array($result);
                                            echo $item[0];
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <p style="font-size: 2rem">Товары</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <p style="font-size: 3rem">
                                            <?php
                                            $query = 'SELECT COUNT(id) FROM item';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                                            $item = pg_fetch_array($result);
                                            echo $item[0];
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <p style="font-size: 2rem">Заказы</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <p style="font-size: 3rem">
                                            <?php
                                            $query = 'SELECT COUNT(id) FROM commission';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                                            $item = pg_fetch_array($result);
                                            if (isset($item)) {
                                                echo $item[0];
                                            }
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <p style="font-size: 2rem">Пользователи</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <p style="font-size: 3rem">
                                            <?php
                                            $query = 'SELECT COUNT(id) FROM client';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                                            $item = pg_fetch_array($result);
                                            if (isset($item)) {
                                                echo $item[0];
                                            }
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <p style="font-size: 2rem">Админы</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center">
                                        <p style="font-size: 3rem">
                                            <?php
                                            $query = 'SELECT COUNT(id) FROM client WHERE is_admin = TRUE';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                                            $item = pg_fetch_array($result);
                                            if (isset($item)) {
                                                echo $item[0];
                                            }
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>
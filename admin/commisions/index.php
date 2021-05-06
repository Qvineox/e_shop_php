<html>
<title>
    Админ - Заказы
</title>
<style>
    .commission-link {
        cursor: pointer;
    }

    .client-name {
        font-size: 2rem;
        width: fit-content;

        white-space: nowrap;
    }
</style>
<link rel="stylesheet" href="../../styles.css">
<link rel="stylesheet" href="../admin_styles.css">

<?php
$config = include('../../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../../resources/sun_admin.svg); height: 300px; background-repeat: no-repeat">

        </td>
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="../news">
                    <li class="menu-article home">
                        Новости<img src="../resources/newspaper.svg"></li>
                </a>
                <a href="../items">
                    <li class="menu-article home">
                        Товары<img src="../../resources/flower.svg"></li>
                </a>
                <a href="../users">
                    <li class="menu-article catalog" style="font-size: 29px">
                        Пользователи<img src="../resources/user.svg"></li>
                </a>
                <a href="../index.php">
                    <li class="menu-article catalog">
                        Панель<img src="../resources/gear.svg"></li>
                </a>
                <a href="../../index.php">
                    <li class="menu-article admin-options">
                        На главную<img src="../resources/undo.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td colspan="2" style="border: none">
                        <p class="zone-header">Все заказы</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $query = 'SELECT id, "user", last_name, first_name, items, date FROM commission ORDER BY date ASC';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                            echo "<a class='commision-link' href='commissiom?id={$line['id']}'><div class=\"item\"><table><tr>
                                    <td class=\"item\">
                                        <p class=\"item-name\">Заказ №{$line['id']}</p>
                                    </td>";

                            $date = date('d.m.y H:m', strtotime($line['date']));
                            echo "<td class=\"item\">
                                        <p style='width: 220px' class=\"item-name\">$date</p></td>
                                    ";

                            $first_name = mb_substr($line['first_name'], 0, 1, "utf-8");
                            echo "<td class=\"item\">
                                        <p class=\"client-name\">{$line['last_name']} $first_name.</p>
                                        </td></tr></table></div></a>";
                        }
                        ?>
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
<html>
<title>
    Админ - Товары
</title>
<style>

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
                <a href="../index.php">
                    <li class="menu-article home">
                        Панель<img src="../resources/gear.svg"></li>
                </a>
                <a href="catalog/sections.php">
                    <li class="menu-article catalog" style="font-size: 29px">
                        Пользователи<img src="../resources/user.svg"></li>
                </a>
                <a href="catalog/sections.php">
                    <li class="menu-article catalog">
                        Заказы<img src="../resources/money.svg"></li>
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
                    <td>
                        <div class="counter admin-options">
                            <table>
                                <tr>
                                    <td>
                                        <a href="editor.php?mode=add" style="font-size: 2rem; margin: 2px 5px">Добавить
                                            новый товар</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border: none">
                        <p class="zone-header">Все товары</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $query = 'SELECT id, name, price FROM item ORDER BY name ASC';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                            echo "<div class=\"item\"><table><tr>
                                    <td class=\"item\">
                                        <p class=\"item-name\">{$line['name']}</p>
                                    </td>
                                    <td class=\"item\">
                                        <p class=\"item-name\">{$line['price']}</p>
                                    </td>
                                    <td class=\"item\">
                                    <a href='editor.php?mode=edit&id={$line['id']}'>
                                        <img class=\"item-edit\" src=\"../resources/edit.svg\">
                                    </a>
                                    </td>
                                    <td class=\"item\">
                                    <a href='handler.php?mode=delete&id={$line['id']}'>
                                        <img class=\"item-delete\" src=\"../resources/delete.svg\">
                                    </a>
                                    </td>
                                </tr></table></div>";
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
<html>
<title>
    Главная страница
</title>
<style>
    .zone-header {
        text-align: start;
        color: #434343;
        font-weight: lighter;
        font-size: 4rem;
        margin: 0;
    }

    p.filter {
        text-align: start;
        color: #434343;
        font-weight: lighter;
        font-size: 2rem;
        margin: 2px 5px;
    }

    p.filter-label {
        padding: 0;
        text-align: start;
        color: #434343;
        font-weight: lighter;
        font-size: 1.2rem;
    }

    tr.item-row {
        padding: 2px 5px;
        border-spacing: 0;
        border-radius: 15px;
    }

    tr.item-row:hover {
        background-image: linear-gradient(45deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
    }

    table.item-table {
        border-spacing: 0;
    }

    table.item-table td {
        border-bottom: 2px solid silver;
        border-spacing: 0;
    }

    table.item-table td:not(:last-child) {
        border-right: 1px solid silver;
    }
</style>
<link rel="stylesheet" href="styles.css">

<?php
$config = include('config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

//запрашиваем фильтры
$manufacturers = @$_REQUEST['manufacturers'];
$categories = @$_REQUEST['categories'];
$price_more = @$_REQUEST['price_more'];
$price_less = @$_REQUEST['price_less'];
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 10rem;"></td>
        <td style="background-image: url(resources/sun_katalog.svg); height: 300px; background-repeat: no-repeat; margin-bottom: -5px">
            <a class="link" href="basket.php">
                <div class="bin">
                    <table class="bin">
                        <tr>
                            <td rowspan="2" style="width: 60px">
                                <img src="resources/basket.svg" style="height: 60px; width: 60px;">
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
        <td style="width: 10rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a class="link" href="index.php">
                    <li class="menu-article home">
                        Главная<img src="resources/home.svg"></li>
                </a>

                <a class="link" href="catalog.php">
                    <li class="menu-article catalog">
                        Каталог<img src="resources/flower.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article gallery">
                        Галерея<img src="resources/gallery.svg"></li>
                </a>

                <a class="link" href="contacts.php">
                    <li class="menu-article contacts">
                        Контакты<img src="resources/contacts.svg"></li>
                </a>

                <a class="link" href="account.php">
                    <li class="menu-article profile">

                        Профиль<img src="resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top; padding: 0">
            <table style="padding: 2px 10px">
                <tr>
                    <td id="catalog" style="width: 75%; vertical-align: top; padding: 2px 5px">
                        <table class="item-table">
                            <tr>
                                <td colspan="5" style="border: none">
                                    <p class="zone-header">Товары</p>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="filter-label" style="text-align: center">Фото</p></td>
                                <td><p class="filter-label" style="text-align: center">ID</p></td>
                                <td><p class="filter-label" style="text-align: center">Наименование</p></td>
                                <td><p class="filter-label" style="text-align: center">Производитель</p></td>
                                <td><p class="filter-label" style="text-align: center">Цена</p></td>
                            </tr>
                            <div>
                                <?php
                                $query = 'SELECT item.id           as item_id,
                                                       item.name         as item_name,
                                                       item.price        as item_price,
                                                       item.image        as item_image,
                                                       manufacturer.name as manufacturer_name
                                                FROM item
                                                         LEFT JOIN manufacturer ON manufacturer.id = item.manufacturer';
                                $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                    echo "<tr class=\"item-row\">
                                <td style=\"width: 50px; height: 50px\"><img style=\"width: 50px; height: 50px\" src='images/{$line['item_image']}'></td>
                                <td><p class=\"item-name\" style='text-align: center'>{$line['item_id']}</p></td>
                                <td><p class=\"item-name\">{$line['item_name']}</p></td>
                                <td><p class=\"item-name\" style='text-align: center'>{$line['manufacturer_name']}</p></td>
                                <td><p class=\"item-price\">-{$line['item_price']}</p></td>
                            </tr>";
                                }
                                ?>
                            </div>
                        </table>
                    </td>
                    <td id="filters" style="width: 25%; vertical-align: top">
                        <form action="catalog.php" method="get">
                            <table>
                                <tr>
                                    <td colspan="4">
                                        <p class="zone-header">Фильтры</p>
                                        <hr class="solid">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p class="filter" style="font-size: 2rem">Бренды</p>
                                        <table>
                                            <?php
                                            $query = 'SELECT * FROM manufacturer';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                                echo "<tr><td style='width: 1rem'>";
                                                echo "<input type=\"checkbox\" name=\"manufacturers[]\" value={$line['id']}>";
                                                echo "</td><td><p class='filter-label'>{$line['name']}</p></td></tr>";
                                            }
                                            ?>
                                        </table>
                                        <hr class="solid">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <p class="filter" style="font-size: 2rem">Категории</p>
                                        <select name="categories" style="width: 90%; margin: 0 5px 10px 5px" multiple>
                                            <?php
                                            $query = 'SELECT * FROM category';
                                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                                echo "<option value={$line['id']}>{$line['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                        <hr class=" solid">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table>
                                            <tr>
                                                <td><p class="filter" style="font-size: 2rem">Диапазон цен</p></td>
                                            </tr>
                                            <tr>
                                                <td>От <input type="number" name="price_more" placeholder="0"></td>
                                            </tr>
                                            <tr>
                                                <td>До <input type="number" name="price_less" placeholder="10000"></td>
                                            </tr>
                                        </table>
                                        <hr class=" solid">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding: 5px 6px">
                                        <button class="submit-button" type="submit">
                                            Применить
                                        </button>
                                        <button class="submit-button" type="reset">
                                            Сбросить
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
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

<html>
<title>
    Главная страница
</title>
<style>
    .hint {
        padding: 0 1rem;
        pointer-events: none;
        background: #FF6673;
    }

    .news-article {
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        /*background-blend-mode: lighten;*/
        height: 5rem;
        width: 100%;
        border: 1px solid grey;
        text-align: start;
    }

    .news-header {
        margin: 5px 0 0 5px;
        font-size: 2rem;
        color: #434343;
    }

    .news-text {
        margin: 1px 5px;
        font-size: 1.2rem;
        color: #434343;
        width: 500px;
    }

    .news-date {
        margin: 1px 5px;
        font-size: 1rem;
        color: grey;
    }

    li.links {
        margin: 0;
        padding: 0 3rem 0 2rem;
        list-style: none;
        background-image: url(resources/arrow.svg);
        background-repeat: no-repeat;
        /*background-position: left top;*/
        background-position-x: 0;
        background-position-y: 1rem;
        background-size: 20px;
    }

    ol.links {
        margin: 0 2px;
        padding: 0 1rem 0 0.5rem;
        list-style: none;
        color: #552226;
        border-left: 2px solid silver;
    }

    div.item {
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        border-radius: 15px;
        padding: 2px 5px;
        border: 2px solid gray;
        margin-right: 0;
        width: 200px;
    }

    .item-image {
        border-radius: 15px;
        width: 200px;
        height: 200px;
    }

    p.item-name {
        font-size: 1rem;
        font-weight: bold;
        color: #434343;
        margin: 5px 5px 0 5px;
    }

    a.item-name {
        font-size: 1rem;
        font-weight: bolder;
        color: #434343;
        text-decoration: underline;
        box-decoration-break: clone;
        display: inline;

        cursor: pointer;
    }

    .item-manufacturer {
        font-size: 0.8rem;
        color: #434343;
        margin: 1px 5px;
    }

    .item-price {
        font-size: 2rem;
        color: #552226;
        margin: 1px 10px 0 auto;
        text-align: end;
        font-style: oblique;
    }
</style>
<link rel="stylesheet" href="styles.css">

<?php
$config = include('config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(resources/sun.svg); height: 300px; background-repeat: no-repeat">
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
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="index.php">
                    <li class="menu-article home">
                        Главная<img src="resources/home.svg"></li>
                </a>

                <a href="catalog/sections.php">
                    <li class="menu-article catalog">
                        Разделы<img src="resources/flower.svg"></li>
                </a>

                <a href="catalog/items.php">
                    <li class="menu-article all-items ">
                        Товары<img src="resources/brush.svg"></li>
                </a>

                <a href="contacts.php">
                    <li class="menu-article contacts">
                        Контакты<img src="resources/contacts.svg"></li>
                </a>

                <a href="account.php">
                    <li class="menu-article profile">

                        Профиль<img src="resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <div id="Hints">
                    <tr id="hints">
                        <td style="width: 0;"></td>
                        <td id="hint-delivery" class="hint curved">
                            <table style="border-spacing: 0">
                                <tr>
                                    <td colspan="3">
                                        <p class="info" style="text-align: start; padding-top: 0.6rem">Бесплатная
                                            доставка</p>
                                    </td>
                                </tr>
                                <tr rowspan="2">
                                    <td>
                                        <img src="resources/delivery.svg" width="50" style="margin-bottom: 0.5rem">
                                    </td>
                                    <td colspan="2">
                                        <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Вы можете посмотреть
                                            возможные
                                            способы и стоимость доставки в вашем городе.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 1rem;"></td>
                        <td id="hint-stock" class="hint curved">
                            <table style="border-spacing: 0">
                                <tr>
                                    <td colspan="3">
                                        <p class="info" style="text-align: start; padding-top: 0.6rem">Всегда в
                                            наличии</p>
                                    </td>
                                </tr>
                                <tr rowspan="2">
                                    <td>
                                        <img src="resources/warehouse.svg" width="50" style="margin-bottom: 0.5rem">
                                    </td>
                                    <td colspan="2">
                                        <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Вы всегда можете быть
                                            уверены
                                            в наличии товаров на складе.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 1rem;"></td>
                        <td id="hint-contacts" class="hint curved">
                            <table style="border-spacing: 0">
                                <tr>
                                    <td colspan="3">
                                        <p class="info" style="text-align: start; padding-top: 0.6rem">Всегда на
                                            связи</p>
                                    </td>
                                </tr>
                                <tr rowspan="2">
                                    <td>
                                        <img src="resources/contacts.svg" width="50" style="margin-bottom: 0.5rem">
                                    </td>
                                    <td colspan="2">
                                        <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Мы всегда доступны для
                                            связи и
                                            готовы ответить на любые ваши вопросы.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 1rem;"></td>
                        <td id="hint-prices" class="hint curved">
                            <table style="border-spacing: 0">
                                <tr>
                                    <td colspan="3">
                                        <p class="info" style="text-align: start; padding-top: 0.6rem">Самые лучшие
                                            цены</p>
                                    </td>
                                </tr>
                                <tr rowspan="2">
                                    <td>
                                        <img src="resources/wallet.svg" width="50" style="margin-bottom: 0.5rem">
                                    </td>
                                    <td colspan="2">
                                        <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Наши цены всегда
                                            демократичны
                                            и не будут в тяжесть Вашему кошельку.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 0;"></td>
                    </tr>
                </div>
                <div id="News">
                    <tr>
                        <td colspan="9">
                            <p class="zone-header">Новости</p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <table>
                                <tr style="vertical-align: top">
                                    <?php
                                    $query = 'SELECT * FROM article ORDER BY date DESC LIMIT 3';
                                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        echo "<td><table><tr><td align=\"center\" class=\"news-article curved\"
                                                style=\"width: auto; padding: 5px 5px\">
                                                <img src='images/news-images/" . $line['image'] . "'
//                                                 изображения 560 * 120
                                                     style=\"width: 560px;
                                                     height: auto;
                                                     border-radius: 15px;\">
                                                <p class=\"news-header\">{$line['header']}</p>
                                                <p class=\"news-date\">{$line['date']}</p>
                                                <p class=\"news-text\">{$line['text']}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>";
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </div>
                <div id="Popular">
                    <tr>
                        <td colspan="9">
                            <p class="zone-header">Популярные товары</p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <table>
                                <tr style="vertical-align: top">
                                    <?php
                                    $query = 'SELECT item.id           as item_id,
                                                       item.name         as item_name,
                                                       item.price        as item_price,
                                                       item.image        as item_image,
                                                       manufacturer.name as manufacturer_name
                                                FROM item
                                                         LEFT JOIN manufacturer ON manufacturer.id = item.manufacturer
                                                WHERE item.id in (20, 21, 22, 23, 24, 25, 16, 17);';
                                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        echo "<td class=\"item\">
                                        <a href='catalog/item.php?id={$line['item_id']}'><div class=\"item\">
                                            <table class=\item\">
                                                <tr>
                                                    <td>
                                                        <img class=\"item-image\" src='images/item-images/" . $line['item_image'] . "'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p class=\"item-name\">{$line['item_name']}</p>
                                                        <p class=\"item-manufacturer\">{$line['manufacturer_name']}</p>
                                                        <p class=\"item-price\">-{$line['item_price']}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div></a>
                                    </td>";
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </div>
                <div id="Transitions">
                    <tr>
                        <td colspan="9">
                            <p class="zone-header">Интересные ссылки</p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <ul style="padding-left: 1rem">
                                <li class="links">
                                    <p class="zone-header" style="font-size: 3rem">Разделы товаров</p>
                                    <?php
                                    $query = 'SELECT * FROM section';
                                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        echo "<ol class=\"links\">
                                             <a href='catalog/categories.php?section={$line['id']}' class=\"zone-header link\" style=\"font-size: 2rem\">{$line['name']}</a>
                                          </ol>";
                                    }
                                    ?>
                                </li>
                                <li class="links">
                                    <p class="zone-header " style="font-size: 3rem">Категории</p>
                                    <?php
                                    $query = 'SELECT * FROM category WHERE id IN (29, 9, 25, 26, 23, 27)';
                                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        echo "<ol class=\"links\">
                                             <a href='catalog/items.php?categories%5B%5D={$line['id']}' class=\"zone-header link\" style=\"font-size: 2rem\">{$line['name']}</a>
                                          </ol>";
                                    }
                                    ?>
                                </li>
                                <li class="links">
                                    <p class="zone-header" style="font-size: 3rem">Контакты</p>
                                    <ol class="links">
                                        <a href="contacts.php" class="zone-header link" style="font-size: 2rem">Как
                                            добраться</a>
                                    </ol>
                                    <ol class="links">
                                        <a href="contacts.php" class="zone-header link" style="font-size: 2rem">Связатся
                                            с нами</a>
                                    </ol>
                                </li>
                                <li class="links">
                                    <p class="zone-header" style="font-size: 3rem">Ваш профиль</p>
                                </li>
                                <li class="links">
                                    <p class="zone-header" style="font-size: 3rem">Ваша корзина</p>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </div>
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
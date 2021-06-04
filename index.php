<?php
session_start();
?>

<html>
<title>
    Главная страница
</title>
<style>
    .news-article {
        width: 30%;
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        padding: 0;
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
    }

    .news-date {
        margin: 1px 5px;
        font-size: 1rem;
        color: grey;
    }

    .news-image {
        border-radius: 15px;
        width: 100%;
        height: auto;
    }

    div.item {
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        border-radius: 15px;
        padding: 2px 5px;
        border: 2px solid gray;
        margin-right: 0;
        width: 200px;
        height: 22rem;
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
        float: bottom;
        font-style: oblique;
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
</style>
<link rel="stylesheet" href="styles.css">

<script src="/jquery.js"></script>
<script src="/functions.js"></script>


<script>
    $(document).ready(
        loadMyShoppingBin()
    )
</script>

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
            <a class="link" href="catalog/basket.php">
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
                                <p id="basket-value" class="bin"
                                   style="font-size: 1rem;"></p>
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

                <a href="auth/profile.php">
                    <li class="menu-article profile">

                        Профиль<img src="resources/profile.svg"></li>
                </a>
                <?php if (@$_SESSION['is_admin'] == 't') { ?>
                    <a href="admin">
                        <li class="menu-article admin">
                            Админ<img src="admin/resources/gear.svg"></li>
                    </a>
                <?php } ?>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td colspan="9">
                        <p class="zone-header">Новости магазина</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table class="news">
                            <?php
                            $query = 'SELECT * FROM article ORDER BY date DESC LIMIT 3';
                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                echo "<td><table><tr><td align=\"center\" class=\"news-article curved\"
                                                style=\"width: auto; padding: 5px 5px\">
                                                <img class='news-image' src='images/news-images/" . $line['image'] . "'>
                                                <p class=\"news-header\">{$line['header']}</p>
                                                <p class=\"news-date\">{$line['date']}</p>
                                                <p class=\"news-text\">{$line['text']}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>";
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="9">
                        <p class="zone-header">Популярные товары</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table class="news">
                            <?php
                            $query = 'SELECT item.id           as item_id,
                                                       item.name         as item_name,
                                                       item.price        as item_price,
                                                       item.image        as item_image,
                                                       manufacturer.name as manufacturer_name
                                                FROM item
                                                         LEFT JOIN manufacturer ON manufacturer.id = item.manufacturer
                                                WHERE item.id in (16, 21, 22, 23, 24, 26);';
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
                                                <tr style='height: 6rem'>
                                                    <td>
                                                        <p class=\"item-name\">{$line['item_name']}</p>
                                                        <p class=\"item-manufacturer\">{$line['manufacturer_name']}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style='text-align: center'>
                                                        <p class=\"item-price\">{$line['item_price']}₽</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div></a>
                                    </td>";
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="9">
                        <p class="zone-header">Навигация на сайте</p>
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
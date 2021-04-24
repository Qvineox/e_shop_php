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

    .description {
        text-align: start;
        font-weight: lighter;
        font-size: 1.6rem;
        color: #434343;

        width: 100%;
    }

    .item-feature {
        color: #434343;
        font-size: 1.2rem;
        font-weight: lighter;
        text-align: start;
    }

    a.item-feature {
        text-decoration: underline;
        color: #552226;

        cursor: pointer;
    }

</style>
<link rel="stylesheet" href="../styles.css">

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

//запрашиваем товар
$query = 'SELECT item.id as item_id,
            item.name         as item_name,
            item.price        as item_price,
            item.image        as item_image,
            item.description        as item_description,
            item.manufacturer       as item_manufacturer_id,
            item.category       as item_category_id,
            manufacturer.name as manufacturer_name,
            category.name as category_name
          FROM item
                LEFT JOIN manufacturer ON manufacturer.id = item.manufacturer
                LEFT JOIN category ON category.id = item.category
                WHERE item.id = ' . $_GET['id'];
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
$item = pg_fetch_array($result)
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 10rem;"></td>
        <td style="background-image: url(../resources/sun_katalog.svg); height: 300px; background-repeat: no-repeat; margin-bottom: -5px">
            <a class="link" href="../basket.php">
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
        <td style="width: 10rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a class="link" href="../index.php">
                    <li class="menu-article home">
                        Главная<img src="../resources/home.svg"></li>
                </a>

                <a class="link" href="items.php">
                    <li class="menu-article catalog">
                        Каталог<img src="../resources/flower.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article gallery">
                        Галерея<img src="../resources/gallery.svg"></li>
                </a>

                <a class="link" href="../contacts.php">
                    <li class="menu-article contacts">
                        Контакты<img src="../resources/contacts.svg"></li>
                </a>

                <a class="link" href="../account.php">
                    <li class="menu-article profile">

                        Профиль<img src="../resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top; padding: 0">
            <table style="padding: 2px 10px">
                <tr>
                    <td id="item" style="width: 75%; vertical-align: top; padding: 2px 5px">
                        <table class="item-table">
                            <tr>
                                <td colspan="2" style="border: none">
                                    <p class="zone-header">Товар</p>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border: none">
                                    <p class="zone-header"
                                       style="font-size: 2rem; padding: 5px 5px"><?php echo $item['item_name'] ?></p>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 500px">
                                    <img style="width: 500px" src="../images/<?php echo $item['item_image'] ?>">
                                </td>
                                <td style="padding: 0 5px; vertical-align: top;">
                                    <table>
                                        <tr>
                                            <td>
                                                <p class="zone-header" style="font-size: 2.8rem; color: #552226;">
                                                    Описание</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="description"><?php echo $item['item_description'] ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="zone-header" style="font-size: 2.8rem; color: #552226;">
                                                    Характеристики</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table style="width: 50%">
                                                    <tr>
                                                        <td>
                                                            <p class="item-feature">
                                                                Производитель
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a class="item-feature">
                                                                <?php echo $item['manufacturer_name'] ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="item-feature">
                                                                Категория
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a class="item-feature">
                                                                <?php echo $item['category_name'] ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="item-feature">
                                                                В комплекте
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="item-feature">
                                                                ???
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="item-feature">
                                                                Назначение
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="item-feature">
                                                                ???
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
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

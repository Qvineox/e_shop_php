<?php
session_start();
$functions = include "functions.php";
?>

<html>
<title>
    Контакты
</title>
<style>
    .hint {
        padding: 0 1rem;
        pointer-events: none;
        background: #FF6673;
    }

    table.contacts {
        padding: 0 10px 0 5px;
    }

    td.social {
        width: 50px;
        padding: 5px;
    }

    img.social {
        width: 50px;
        height: 50px;
    }

    a.social {
        padding-left: 5px;
    }

    img.map {
        margin: 10px 10px;
        border-radius: 15px;
    }

    p.map-steps {
        font-size: 1.4rem;
        font-weight: bold;
        color: #434343;
    }

    ol.map-steps li {
        font-weight: bold;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 1.5rem;
        color: #434343;
    }
</style>
<link rel="stylesheet" href="styles.css">


<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(resources/sun_contacts.svg); height: 300px; background-repeat: no-repeat">
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
                <div id="Contacts">
                    <tr>
                        <td colspan="9">
                            <p class="zone-header">Связь с нами</p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table class="contacts">
                                <tr>
                                    <td class="social">
                                        <img class="social" src="resources/vk-logo.svg">
                                    </td>
                                    <td>
                                        <a class="link social" style="font-size: 2rem" href="https://vk.com/">Мы
                                            ВКонтакте</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="social">
                                        <img class="social" src="resources/ig-logo.svg">
                                    </td>
                                    <td>
                                        <a class="link social" style="font-size: 2rem"
                                           href="https://www.instagram.com/">Мы
                                            в Instagram</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="social">
                                        <img class="social" src="resources/twitter-logo.svg">
                                    </td>
                                    <td>
                                        <a class="link social" style="font-size: 2rem" href="https://www.twitter.com/">Мы
                                            в Twitter</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="social">
                                        <img class="social" src="resources/gmail-logo.svg">
                                    </td>
                                    <td>
                                        <a class="link social" style="font-size: 2rem" href="https://www.gmail.com/">Наша
                                            почта</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </div>
                <div id="Placement">
                    <tr>
                        <td colspan="9">
                            <p class="zone-header">Как до нас добраться</p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <table>
                                <tr>
                                    <td style="width: 50%">
                                        <img class="map" src="images/shop-map.png">
                                    </td>
                                    <td style="vertical-align: top; padding: 10px 20px 0 2px">
                                        <div style="text-align: start">
                                            <ol class="map-steps">
                                                <li><p class="map-steps">Покиньте метро cт. Преображенская Площадь (в
                                                        сторону Центра)</p></li>
                                                <li><p class="map-steps">Продвигайтесь в сторону Центра 500 метров, пока
                                                        не дойдете до пешеходного перехода до Матросского Моста.</p>
                                                </li>
                                                <li><p class="map-steps">Перейдите через дорогу и продолжайте движение к
                                                        Центру по Матросскому Мосту.</p>
                                                </li>
                                                <li><p class="map-steps">После Моста поверните налево и пройдите в арку.
                                                        Вы на месте.</p>
                                                </li>
                                            </ol>
                                        </div>
                                    </td>
                                </tr>

                            </table>
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
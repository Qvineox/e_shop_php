<html>
<title>
    Главная страница
</title>
<style>
    .hint {
        padding: 0 1rem;
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
    <tr>
        <td class="header" colspan="3">header</td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="#">
                    <li class="menu-article home">
                        Главная<img src="resources/home.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article catalog">
                        Каталог<img src="resources/flower.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article gallery">
                        Галерея<img src="resources/gallery.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article contacts">
                        Контакты<img src="resources/contacts.svg"></li>
                </a>

                <a href="#">
                    <li class="menu-article profile">

                        Профиль<img src="resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td colspan="6">
                        <p class="info" style="font-style: normal; font-weight: bold; font-size: 4em;">
                            Добро пожаловать в SilverLink</p>
                    </td>
                </tr>
                <tr id="hints">
                    <td style="width: 5rem;"></td>
                    <td id="hint-delivery" class="hint curved" style="width: 20%">
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
                                    <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Вы можете посмотреть возможные
                                        способы и стоимость доставки в вашем городе.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td id="hint-stock" class="hint curved" style="width: 20%">
                        <table style="border-spacing: 0">
                            <tr>
                                <td colspan="3">
                                    <p class="info" style="text-align: start; padding-top: 0.6rem">Всегда в наличии</p>
                                </td>
                            </tr>
                            <tr rowspan="2">
                                <td>
                                    <img src="resources/warehouse.svg" width="50" style="margin-bottom: 0.5rem">
                                </td>
                                <td colspan="2">
                                    <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Вы всегда можете быть уверены
                                        в наличии товаров на складе.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td id="hint-contacts" class="hint curved" style="width: 20%">
                        <table style="border-spacing: 0">
                            <tr>
                                <td colspan="3">
                                    <p class="info" style="text-align: start; padding-top: 0.6rem">Всегда на связи</p>
                                </td>
                            </tr>
                            <tr rowspan="2">
                                <td>
                                    <img src="resources/contacts.svg" width="50" style="margin-bottom: 0.5rem">
                                </td>
                                <td colspan="2">
                                    <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Мы всегда доступны для связи и
                                        готовы ответить на любые ваши вопросы.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td id="hint-prices" class="hint curved" style="width: 20%">
                        <table style="border-spacing: 0">
                            <tr>
                                <td colspan="3">
                                    <p class="info" style="text-align: start; padding-top: 0.6rem">Самые лучшие цены</p>
                                </td>
                            </tr>
                            <tr rowspan="2">
                                <td>
                                    <img src="resources/wallet.svg" width="50" style="margin-bottom: 0.5rem">
                                </td>
                                <td colspan="2">
                                    <p style="margin-left: 0.6rem; margin-bottom: 0.5rem">Наши цены всегда демократичны
                                        и не будут в тяжесть Вашему кошельку.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 5rem;"></td>
                </tr>
            </table>
        </td>
        <td class="right-zone">
            <ul class="menu">
                <a href="#">
                    <li class="bin-article checkout">
                        <img src="resources/basket.svg"><span class="bin-summary">Корзина<br>300 руб</span></li>
                </a>
            </ul>
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
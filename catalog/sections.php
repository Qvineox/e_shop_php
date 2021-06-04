<?php
session_start();
?>

<html>
<title>
    Разделы
</title>
<style>
    table.basket {
        border-spacing: 0;
        padding: 0;
    }

    div.section-card {
        margin: 20px auto;
        height: 650px;
        width: 200px;
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        padding: 10px;
        border-radius: 20px;

        position: relative;
        cursor: pointer;

        z-index: 0;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease;
        border-radius: 15px;
        background-image: linear-gradient(to top, #FF6673 0%, #ec8c69 100%);


        writing-mode: vertical-lr;
        text-orientation: upright;
    }

    div.section-card:hover {
        background-image: linear-gradient(to top, #FF6673 0%, #ec8c69 100%);
    }

    .section-card:hover .overlay {
        background-blend-mode: color;
        opacity: 0.9;
    }

    img.section-image {
        border-radius: 20px;
        vertical-align: middle;
        display: block;
        width: 100%;
        height: auto;
    }

    p.section-overlay {
        color: black;
        font-size: 50px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: 0;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
        cursor: pointer;
    }

    div.manufacturer-card {
        margin: 5px 2px;
        width: 200px;
        height: 200px;
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        border-radius: 15px;

        cursor: pointer;

        display: inline-block;
    }

    div.manufacturer-card:hover {
        background-image: linear-gradient(to top, #FF6673 0%, #ec8c69 100%);
    }

    img.manufacturer-image {
        width: 190px;
        height: 190px;
        border-radius: 15px;
        margin: 5px 5px;
    }
</style>

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());
?>

<link rel="stylesheet" href="../styles.css">

<script src="/jquery.js"></script>
<script src="/functions.js"></script>


<script>
    $(document).ready(
        loadMyShoppingBin()
    )
</script>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 10rem;"></td>
        <td style="background-image: url(../resources/sun_katalog.svg); height: 300px; background-repeat: no-repeat; margin-bottom: -5px">
            <a class="link" href="../catalog/basket.php">
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
                                <p id="basket-value" class="bin"
                                   style="font-size: 1rem;"></p>
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
                <a href="../index.php">
                    <li class="menu-article home">
                        Главная<img src="../resources/home.svg"></li>
                </a>

                <a href="sections.php">
                    <li class="menu-article catalog">
                        Разделы<img src="../resources/flower.svg"></li>
                </a>

                <a href="items.php">
                    <li class="menu-article all-items ">
                        Товары<img src="../resources/brush.svg"></li>
                </a>

                <a href="../contacts.php">
                    <li class="menu-article contacts">
                        Контакты<img src="../resources/contacts.svg"></li>
                </a>

                <a href="../auth/profile.php">
                    <li class="menu-article profile">

                        Профиль<img src="../resources/profile.svg"></li>
                </a>
                <?php if (@$_SESSION['is_admin'] == 't') { ?>
                    <a href="../admin">
                        <li class="menu-article admin">
                            Админ<img src="../admin/resources/gear.svg"></li>
                    </a>
                <?php } ?>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top; padding: 0">
            <table style="padding: 2px 10px">
                <tr>
                    <td id="catalog" style="width: 75%; vertical-align: top; padding: 2px 5px">
                        <table class="item-table">
                            <tr>
                                <td colspan="6" style="border: none">
                                    <p class="zone-header">Разделы</p>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <tr>
                                <?php
                                $query = 'SELECT * FROM section ORDER BY id ASC';
                                $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                    echo "<td style='align-items: center; align-content: center;'>
                                    <a href='categories.php?section={$line['id']}'><div class=\"section-card\">
                                        <img class=\"section-image\" src=\"../images/section-images/{$line['image']}\">
                                        <div class=\"overlay\">
                                            <p class=\"section-overlay\">{$line['name']}</p>
                                        </div>
                                    </div></a>
                                </td>";
                                }
                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td id="catalog" style="width: 75%; vertical-align: top; padding: 2px 5px">
                        <table class="item-table">
                            <tr>
                                <td colspan="6" style="border: none">
                                    <p class="zone-header">Производители</p>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px">
                                    <?php
                                    $query = 'SELECT id, name, image FROM manufacturer ORDER BY id ASC';
                                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                        echo "<a href='items.php?manufacturers%5B%5D={$line['id']}'>
                                        <div class=\"manufacturer-card\">
                                            <img class=\"manufacturer-image\"
                                                 src=\"../images/manufacturer-images/{$line['image']}\">
                                        </div>
                                    </a>";
                                    }
                                    ?>
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

<html>
<title>
    Категории
</title>
<style>
    .zone-header {
        text-align: start;
        color: #434343;
        font-weight: lighter;
        font-size: 4rem;
        margin: 0;
    }

    table.item-table {
        border-spacing: 0;
    }

    div.category-card {
        margin: 5px auto;
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        padding: 10px;
        border-radius: 20px;

        position: relative;
        cursor: pointer;

        height: 200px;
        width: 700px;

        z-index: 0;

        text-align: center;
    }

    div.all-items-category-card {
        margin: 5px 10px;
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        padding: 10px;
        border-radius: 20px;

        position: relative;
        cursor: pointer;

        z-index: 0;

        text-align: center;
    }

    div.all-items-category-card:hover {
        background-image: linear-gradient(to top, #FF6673 0%, #ec8c69 100%);
    }

    div.all-items-category-card p {
        font-size: 2rem;
        margin: 5px 10px;
        color: black;
        cursor: pointer;
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
    }

    div.category-card:hover {
        background-image: linear-gradient(to top, #FF6673 0%, #ec8c69 100%);
    }

    .category-card:hover .overlay {
        background-blend-mode: color;
        opacity: 0.9;
    }

    img.category-image {
        border-radius: 20px;
        vertical-align: middle;
        display: block;
        width: 100%;
        height: auto;
    }

    p.category-overlay {
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
</style>
<link rel="stylesheet" href="../styles.css">

<?php
$config = include('../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

//запрашиваем фильтры
$section = @$_GET['section'];
if (isset($section)) {
    $query = "SELECT category.id as category_id,
                category.name    as category_name,
                category.image   as category_image
          FROM category
          WHERE category.section = $section";

    $section_name = pg_fetch_result(pg_query("SELECT name FROM section WHERE id = $section LIMIT 1"), 0);
} else {
    $query = 'SELECT category.id as category_id,
                category.name    as category_name,
                category.image   as category_image,
                category.section as category_section_id,
                section.name as section_name
          FROM item
                LEFT JOIN section ON section.id = category.section';
}
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

                <a href="../account.php">
                    <li class="menu-article profile">

                        Профиль<img src="../resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top; padding: 0">
            <table style="padding: 2px 10px">
                <tr>
                    <td id="catalog" style="width: 75%; vertical-align: top; padding: 2px 5px">
                        <table class="item-table">
                            <tr>
                                <td colspan="6" style="border: none">
                                    <?php
                                    if (isset($section)) {
                                        echo "<p class=\"zone-header\">{$section_name}</p>";
                                    }
                                    ?>
                                    <hr class="solid">
                                </td>
                            </tr>
                            <?php
                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                            $counter = 0;

                            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                if ($counter == 0) {
                                    echo "<tr>";

                                } elseif ($counter == 2) {
                                    echo "<tr>";
                                    $counter = 0;
                                }
//                                $array = array([$line['category_id']]);
//                                $category_items_url = "items.php?" . http_build_query(array(
//                                        "categories" => $array
//                                    ));
                                echo "<td colspan=\"3\">
                                <a href='items.php?categories%5B%5D={$line['category_id']}'>
                                <div class=\"category-card\">
                                    <img class=\"category-image\" src=\"../images/category-images/{$line['category_image']}\">
                                    <div class=\"overlay\">
                                        <p class=\"category-overlay\">{$line['category_name']}</p>
                                    </div>
                                </div>
                                </a>
                                </td>";
                                if ($counter == 1) {
                                    echo "</tr>";
                                }
                                $counter++;
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <a href="items.php?section=<?php echo $section ?>">
                                        <div class="all-items-category-card">
                                            <p>Все товары раздела</p>
                                        </div>
                                    </a>

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

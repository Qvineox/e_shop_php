<?php
session_start();
$config = include("../config.php");

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

if (isset($_SESSION['user_id'])) {
    $items = @$_SESSION['items'];
} else {
    header('Location: ' . '../auth/login.php', true, 303);
}


?>

<html>
<title>
    Корзина
</title>
<style>
    p.empty {
        font-size: 2.5rem;
        color: #434343;
        margin-left: 10px;
    }

    tr.item-row {
        padding: 2px 5px;
        border-spacing: 0;
        border-radius: 15px;
        background-image: none;

        transition: background-color 0.4s;
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

    div.item-name {
        width: 90%;
        display: inline-block;
        padding: 2px 5px;
        text-align: left;

        font-size: 1.4rem;
    }

    p.item-price {
        font-size: 1.2rem;
        text-align: center;
    }

    img.basket-operation {
        display: inline-block;
        width: 40px;

        cursor: pointer;
        transition: background-color 0.4s;

        border-radius: 50%;
    }

    img.basket-operation:hover {
        background-color: #FF6673;
    }

    p.basket-result {
        font-size: 2.4rem;
        color: #434343;
        margin-bottom: 2px;
    }

    label, input {
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        color: #434343;
    }

    .form-label {
        width: 20%;
        font-size: 1.5rem;
    }

    input {
        width: 80%;
        font-size: 1.5rem;
    }

    table.checkout {
        width: 60%;
    }

    table.checkout td {
        border: none;
    }

    button.button-submit, button.button-reset {
        height: 50px;
        margin-top: 20px;

        border-radius: 15px;
        border: 1px solid #434343;

        display: inline-block;
        text-align: center;

        cursor: pointer;
    }

    p.button-text {
        margin: 5px 10px;
        font-size: 2rem;

        cursor: pointer;
    }

    button.button-submit {
        background-image: linear-gradient(60deg, #abecd6 0%, #fbed96 100%);
    }

    button.button-reset {
        background-image: linear-gradient(-20deg, #ddd6f3 0%, #faaca8 100%, #faaca8 100%);
    }

    button.button-submit:hover, button.button-reset:hover, a.button-register:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .5);
    }
</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="auth_styles.css">

<script type="text/javascript" src="../jquery-3.6.0.js"></script>

<script type="text/javascript">
    $(document).ready((function () {
        $("img.basket-operation").click(function () {
            let id = $(this).attr('id')
            let substrings = id.split('_')

            // let name = $(this).parents(':eq(2)').find('a').text()

            // alert("Вы добавили в корзину: \n" + substrings)

            $.ajax({
                type: "POST",
                url: "basket_handler.php",
                data: {
                    method: substrings[0],
                    item_id: substrings[1],
                    count: 1
                },
                success: function () {
                    document.location.reload();
                }
            })

            return false
        })
    }));
</script>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../resources/sun_basket.svg); height: 300px; background-repeat: no-repeat">
        </td>
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="../index.php">
                    <li class="menu-article home">
                        Главная<img src="../resources/home.svg"></li>
                </a>

                <a href="../catalog/sections.php">
                    <li class="menu-article catalog">
                        Разделы<img src="../resources/flower.svg"></li>
                </a>

                <a href="../catalog/items.php">
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
        <td class="content center-zone curved" style="vertical-align: top">
            <table class="item-table">
                <tr>
                    <td colspan="6" style="border: none">
                        <p class="zone-header">Ваши товары</p>
                        <hr class="solid">
                    </td>
                </tr>

                <div>
                    <?php
                    if (!empty($items)) {
                        echo "<tr>
                    <td><p class=\"filter-label\" style=\"text-align: center\">Фото</p></td>
                    <td><p class=\"filter-label\" style=\"text-align: center\">ID</p></td>
                    <td><p class=\"filter-label\" style=\"text-align: center\">Наименование</p></td>
                    <td><p class=\"filter-label\" style=\"text-align: center\">Кол-во</p></td>
                    <td><p class=\"filter-label\" style=\"text-align: center\">Цена</p></td>
                    <td><p class=\"filter-label\" style=\"text-align: center\">Операции</p></td>
                </tr>";

                        foreach ($items as $id => $count) {
                            $ids[] = $id;
                        }
                        $ids = implode(', ', $ids);

                        $query = "SELECT id, name, price, image FROM item WHERE id IN ($ids);";
                        $result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());

                        $total_price = 0;
                        $total_amount = 0;

                        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                            $price = $line['price'] * $items[$line['id']];

                            $total_amount += $items[$line['id']];
                            $total_price += $price;

                            echo "<tr class=\"item-row\">
                                <td style=\"width: 50px; height: 50px\">
                                    <img style=\"width: 50px; height: 50px\" src='../images/item-images/{$line['image']}'>
                                </td>
                                <td>
                                    <p class=\"item-name\" style='text-align: center'>{$line['id']}</p>
                                </td>
                                <td style='padding: 2px 5px'>
                                    <div class='item-name''>
                                        <a class='link' href='item.php?id={$line['id']}' class=\"item-name\">{$line['name']}</a>
                                    </div>
                                </td>
                                <td><p class=\"item-price\">{$items[$line['id']]}</p></td>
                                <td><p class=\"item-price\">{$price}₽</p></td>
                                <td style='width: 130px; padding: 5px'>
                                <a>
                                    <img id='add_{$line['id']}' class='basket-operation' src='../resources/add.svg'>
                                </a>
                                <a>
                                    <img id='remove_{$line['id']}' class='basket-operation' src='../resources/minus.svg'>
                                </a>
                                <a>
                                    <img id='delete_{$line['id']}' class='basket-operation' src='../resources/remove.svg'>
                                </a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'><p class='empty'>Ничего не найдено!</p></td></tr>";
                    }
                    ?>
                    <?php if (!empty($items)) { ?>
                        <tr>
                            <td colspan="6" style="border: none">
                                <p class="zone-header">Оформление заказа</p>
                                <hr class="solid">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 2px 10px">

                                <p class="basket-result">
                                    В Вашей корзине <?php echo "$total_amount" ?> товаров
                                    на <?php echo number_format($total_price, 0, '.', '.') ?>₽.
                                </p>
                                <form action="checkout.php" method="post" enctype="multipart/form-data">
                                    <?php
                                    $query = "SELECT * FROM client WHERE id = {$_SESSION['user_id']}";
                                    $result = pg_query($query) or die ('Ошибка запроса: ' . pg_last_error());

                                    $client = pg_fetch_array($result);
                                    ?>
                                    <table class="checkout">
                                        <tr>
                                            <td class="form-label">
                                                <label for="first_name">
                                                    Имя*
                                                </label>
                                            </td>
                                            <td>
                                                <input id="first_name" name="first_name" type="text"
                                                       maxlength="50" placeholder="Иван"
                                                    <?php
                                                    if (isset($client['first_name'])) {
                                                        echo " value={$client['first_name']} ";
                                                    }
                                                    ?>
                                                       required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="form-label">
                                                <label for="last_name">
                                                    Фамилия*
                                                </label>
                                            </td>
                                            <td>
                                                <input id="last_name" name="last_name" type="text"
                                                       maxlength="50" placeholder="Иванов"
                                                    <?php
                                                    if (isset($client['last_name'])) {
                                                        echo " value={$client['last_name']} ";
                                                    }
                                                    ?>
                                                       required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="form-label">
                                                <label for="phone">
                                                    Телефон*
                                                </label>
                                            </td>
                                            <td>
                                                <input id="phone" name="phone" type="tel"
                                                       maxlength="20" placeholder="+7(916)123-45-67"
                                                    <?php
                                                    if (isset($client['phone'])) {
                                                        echo " value={$client['phone']} ";
                                                    }
                                                    ?>
                                                       required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="button-submit" type="submit"><p class="button-text">
                                                        Заказать</p>
                                                </button>
                                                <button class="button-reset" type="reset"><p class="button-text">
                                                        Сбросить</p>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </div>
            </table>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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

    table.basket {
        border-spacing: 0;
    }

    table.basket td {
        border-bottom: 2px solid silver;
        border-spacing: 0;
    }

    table.basket td:not(:last-child) {
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

<script src="/jquery.js"></script>
<script src="/functions.js"></script>

<script type="text/javascript">
    $(document).ready(
        function () {
            rebuildShoppingBin()

            $(document).on('click','img.add-item',function(){
                let itemID = $(this).attr('id')
                console.log(itemID)
                addItemToShoppingBin(itemID)
            });

            $(document).on('click','img.remove-item',function(){
                let itemID = $(this).attr('id')
                console.log(itemID)
                removeItemFromShoppingBin(itemID)
            });

            $(document).on('click','img.delete-item',function(){
                let itemID = $(this).attr('id')
                console.log(itemID)
                deleteItemFromShoppingBin(itemID)
            });
        }
    )
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
            <table>
                <tr>
                    <td colspan="6" style="border: none">
                        <p class="zone-header">Ваши товары</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="basket" id="basket">

                        </table>
                    </td>
                </tr>
            </table>
            <table id="checkout">
                <tr>
                    <td colspan="6" style="border: none">
                        <p class="zone-header">Оформление заказа</p>
                        <hr class="solid">
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding: 2px 10px">
                        <p class="basket-result">
                            В Вашей корзине ### товаров на ### ₽.
                        </p>
                        <form action="checkout.php" method="post" enctype="multipart/form-data">
                            <table class="checkout">
                                <tr>
                                    <td class="form-label">
                                        <label for="first_name">
                                            Имя*
                                        </label>
                                    </td>
                                    <td>
                                        <input id="first_name" name="first_name" type="text"
                                               maxlength="50" placeholder="Иван" required>
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
                                               maxlength="50" placeholder="Иванов" required>
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
                                               maxlength="20" placeholder="+7(916)123-45-67" required>
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
            </table>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>

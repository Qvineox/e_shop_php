<?php
session_start();
if (!empty(@$_GET['exit'])) {
    @session_destroy();
}
?>

<html>
<title>
    Войти в профиль
</title>
<style>

</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="auth_styles.css">

<body>
<table cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../resources/sun_auth.svg); height: 300px; background-repeat: no-repeat">

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

                <a href="profile.php">
                    <li class="menu-article profile">

                        Профиль<img src="../resources/profile.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <div class="auth-form">
                <p class="form-label">Войти в профиль</p>
                <form action="profile.php" method="post" enctype="multipart/form-data" class="auth-form">
                    <table>
                        <tr>
                            <td class="form-label">
                                <label for="login">
                                    Логин
                                </label>
                            </td>
                            <td>
                                <input id="login" name="login" type="text"
                                       maxlength="20" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="password">
                                    Пароль
                                </label>
                            </td>
                            <td>
                                <input id="password" name="password" type="password"
                                       maxlength="20" required>
                            </td>
                        </tr>

                        <tr style="height: 2rem"></tr>
                        <tr>
                            <td colspan="2">
                                <a class="button-register" href="registration.php"><p class="button-text">
                                        Регистрация</p>
                                </a>
                                <button class="button-submit" type="submit"><p class="button-text">Войти</p>
                                </button>
                                <button class="button-reset" type="reset"><p class="button-text">Сбросить</p>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>
<html>
<title>
    Регистрация
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
                <?php if (@$_SESSION['is_admin'] == 't') { ?>
                    <a href="../admin">
                        <li class="menu-article admin">
                            Админ<img src="../admin/resources/gear.svg"></li>
                    </a>
                <?php } ?>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <div class="auth-form">
                <p class="form-label">Регистрация нового пользователя</p>
                <form action="handler.php" method="post" enctype="multipart/form-data" class="auth-form">
                    <table>
                        <tr>
                            <td class="form-label">
                                <label for="first_name">
                                    Ваше имя*
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
                                    Ваша фамилия*
                                </label>
                            </td>
                            <td>
                                <input id="last_name" name="last_name" type="text"
                                       maxlength="50" placeholder="Иванов" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="middle_name">
                                    Ваше отчество
                                </label>
                            </td>
                            <td>
                                <input id="middle_name" name="middle_name" type="text"
                                       maxlength="50" placeholder="Иванович">
                            </td>
                        </tr>
                        <tr style="height: 2rem"></tr>
                        <tr>
                            <td class="form-label">
                                <label for="email">
                                    Эл. Почта*
                                </label>
                            </td>
                            <td>
                                <input id="email" name="email" type="email"
                                       maxlength="50" placeholder="ivanov@email.com" required>
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
                        <tr style="height: 2rem"></tr>
                        <tr>
                            <td class="form-label">
                                <label for="login">
                                    Логин*
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
                                    Пароль*
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
                                <button class="button-submit" type="submit"><p class="button-text">Продолжить</p>
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
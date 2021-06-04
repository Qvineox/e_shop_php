<html>
<title>
    Регистрация
</title>
<style>
    .success-icon required {
        width: 2rem;
    }
</style>
<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="auth_styles.css">

<script src="/jquery.js"></script>
<script src="/functions.js"></script>


<script>
    function errorMessage(message) {
        $('#error-message').text(message)
    }

    function clearErrorMessage() {
        $('#error-message').text('')
    }

    function checkFirstName() {
        if ($('#first_name').val().length >= 2) {
            $('img#first-name-status').show()
            clearErrorMessage()
        } else {
            $('img#first-name-status').hide()
            errorMessage('Слишком короткое имя!')
        }
    }

    function checkLastName() {
        if ($('#last_name').val().length >= 2) {
            $('img#last-name-status').show()
            clearErrorMessage()
        } else {
            $('img#last-name-status').hide()
            errorMessage('Слишком короткая фамилия!')
        }
    }

    function checkMiddleName() {
        if ($('#middle_name').val().length >= 2) {
            $('img#middle-name-status').show()
            clearErrorMessage()
        } else {
            $('img#middle-name-status').hide()
            errorMessage('Слишком короткое отчетсво!')
        }
    }

    function checkEmail() {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let email = $('#email').val()
        if (re.test(email)) {
            $.ajax({
                type: 'GET',
                url: '/handlers/email_availability_handler.php',
                data: {'email': email},
                success: function (json) {
                    let data = JSON.parse(json)
                    if (data['status']) {
                        $('img#email-status-success').show()
                        $('img#email-status-fail').hide()
                        clearErrorMessage()
                    } else {
                        $('img#email-status-success').hide()
                        $('img#email-status-fail').show()
                        errorMessage('Почта уже используется!')
                    }
                },
            })
        } else {
            $('img#email-status-success').hide()
            errorMessage('Неправильная почта!')
        }
    }

    function checkPhone() {
        const re = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
        if (re.test($('#phone').val())) {
            $('img#phone-status').show()
            clearErrorMessage()
        } else {
            $('img#phone-status').hide()
            errorMessage('Неправильный номер!')
        }
    }

    function checkLogin() {
        let login = $('#login').val()

        if (login.length > 2) {
            $.ajax({
                type: 'GET',
                url: '/handlers/login_availability_handler.php',
                data: {'login': login},
                success: function (json) {
                    let data = JSON.parse(json)
                    if (data['status']) {
                        $('img#login-status-success').show()
                        $('img#login-status-fail').hide()
                        clearErrorMessage()
                    } else {
                        $('img#login-status-success').hide()
                        $('img#login-status-fail').show()
                        errorMessage('Логин занят!')
                    }
                },
            })
        } else {
            $('img#login-status-success').hide()
            errorMessage('Логин слишком короткий!')
        }
    }

    function checkPassword() {
        const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        if (re.test($('#password').val())) {
            $('img#password-status-success').show()
            $('img#password-status-failure').hide()
            clearErrorMessage()
            return true
        } else {
            $('img#password-status-success').hide()
            $('img#password-status-failure').show()
            errorMessage('Слабый пароль!')
            return false
        }
    }

    function checkPasswordConfirmation() {
        let password = $('#password').val()
        let password_repeat = $('#password_repeat').val()

        if (password === password_repeat && checkPassword()) {
            $('img#password-repeat-status-success').show()
            $('img#password-repeat-status-failure').hide()
            clearErrorMessage()
        } else {
            $('img#password-repeat-status-success').hide()
            $('img#password-repeat-status-failure').show()
            errorMessage('Пароли не совпадают!')
        }
    }

    function checkForm() {
        let flags = $('img.success-icon.required:visible')

        console.log(flags)
        if (flags.length === 7) {
            $('#submit-button').attr("disabled", false);
        } else {
            $('#submit-button').attr("disabled", true);
        }
    }

    $(document).ready(
        function () {
            $('#submit-button').attr("disabled", true);

            $('input:required').on('input', function () {
                checkForm()
            })
        }
    )
</script>

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
                            <td style="width: 20px">
                                <img class="success-icon required" id="first-name-status" src="../resources/success.svg"
                                     hidden>
                            </td>
                            <td>
                                <input id="first_name" name="first_name" type="text"
                                       maxlength="50" placeholder="Иван" oninput="checkFirstName()" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="last_name">
                                    Ваша фамилия*
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon required" id="last-name-status" src="../resources/success.svg" hidden>
                            </td>
                            <td>
                                <input id="last_name" name="last_name" type="text"
                                       maxlength="50" placeholder="Иванов" oninput="checkLastName()" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="middle_name">
                                    Ваше отчество
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon optional" id="middle-name-status"
                                     src="../resources/success.svg" hidden>
                            </td>
                            <td>
                                <input id="middle_name" name="middle_name" type="text"
                                       maxlength="50" placeholder="Иванович" oninput="checkMiddleName()">
                            </td>
                        </tr>
                        <tr style="height: 2rem"></tr>
                        <tr>
                            <td class="form-label">
                                <label for="email">
                                    Эл. Почта*
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon required" id="email-status-success" src="../resources/success.svg"
                                     hidden>
                                <img class="failure-icon" id="email-status-fail" src="../resources/failure.svg" hidden>
                            </td>
                            <td>
                                <input class="auth" id="email" name="email" type="email" oninput="checkEmail()"
                                       maxlength="50" placeholder="ivanov@email.com" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="phone">
                                    Телефон*
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon required" id="phone-status" src="../resources/success.svg" hidden>
                            </td>
                            <td>
                                <input class="auth" id="phone" name="phone" type="tel" oninput="checkPhone()"
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
                            <td style="width: 20px">
                                <img class="success-icon required" id="login-status-success" src="../resources/success.svg"
                                     hidden>
                                <img class="failure-icon" id="login-status-fail" src="../resources/failure.svg" hidden>
                            </td>
                            <td>
                                <input class="auth" id="login" name="login" type="text" oninput="checkLogin()"
                                       maxlength="20" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="password">
                                    Пароль*
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon required" id="password-status-success" src="../resources/success.svg" hidden>
                                <img class="failure-icon" id="password-status-failure" src="../resources/failure.svg" hidden>
                            </td>
                            <td>
                                <input class="auth" id="password" name="password" type="password"
                                       oninput="checkPassword()"
                                       maxlength="20" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label for="password">
                                    Повтор пароля*
                                </label>
                            </td>
                            <td style="width: 20px">
                                <img class="success-icon required" id="password-repeat-status-success" src="../resources/success.svg" hidden>
                                <img class="failure-icon" id="password-repeat-status-failure" src="../resources/failure.svg" hidden>
                            </td>
                            <td>
                                <input class="auth" id="password_repeat" name="password" type="password"
                                       oninput="checkPasswordConfirmation()"
                                       maxlength="20" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p style="float: right; margin: 0; font-size: 0.8rem; color: gray">Пароль должен
                                    содержать как минимум 8 <b>латинских</b> символов, включая <b>заглавную</b> букву и
                                    <b>цифру</b>.</p>
                            </td>
                        </tr>
                        <tr style="height: 2rem"></tr>
                        <tr>
                            <td colspan="3">
                                <button id="submit-button" class="button-submit" type="submit"><p class="button-text">
                                        Продолжить</p>
                                </button>
                                <div style="float: left; text-align: center">
                                    <p id="error-message" style="font-size: 2rem; margin: 8px 0; color: firebrick">

                                    </p>
                                </div>
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
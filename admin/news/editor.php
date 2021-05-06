<html>
<title>
    Главная страница
</title>
<style>

</style>
<link rel="stylesheet" href="../../styles.css">
<link rel="stylesheet" href="../admin_styles.css"

<?php
$config = include('../../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$mode = $_GET['mode'];
$id = @$_GET['id'];

if (isset($mode)) {
    if ($mode == 'edit') {
        if (isset($id)) {
            $query = "SELECT * FROM article WHERE id = {$id}";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $item = pg_fetch_array($result);
        }
    }
}
?>

<body>
<table width="750" cellpadding="5" cellspacing="0">
    <tr style="align-content: center">
        <td style="width: 20rem;"></td>
        <td style="background-image: url(../../resources/sun_admin.svg); height: 300px; background-repeat: no-repeat">

        </td>
        <td style="width: 20rem;"></td>
    </tr>
    <tr>
        <td class="left-zone">
            <ul class="menu" style="margin-right: 30%">
                <a href="../index.php">
                    <li class="menu-article home">
                        Панель<img src="../resources/gear.svg"></li>
                </a>
                <a href="../items">
                    <li class="menu-article catalog">
                        Товары<img src="../../resources/flower.svg"></li>
                </a>
                <a href="../users">
                    <li class="menu-article catalog" style="font-size: 29px">
                        Пользователи<img src="../resources/user.svg"></li>
                </a>
                <a href="../commisions">
                    <li class="menu-article catalog">
                        Заказы<img src="../resources/money.svg"></li>
                </a>
                <a href="../../index.php">
                    <li class="menu-article admin-options">
                        На главную<img src="../resources/undo.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <form action="handler.php?mode=<?php echo $mode ?>" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td colspan="2" style="border: none">
                            <input value="<?php echo $item['id'] ?>" name="id" hidden>
                            <p class="zone-header"><?php
                                if ($mode == 'edit') {
                                    echo "Редактирование сохраненной записи #{$item['id']}";
                                } elseif ($mode == 'add') {
                                    echo "Добавление новой записи";
                                }
                                ?></p>
                            <hr class="solid">
                        </td>

                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Заголовок</p>
                        </td>
                        <td style="width: 80%">
                            <input type="text" name="header" maxlength="20" class="item-field"
                                   value="<?php echo @$item['header'] ?>"
                                   placeholder="Заголовок новости">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Описание</p>
                        </td>
                        <td style="width: 80%">
                            <textarea name="text" maxlength="500" class="item-field"
                                      placeholder="Текст новости"><?php echo @$item['text'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Картинка</p>
                        </td>
                        <td style="width: 80%">
                            <input type="file" name="image">
                        </td>
                    </tr>
                </table>
                <div style="margin: 20px 5px 0 5px">
                    <button style="width: 25%" class="submit-button" type="submit">
                        Опубликовать
                    </button>

                    <button style="width: 25%" class="submit-button" type="reset">
                        Восстановить
                    </button>
                </div>
            </form>
        </td>
        <td class="right-zone">

        </td>
    </tr>
</table>
</body>
</html>
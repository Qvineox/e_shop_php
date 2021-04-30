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
            $query = "SELECT * FROM item WHERE id = {$id}";
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
                <a href="catalog/sections.php">
                    <li class="menu-article catalog">
                        Товары<img src="../../resources/flower.svg"></li>
                </a>
                <a href="catalog/sections.php">
                    <li class="menu-article catalog" style="font-size: 29px">
                        Пользователи<img src="../resources/user.svg"></li>
                </a>
                <a href="catalog/sections.php">
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

                            <?php
                            if ($mode == 'edit') {
                                echo "<input value=\"{$item['id']}\" name=\"id\" hidden>";
                            }
                            ?>

                            <p class="zone-header"><?php
                                if ($mode == 'edit') {
                                    echo "Редактирование сохраненного товара #{$item['id']}";
                                } elseif ($mode == 'add') {
                                    echo "Добавление нового товара";
                                }
                                ?></p>
                            <hr class="solid">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Наименование</p>
                        </td>
                        <td style="width: 80%">
                            <input type="text" name="name" maxlength="200" class="item-field"
                                   style="width: 80%"
                                   value="<?php echo @$item['name'] ?>"
                                   placeholder="Наименование товара" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Назначение</p>
                        </td>
                        <td style="width: 80%">
                            <input type="text" name="purpose" maxlength="50" class="item-field"
                                   style="width: 80%"
                                   value="<?php echo @$item['name'] ?>"
                                   placeholder="Для рисования красками" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Описание</p>
                        </td>
                        <td style="width: 80%">
                            <textarea name="description" maxlength="2000" class="item-field" style="width: 80%"
                                      placeholder="Описание товара"
                                      required><?php echo @$item['description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Категория</p>
                        </td>
                        <td style="width: 80%">
                            <select class="item-select" name="category">
                                <?php
                                $query = 'SELECT id, name FROM category;';
                                $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                    echo "<option class='item-field' value='{$line['id']}'>
                                            {$line['name']}
                                            </option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Производитель</p>
                        </td>
                        <td style="width: 80%">
                            <select class="item-select" name="manufacturer">
                                <?php
                                $query = 'SELECT id, name FROM manufacturer;';
                                $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                                while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                    echo "<option class='item-field' value='{$line['id']}'>
                                            {$line['name']}
                                            </option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">В наборе</p>
                        </td>
                        <td style="width: 80%">
                            <input type="number" name="quantity" max="32766" min="1" step="1"
                                   class="item-field"
                                   style="width: 20%"
                                   value="1"
                                   placeholder="1" required>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Объем (мл.)</p>
                        </td>
                        <td style="width: 80%">
                            <input type="number" name="value" max="32766" min="0" step="1"
                                   class="item-field"
                                   style="width: 20%"
                                   value="<?php echo @$item['price'] ?>"
                                   placeholder="1">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%">
                            <p class="item-field-header">Цена</p>
                        </td>
                        <td style="width: 80%">
                            <input type="number" name="price" step="0.01" max="999999.99" min="0" maxlength="10"
                                   class="item-field"
                                   style="width: 20%"
                                   value="<?php echo @$item['price'] ?>"
                                   placeholder="00.00" required>
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
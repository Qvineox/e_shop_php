<html>
<title>
    Обработка товара
</title>
<style>

</style>
<link rel="stylesheet" href="../../styles.css">
<link rel="stylesheet" href="../admin_styles.css">

<?php
$config = include('../../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$target_dir = "../../images/item-images/";
$target_file = $target_dir . @basename($_FILES["image"]["name"]);

$uploadOk = False;
$errors = array();

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image


if (@file_exists($_FILES['image']['tmp_name']) || @is_uploaded_file($_FILES['image']['tmp_name'])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = True;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = False;
    }

//    if (file_exists($target_file)) {
//        $errors[] = "Sorry, file already exists.";
//        $uploadOk = False;
//    }

    if ($_FILES["image"]["size"] > 500000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = False;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = False;
    }
}

if (!$uploadOk) {
    $errors[] = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        $errors[] = "Sorry, there was an error uploading your file.";
    }
}

$id = @$_REQUEST['id'];
$name = @$_POST['name'];
$description = @$_POST['description'];
$purpose = @$_POST['purpose'];
$category = @$_POST['category'];
$manufacturer = @$_POST['manufacturer'];
$quantity = @$_POST['quantity'];
$price = @$_POST['price'];
$value = @$_POST['value'];

$optional_fields = array();
$optional_values = array();

if (!empty($quantity)) {
    $optional_fields[] = 'quantity';
    $optional_values[] = $quantity;
}
if (!empty($value)) {
    $optional_fields[] = 'value';
    $optional_values[] = $value;
}

$image = @htmlspecialchars(basename($_FILES["image"]["name"]));

$mode = $_GET['mode'];


if (isset($mode)) {
    if ($mode == 'edit') {
        if ($uploadOk) {
            $optional_fields[] = 'image';
            $optional_values[] = '\'' . $image . '\'';

            $class = 'success';
            $message = 'Товар полностью изменен успешно!';
        } else {
            $class = 'warning';
            $message = 'Товар частично изменен!';
        }

        $updates = array();
        foreach ($optional_fields as $index => $field) {
            $updates = ", $field=$optional_values[$index]";
        }

        $query = "UPDATE item SET name='$name', description='$description', purpose='$purpose', price=$price, category=$category, manufacturer=$manufacturer $updates WHERE id=$id;";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    } elseif ($mode == 'add') {
        if ($uploadOk) {
            $optional_fields[] = 'image';
            $optional_values[] = '\'' . $image . '\'';

            $class = 'success';
            $message = 'Товар полностью добавлен успешно!';
        } else {
            $class = 'warning';
            $message = 'Товар частично добавлен!';
        }

        $inserts = implode(", ", $optional_fields);
        $values = implode(", ", $optional_values);

        $query = "INSERT INTO item(name, description, purpose, price, category, manufacturer, $inserts) VALUES ('$name', '$description', '$purpose', $price, $category, $manufacturer, $values);";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    } elseif ($mode = 'delete') {
        $query = "DELETE FROM item WHERE id = '$id';";
        $class = 'delete';
        $message = "Товар #{$id} удален!";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
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
                <a href="../news">
                    <li class="menu-article home">
                        Новости<img src="../resources/newspaper.svg"></li>
                </a>
                <a href="../index.php">
                    <li class="menu-article home">
                        Панель<img src="../resources/gear.svg"></li>
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
            <table>
                <tr>
                    <td colspan="2">
                        <div class="<?php echo $class ?> progress">
                            <p class="message"><?php echo $message ?></p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul style="margin: 5px 2px; list-style-type: none;">
                            <li>
                                <a class="link recall" href="index.php">
                                    Вернуться к товарам
                                </a>
                            </li>
                            <li>
                                <a class="link recall" href="../index.php">
                                    Вернуться к панели
                                </a>
                            </li>
                        </ul>

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

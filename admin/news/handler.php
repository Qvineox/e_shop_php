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

$target_dir = "../../images/news-images/";
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

$id = $_REQUEST['id'];
$header = @$_POST['header'];
$text = @$_POST['text'];
$image = @htmlspecialchars(basename($_FILES["image"]["name"]));

$mode = $_GET['mode'];

if (isset($mode)) {
    if ($mode == 'edit') {
        if ($uploadOk) {
            $query = "UPDATE article SET header='$header', text='$text', image='$image' WHERE id=$id";
            $class = 'success';
            $message = 'Запись полностью обновлена успешно!';
        } else {
            $query = "UPDATE article SET header='$header', text='$text' WHERE id=$id";
            $class = 'warning';
            $message = 'Запись частично обновлена!';
        }

        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    } elseif ($mode == 'add') {
        $date = date("Y-m-d");
        if ($uploadOk) {
            $query = "INSERT INTO article(header, text, date, image) VALUES ('$header', '$text', '$date', '$image');";
            $class = 'success';
            $message = 'Запись полностью добавлена успешно!';
        } else {
            $query = "INSERT INTO article(header, text, date) VALUES ('$header', '$text', '$date');";
            $class = 'warning';
            $message = 'Запись частично добавлена!';
        }
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
    } elseif ($mode = 'delete') {
        $query = "DELETE FROM article WHERE id = '$id';";
        $class = 'success';
        $message = "Запись #{$id} удалена!";
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
                <a href="../commissions">
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
                                    Вернуться к новостям
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

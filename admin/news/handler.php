<html>
<title>
    Главная страница
</title>
<style>
    div.progress {
        border-radius: 15px;
        width: 100%;
    }

    div.success {
        background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
    }

    div.warning {
        background-image: linear-gradient(-60deg, #ff5858 0%, #f09819 100%);
    }
</style>
<link rel="stylesheet" href="../../styles.css">

<?php
$config = include('../../config.php');

$connection = pg_connect("host={$config['host']} dbname={$config['database']} user={$config['username']} password={$config['password']}")
or die('Не удалось соединиться: ' . pg_last_error());

$target_dir = "../../images/news-images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

$uploadOk = False;
$errors = array();

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image


if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
    printf('OBAMA0');
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = True;
    } else {
        $errors[] = "File is not an image.";
        printf('OBAMA1');
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
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        $errors[] = "Sorry, there was an error uploading your file.";
    }
}

$id = $_POST['id'];
$header = $_POST['header'];
$text = $_POST['text'];
$image = htmlspecialchars(basename($_FILES["image"]["name"]));

printf($id);
printf($header);
printf($text);
printf($image);

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
                <a href="../index.php">
                    <li class="menu-article admin-options">
                        Вернуться<img src="../resources/undo.svg"></li>
                </a>
            </ul>
        </td>
        <td class="content center-zone curved" style="vertical-align: top">
            <table>
                <tr>
                    <td>
                        <div class="<?php echo $class ?> progress">
                            <p><?php echo $message ?></p>
                        </div>
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

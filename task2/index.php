<?php
include 'FilesManager.php';
$fm = new FilesManager($_FILES);

if (isset($_FILES['file'])) {
    if (!$fm->saveToUploadDir()) {
        echo '<p class="error">' . $fm->error . '</p>';
    }
}

if (isset($_GET['delfile']) && !empty($_GET['delfile'])) {
    $fm->deleteFile($_GET['delfile']);
    header('Location: ' . $_SERVER["SCRIPT_NAME"]);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="<?= $_SERVER["SCRIPT_NAME"]; ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Отправить">
</form>
<hr>
<?php

foreach ($fm->getUploadedFiles() as $file) {
    echo '<a title="Удалить" class="file-item" href="' . $_SERVER["SCRIPT_NAME"] . '?delfile=' . $file . '">' . $file . ' </a>';
}

?>
</body>
</html>



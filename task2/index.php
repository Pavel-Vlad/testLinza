<?php
include 'FilesManager.php';

if (isset($_FILES['file'])) {
    $fm = new FilesManager($_FILES);
    if (!$fm->saveToUploadDir()) {
        echo '<p class="error">' . $fm->error . '</p>';
        die();
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Отправить">
</form>

<?php
require_once("../../includes/initialize.php");

$message ="test";
if(isset($_POST['submit'])) {
    $photo = new Photograph();
    $photo->id = 1;
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);
    if($photo->save()) {
        $message = "Photo uploaded successfully";
    } else {
        $message = join("<br/>",$photo->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>


<html>
    <body style="background-color:white;">
        <h2>Foto upload test</h2>
        <?php echo $message; ?>
        <form action="test.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <p> <input type="file" name="file_upload" /> </p>
            <p>Caption: <input type="text" name="caption" value="" /> </p>
            <input type="submit" name="submit" value="upload" />
        </form>
    </body>
</html>

<?php include_layout_template('admin_footer.php'); ?>


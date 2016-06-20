<?php
require_once("../../includes/initialize.php");

$message ="";
$max_file_size = 1048576;
    
if(isset($_POST['submit'])) {
    //var_dump($_FILES);
    $photo = new Photograph();
    
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);
    if($photo->save()) {
        $message = "Photo uploaded successfully";
    } else {
        $message = join("<br/>",$photo->errors);
        //$message = "not working";
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>


<html>
    <body style="background-color:white;">
        <h2>Foto upload test</h2>
        <?php echo output_message($message); ?>
        <form action="photo_upload.php"  method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
            <p> <input type="file" name="file_upload" /> </p>
            <p>Caption: <input type="text" name="caption" value="" /> </p>
            <input type="submit" name="submit" value="upload" />
        </form>
    </body>
</html>

<?php include_layout_template('admin_footer.php'); ?>


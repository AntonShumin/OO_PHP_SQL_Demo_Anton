<?php
require_once("../../includes/initialize.php");


?>
<?php include_layout_template('admin_header.php'); ?>


<html>
    <body>
        <h2>Foto upload test</h2>
        <form action="test.php" enctype="multipart/form-data" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <p> <input type="file" name="file_upload" /> </p>
            <p>Caption: <input type="text" name="caption" value="" /> </p>
            <input type="submit" name="submit" value="upload" />
        </form>
    </body>
</html>

<?php include_layout_template('admin_footer.php'); ?>


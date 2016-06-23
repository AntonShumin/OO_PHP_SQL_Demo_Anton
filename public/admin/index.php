<?php
require_once("../../includes/initialize.php");

if(!$session->is_logged_in()) {
    redirect_to("login.php");
}

$photos = Photograph::find_all();
?>

<?php include_layout_template('admin_header.php'); ?>

<html>
    <div class="section3"> 
        <h2>Photographs</h2>
        <table class="bordered">
            <tr>
                <th>Image</th>
                <th>Filename</th>
                <th>Caption</th>
                <th>Size</th>
                <th>Type</th>
            </tr>
            <?php foreach($photos as $photo): ?>
                <tr>
                    <td> <img src="" width="100" /> </td>
                    <td> <?= $photo->filename; ?> </td>
                    <td> <?= $photo->caption; ?> </td>
                    <td> <?= $photo->size; ?> </td>
                    <td> <?= $photo->type; ?> </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="photo_upload.php">Upload a new photograph</a>
    </div>
    
</html>

<?php include_layout_template('admin_footer.php'); ?>


<?php
require_once("../../includes/initialize.php");

$message = '';

if($session->is_logged_in()) {
    redirect_to("index.php");
}

if(isset($_POST['submit'])) {
    //form has been submitted
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //check the database to see if the password exist
    $found_user = User::authenticate($username,$password);
    
    if($found_user){
    $session->login($found_user);
    redirect_to("index.php");
    } else {
        $message = "Username/password combination incorrect.";
    }
} else {
    $username = "";
    $password = "";
}
?>

<html>
    <head>
        <title>Photo Gallery</title>
        <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include_layout_template('admin_header.php'); ?>
        <div id="main">
            <h2>Staff Login</h2>
            <?php echo output_message($message); ?>
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Login" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php include_layout_template('admin_footer.php'); ?>
    </body>
</html>

<?php if(isset($database)) { $database->close_connection();} ?>



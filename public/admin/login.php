<?php
require_once("../includes/database.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/user.php");

if($session->is_logged_in()) {
    redirect_to("index.php")
}

if(isset($_POST['submit'])) {
    //form has been submitted
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    //check the database to see if the password exist
    $found_user = ...
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
        <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <h1>Photo Gallery</h1>
        </div>
        <div id="main"/>
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
        
        <div id="footer">
            Copyright <?php echo date("Y", time()); ?>, S.Anton
        </div>
    </body>
</html>

<?php if(isset($database)) { $database->close_connection();} ?>



<?php
require_once("../includes/initialize.php");
//temp redirect
//redirect_to("admin/login.php");
?>

<?php include_layout_template('admin_header.php'); ?>
<html>
    <head>
        <title>S.Anton Demo</title>
        <!-- Latest compiled and minified CSS, bootstrap3 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Main CSS -->
        <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="bgimage">
            <div class="bgcover">
                <div class="container">
                    <h1>PHOTO GALLERY DEMO</h1>
                    <p>Content binnenkort beschikbaar. Under construction</p>
                </div>
            </div> 
        </div>
        <div class="jq_slider">
            <p>| Bootstrap 3 | jQuery | PHP 5.6 | mySQL |</p>
        </div>
        <div class="section1">
            <h1>CREATED WITH</h1>
            <p>following programming techniques</p>
            <div class="frame row">
                <div class="col-sm-4">
                    <p>Bootstrap</p>
                    <img class="icon" src="images/logos/bootstrap.png"/>
                </div>
                <div class="col-sm-4">
                    <p>PHP & mySQL</p>
                    <img class="icon" src="images/logos/php-mysql-logo.png"/>
                </div>
                <div class="col-sm-4">
                    <p>jQuery</p>
                    <img class="icon" src="images/logos/jquery.png"/>
                </div>
            </div>
        </div>
        <div class="section2">
            <h1>TOP PICTURES</h1>
            <p>using popular mySQL database</p>
        </div>
        <div class="section1">
            <h1>FANCY DYNAMIC STUFF</h1>
            <p>if you love dynamic jQuery and AJAX (who doesnt)</p>
        </div>
        <?php include_layout_template('admin_footer.php'); ?>
    </body>
</html>
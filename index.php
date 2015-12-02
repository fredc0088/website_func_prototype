<!--
* module: Web Programming Using PHP
* author : Federico Cocco
* username :  fcocco01 
* Birkbeck University of London 
* tutor : Pablo Alperin
*
* July 2015
* I declare this being my work, designed and developed by myself 
* I have also made use of the material provided on the slides, the FMA 
* workshop and some code inspired from PHP manual and W3SCHOOL
* 
*
* This the main page, the only page where the log in is possible
*
-->

<?php
//start a session
session_start();
require_once 'utilities/functions.php';

//the 'message' is passed through the URL
if (isset($_GET["message"])) {
    $message = "<p>" . $_GET["message"] . "</p>";
} else {
    $message = "";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>BBK - Web Programming using PHP</title>
    </head>

    <body>

        <header>
            <h1>Welcome to this website</h1>
            <?php
            /* if the user is logged in already, 
             * the logout button appears and if it is clicked
             * it calls the logout function
             */
            if (isset($_SESSION['username'])) {
                echo 'Welcome ' . $_SESSION['username'];
                include_once 'utilities/logout_form.php';
            } else {

                //if the user is logged out, the login form will appear
                include_once 'utilities/login_form.php';
            }

            echo $message;
            ?>
            <br>
        </header> 

        <?php
//appears only if the user is logged out
        if (!isset($_SESSION['username'])) {
            ?>
            <p>
                <a href='registration.php?<?php echo SID; ?>'>Register an account</a> 
            </p>
    <?php
} else {

    //appears only if the user is already logged in
    ?>
            <p>
                <a href='private.php?<?php echo SID; ?>'>Go back to the private page</a> 
            </p>
    <?php
}
?>

        <p>
            <a href='RandomContent.php?<?php echo SID; ?>'>Go to another page</a>
        </p>
        <p>
            Content here!
        </p>
    </body>
</html> 
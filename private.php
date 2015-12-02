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
* This page is a private page accessible in its entirety only if a user is logged in
*
-->

<?php
session_start();
require_once "utilities/functions.php";
$name_user = "";
if (isset($_SESSION['username'])) {
    $name_user = $_SESSION['username'];
} else {
    die('Content of this page is only accessible by members. Please log in to see the content');
}

//the 'message' is passed through the URL
if (isset($_GET["message"])) {
    $message = "<p>" . $_GET["message"] . "</p>";
} else {
    $message = "";
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>BBK - Web Programming using PHP</title>
    </head>
    <body>
        <?php
        echo "<p>Welcome " . $name_user . " to your private page. You are now logged in."
        ?>
        <br>
        <?php
        /* if the user is logged in already, 
         * the logout button appears and if it is clicked
         * it calls the logout function
         */
        include_once 'utilities/logout_form.php';
        echo $message;

        echo '<p> Fusce eleifend porttitor molestie. Donec sollicitudin venenatis justo sit amet rutrum. '
        . 'Vestibulum blandit finibus dolor, eu lobortis eros molestie id. Sed volutpat convallis risus, '
        . 'quis dapibus nulla pulvinar eget. '
        . 'Duis molestie neque ipsum. '
        . 'Aenean dictum ligula nunc, nec pretium ex hendrerit fringilla.</p>';
        ?>
        <br>
        <p>
            <a href='index.php?<?php echo SID; ?>'>Go back to the main page</a> 
        </p>
        <p>
            <a href='RandomContent.php?<?php echo SID; ?>'>Go to another page</a>
        </p>
    </body>

</html>

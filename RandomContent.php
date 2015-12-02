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
* This page is a page containing random content, in order to demonstrate the 
* passage of data between pages using sessions
*
-->

<?php
session_start();
require_once "utilities/functions.php";

//the 'message' is passed through the URL
if (isset($_GET["message"])) {
    $message = "<p>" . $_GET["message"] . "</p>";
} else {
    $message = "";
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BBK - Web Programming using PHP</title>
    </head>
    <body>
        <h1>Do you want to know your Session ID?</h1>
        <?php
        /* if the user is logged in already, 
         * the logout button appears and if it is clicked
         * it calls the logout function
         */
        if (isset($_SESSION['username'])) {
            echo 'Your ID for this session is: ' . session_id();
            include_once 'utilities/logout_form.php';
            echo $message;

            echo "<p>Duis quis facilisis dolor. Integer vestibulum ipsum non consequat ultrices. "
            . "Etiam malesuada facilisis facilisis. Nullam non ullamcorper enim. Integer orci quam, varius quis ipsum eu, faucibus congue odio. Proin ultrices vitae lorem a imperdiet. Duis bibendum erat sit amet semper tristique. "
            . "Nunc vel nulla maximus, tristique dolor faucibus, tempus mi. "
            . "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum dapibus lorem erat, ut imperdiet sapien lacinia sed. Praesent vel elit hendrerit, fringilla justo eget, cursus quam. "
            . "Fusce sed leo ut quam convallis posuere vitae nec turpis. "
            . "Aliquam placerat, ipsum at aliquam tempus, ligula neque lobortis tortor, a vulputate sem est nec nunc. Morbi convallis sodales sapien. "
            . "Vivamus mollis nibh eros, congue luctus nisi pellentesque ut.</p>";
        } else {
            //if the user is logged out, the login form will appear
            include_once 'utilities/login_form.php';

            echo $message;
            echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas id augue lacus. Mauris ligula nulla, finibus sed tellus ac, auctor aliquam elit. Mauris vitae molestie nisi. Sed mollis, mi non consectetur mollis, mauris lorem placerat quam, sit amet tincidunt purus eros vel dolor. Mauris eu dui vitae mauris sollicitudin scelerisque. Nunc et egestas est. Donec laoreet, felis sit amet congue ullamcorper, tortor nibh pellentesque augue, sit amet sollicitudin eros mauris a orci.</p>";
            echo "<p>Aenean placerat mi vitae leo luctus, ut fermentum sem laoreet. Sed id cursus justo. Quisque pharetra at elit vel auctor. Maecenas ut viverra justo. Pellentesque maximus quis massa hendrerit porta. Etiam ac interdum justo, quis elementum lectus. Quisque laoreet magna vitae efficitur mollis. Vestibulum in maximus risus.Sed imperdiet suscipit urna ut facilisis. Integer viverra libero interdum scelerisque egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. "
            . "Quisque aliquet lacus id suscipit molestie. Curabitur eros ipsum, venenatis sed leo ac, egestas sagittis odio. Quisque vitae metus lobortis, eleifend massa sit amet, tincidunt lacus. Vestibulum venenatis dapibus lacus a fermentum. Vestibulum est ipsum, mollis sit amet purus quis, dignissim pulvinar sapien. Praesent venenatis blandit neque. In ac porttitor velit. Nam vitae eros ac tellus tempus pulvinar et sed diam. Nullam aliquet tellus nec vehicula molestie. Ut bibendum lacus sit amet risus faucibus, sit amet dictum turpis commodo.</p>";
        }
        ?>
        <p>
            <a href='index.php?<?php echo SID; ?>'>Go to the main page</a>
        </p>
        <br>
        <p>
            <a href='private.php?<?php echo SID; ?>'>Go to the private page</a> 
        </p>

    </body>
</html>

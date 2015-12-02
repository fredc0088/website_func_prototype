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
* This page allow a new user to register
*
-->

<?php
session_start();
require_once "utilities/functions.php";

//new array error_messages declared
$error_messages = array();

//returning either error message or validated details
if (isset($_POST['submit'])) {
    $error_messages_username = validate_userName($_POST['username']);
    $error_messages_name = validate_name($_POST['fullname']);
    $error_messages_email = validate_email($_POST['email']);
    $error_messages_password = validate_password($_POST['password']);
    
    //if error_messages is empty, a member is registered and go to the index page
    if (!(returns_array($error_messages_username, $error_messages_name, $error_messages_email, $error_messages_password))) {
        register($error_messages_username, $error_messages_name, $error_messages_email, $error_messages_password);
        header('location:index.php?message="You are registered as a member"');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registration Page</title>
    </head>

    <body>
        <h1>REGISTRATION NEW USER</h1>

        <?php
        //set variables
        $error_username = "";
        $error_name = "";
        $error_email = "";
        $error_password = "";
        $enteredUsername = "";
        $correctName = '';
        $correctEmail = '';
        //if there is any error contained in the return an error message is set
        if (isset($error_messages_username) && is_Array($error_messages_username)) {
            foreach ($error_messages_username as $error) {
                $error_username = $error;
            }
        } elseif (isset($error_messages_username)) {
            $enteredUsername = $error_messages_username;
        }

        if (isset($error_messages_name) && is_Array($error_messages_name)) {
            foreach ($error_messages_name as $error) {
                $error_name = $error;
            }
        } elseif (isset($error_messages_name)) {
            $correctName = $error_messages_name;
        }

        if (isset($error_messages_email) && is_array($error_messages_email)) {
            foreach ($error_messages_email as $error) {
                $error_email = $error;
            }
        } elseif (isset($error_messages_email)) {
            $correctEmail = $error_messages_email;
        }

        if (isset($error_messages_password) && is_array($error_messages_password)) {
            foreach ($error_messages_password as $error) {
                $error_password = $error;
            }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?" . SID; ?>" method="post">
            <label>Username</label><br>
            <input id="username" name="username" placeholder="enter an ID" type="text" value="<?php echo $enteredUsername; ?>">
            <?php
            echo $error_username;
            ?><br><br>
            <label>FullName</label><br>
            <input id="name" name="fullname" placeholder="enter your fullname" type="text" value="<?php echo $correctName; ?>">
            <?php
            echo $error_name;
            ?><br><br>
            <label>Email :</label><br>
            <input id="userEmail" name="email" placeholder="email" type="email" value="<?php echo $correctEmail; ?>">
            <?php
            echo $error_email;
            ?><br><br>
            <label>Password :</label><br>
            <input id="password" name="password" placeholder="**********" maxlength="30" type="password">
            <?php
            echo $error_password;
            ?><br><br>
            <input name="submit" type="submit" value=" SignUp ">
        </form>
        <a href='index.php'>Go back to the main page</a>
    </body>
</html>
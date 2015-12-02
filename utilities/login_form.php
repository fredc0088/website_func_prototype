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
* This page displays a form to log in and contain a function that process 
* the inputs of it
*
--> 

<?php
//create variables
$error_messages_login = array();
$error_username = "";
$error_password = "";

//if the login form is submit, the return of login() is stored
if (isset($_POST['submit'])) {
    $username_login = $_POST['username'];
    $password_login = $_POST['password'];
    $dataReturned = login($username_login, $password_login);

//verify whether the return is actually an array
    if (is_array($dataReturned)) {

        //if the data stored is an array containg the wanted data, session store data inside the global variable
        if (array_key_exists('TheUsername', $dataReturned) && array_key_exists('ThePassword', $dataReturned)) {
            $_SESSION ['username'] = $dataReturned['TheUsername'];

            //head directly to the same page but logged in
            header('location:' . $_SERVER['PHP_SELF'] . '?message="You are now logged in"&' . SID);
        } else {

            //if the data stored contains error messages, they are stored into two variables
            if (array_key_exists('username_error', $dataReturned)) {
                $error_username = $dataReturned['username_error'];
            }
            if (array_key_exists('password_error', $dataReturned)) {
                $error_password = $dataReturned['password_error'];
            }
        }
    }
}
?>

<!--Login form. This form recall the same page where it is executed-->
<h2>Login Form</h2>
<form action="index.php?<?php echo SID; ?>" method="post">
    <label>UserName :</label>
    <input id="idUser" name="username" placeholder="username" type="text">
    <?php
    //display error
    echo $error_username;
    ?>
    <br>
    <label>Password :</label>
    <input id="password" name="password" placeholder="**********" type="password">              
    <?php
    //display error
    echo $error_password;
    ?>
    <br> 
    <input name="submit" type="submit" value=" Login ">
</form>


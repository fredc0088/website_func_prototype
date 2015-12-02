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
* This page displays a button to log out from the session and
* contains a function to make it works
*
-->
<?php
if (isset($_POST['destroy'])) {
    logout();
}
?>

<!--Logout form. This form sends the user back to the index page once used-->
<form action="index.php?<?php echo SID; ?>" method="post">
    <fieldset>
        <input type="submit" name="destroy" value="Log Out" /> 
    </fieldset>
</form>
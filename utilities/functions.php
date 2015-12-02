<?php

// * module: Web Programming Using PHP
// * author : Federico Cocco
// * username :  fcocco01 
// * Birkbeck University of London 
// * tutor : Pablo Alperin
// *
// * July 2015
// * I declare this being my work, designed and developed by myself 
// * I have also made use of the material provided on the slides, the FMA 
// * workshop and some code inspired from PHP manual and W3SCHOOL
// * 
// *
// * Here lie all the functions that process data. They are being called in the 
// * other pages when needed


/*
 * This function allows to read and parse from a file
 * 
 * params $file
 * return array $linesOfFile
 *
 * READFILECHOSEN
 */

function readFileChosen($file) {
    if (isset($file) && is_readable($file)) {
        $file_to_read = fopen($file, 'r');
        while (!feof($file_to_read)) {
            $linesOfFile[] = fgets($file_to_read);
        }
    }

    // !!! I devised two alternatives if the file does not exist:
    // 1) If file does not exist, a new file is created:
//    } else {
//        $file_to_read = fopen($file, 'w');
//        readFileChosen($file);
    //2) If file does not exist, it brings up a 404 error message:
    else {
        die("Error 404: File not found");
    }
    fclose($file_to_read);
    return $linesOfFile;
}

/*
 * This function allows to log into the session
 * 
 * params $username, $password
 *
 * return array $login
 * OR
 * array $error_messages_login
 *
 * LOGIN
 */

function login($username, $password) {
	session_regenerate_id(true);
    $file = "/home/fcocco01/private/users.php";
    $linesOfFile = readFileChosen($file);
    //set variables
    $all_correct = FALSE;
    $username_correct = FALSE;
    $password_correct = FALSE;
    $username_login_trimmed = trim(filter_var($username, FILTER_SANITIZE_STRING));
    $password_login_trimmed = trim(filter_var($password, FILTER_SANITIZE_STRING));
    if (!(empty($username)) || ! (empty($password))) {
        //Foreach loop to take each line of the array 
        foreach ($linesOfFile as $line) {
            //Exclude empty lines from loop
            if (!($line == "") || ! (is_bool($line))) {
                //Parse each line into array of elements
                $details = explode(',', $line);
                //Stores, trims and sanitizes input from the user
                //checks if the array exists and assign variables from indexed values
                if (isset($details) && is_Array($details)) {
                    $details_username = reset($details);
                    $details_password = trim(end($details));
                    //compares values with input. If they do not match or input is empty, gives out error
                    if (($username_login_trimmed === $details_username) && ($password_login_trimmed === $details_password)) {
                        $all_correct = TRUE;
                        break;
                    } else if (($username_login_trimmed === $details_username)) {
                        $username_correct = TRUE;
                    } 
                }
            }
        }
    }

    //returns arrays depending which condition is satisfied
    //the details are both correct
    if ($all_correct) {
        session_regenerate_id(true);
        return array('TheUsername' => $username_login_trimmed, 'ThePassword' => $password_login_trimmed);
    } else {
        //one or more detail was wrong or left empty
        if (!($username_correct)) {
            $error_messages_login['username_error'] = "username is incorrect";
        }
        if ($username_correct) {
            $error_messages_login['password_error'] = "password is incorrect";
        }
        if (empty($username)) {
            $error_messages_login['username_error'] = "please insert a valid username";
        }
        if (empty($password)) {
            $error_messages_login['password_error'] = "please insert your password";
        }
        return $error_messages_login;
    }
}

/*
 * 
 * This function writes registration detals to a new line in  separated php file
 * 
 * @params $fullName,  $email, $password
 * @return void
 * 
 * fwrite(fh, $data);    
 * fclose($fh);
 * 
 * REGISTER 
 */

function register($userName, $fullName, $email, $password) {
    $fileName = "/home/fcocco01/private/users.php";

    //open the file
    $fh = fopen($fileName, 'a');

    //write the data onto the file
    $data = $userName . ',' . $fullName . ',' . $email . ',' . $password . PHP_EOL;
    fwrite($fh, $data);
    fclose($fh);
}

/*
 * 
 * This function sanitizes and then verifies whether the user input is acceptable,
 * concerning the user's name of choice
 * If not, return an error message
 *  
 * @params $username_input
 * @return $userName
 * or
 * $errors
 * 
 * VALIDATE_USERNAME 
 */

function validate_userName($username_input) {

    //store and sanitize the input and remove white spaces at the end and the beginning of it
    $userName = trim(filter_var($username_input, FILTER_SANITIZE_STRING));
    $errors = FALSE;

    if (empty($userName)) {
        $errors = TRUE;
        $error_messages[] = "please enter an user name or ID";

        //check if the username is already being used by another user
    } elseif (existingUsername($userName)) {
        $errors = TRUE;
        $error_messages[] = "username already being used";
    }

    //returns the username or an error message
    if ($errors == TRUE) {
        return $error_messages;
    } else {
        return $userName;
    }
}

/*
 * 
 * This function sanitizes and then verifies whether the user input is acceptable,
 * concerning the user full name
 * If not, return an error message
 *  
 * @params $fullname_input
 * @return $fullName
 * or
 * $errors
 * 
 * VALIDATE_NAME 
 */

function validate_name($fullname_input) {

    //store and sanitize the input and remove white spaces 
    //at the end and the beginning of it
    $fullName = trim(filter_var($fullname_input, FILTER_SANITIZE_STRING));
    $errors = FALSE;

    if (empty($fullName)) {
        $errors = TRUE;
        $error_messages[] = "please enter your full name";
    } elseif (strpos($fullName, ',')) {
        $errors = TRUE;
        $error_messages[] = "please avoid character ','";
    } elseif (!(strpos($fullName, ' '))) {
        $errors = TRUE;
        $error_messages[] = "insert at least your first name and surname";
    }

    //returns the fullname or an error message
    if ($errors == TRUE) {
        return $error_messages;
    } else {
        return $fullName;
    }
}

/*
 * 
 * This function verifies if the returns of different methods are arrays;
 *  
 * @params $u, $f, $e, $p 
 * @return TRUE
 * 
 * RETURNS_ARRAY 
 */

function returns_array($u, $f, $e, $p) {
    if (is_array($u) || is_array($f) || is_array($e) || is_array($p)) {
        return TRUE;
    }
}

/*
 * 
 * This function sanitizes and then verifies whether the user input is acceptable,
 * concerning the email
 * If not, return an error message
 *  
 * @params $email_input
 * @return $email
 * or
 * $errors
 * 
 * VALIDATE_EMAIL 
 */

function validate_email($email_input) {

    //store and sanitize the input and remove white spaces at the 
    //end and the beginning of it
    $email = filter_var($email_input, FILTER_SANITIZE_EMAIL);
    $errors = FALSE;

    //check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = TRUE;
        $error_messages[] = "please enter a valid email address";
    } elseif (strpos($email, ',')) {
        $errors = TRUE;
        $error_messages[] = "please avoid character ','";
    } elseif (existingEmail($email)) {
        $errors = TRUE;
        $error_messages[] = "you are already registered with an account";
    }

    //returns the email or an error message
    if ($errors == TRUE) {
        return $error_messages;
    } else {
        return $email;
    }
}

/*
 * 
 * This function sanitizes and then verifies whether the user input is acceptable,
 * concerning the password
 * If not, return an error message
 *  
 * @params $password_input
 * @return $password
 * or
 * $error_messages()
 * 
 * VALIDATE_PASSWORD 
 */

function validate_password($password_input) {
    $password = trim(filter_var($password_input, FILTER_SANITIZE_STRING));
    $errors = FALSE;
    $passwordLenght = strlen($password);

    if (empty($password)) {
        $errors = TRUE;
        $error_messages[] = "please enter a password between 5 - 10 characters";
    } elseif ($passwordLenght < 5) {
        $errors = TRUE;
        $error_messages[] = "password too short";
    } elseif ($passwordLenght > 10) {
        $errors = TRUE;
        $error_messages[] = "password too long";
    } elseif (strpos($password, ',')) {
        $errors = TRUE;
        $error_messages[] = "please avoid character ','";
    }

    //return the password or an error message
    if ($errors == TRUE) {
        return $error_messages;
    } else {
        return $password;
    }
}

/*
 * 
 * This function checks whether a certain data is already existing in a file
 * In this case the username
 *  
 * @params $theUsername
 * @return BOOLEAN $username_taken 
 * 
 * EXISTINGUSERNAME
 */

function existingUsername($theUsername) {
    $file = "/home/fcocco01/private/users.php";
    $linesOfFile = readFileChosen($file);

    //Foreach loop to take each line of the array 
    foreach ($linesOfFile as $line) {

        //Exclude empty lines from loop
        if (!empty($line)) {

            //Parse each line into array of elements
            $details = explode(',', $line, 4);
            $details_username = $details[0];

            //check if the parameter matches with the store data
            if ($theUsername == $details_username) {
                $username_taken = TRUE;
                return $username_taken;
            }
        }
    }
}

/*
 * 
 * This function checks whether a certain data is already existing in a file
 * In this case the username
 *  
 * @params $the_email
 * @return BOOLEAN $username_taken 
 * 
 * EXISTINGUSERNAME
 */

function existingEmail($the_email) {
    $file = "/home/fcocco01/private/users.php";
    $linesOfFile = readFileChosen($file);

    //Foreach loop to take each line of the array 
    foreach ($linesOfFile as $line) {

        //Exclude empty lines from loop
        if (!empty($line)) {

            //Parse each line into array of elements
            $details = explode(',', $line, 4);
            $details_email = $details[2];

            //check if the parameter matches with the store data
            if ($the_email == $details_email) {
                $username_taken = TRUE;
                return $username_taken;
            }
        }
    }
}

/*
 * This function destroys the current session
 * and delete session cookies if they are being used
 *
 * Function taken from the fma WORKSHOP provided for the module
 *
 * LOGOUT
 */

function logout() {

    //regerate the session ID each time a user log in
    session_regenerate_id(true);

    //empty the global session variable
    $_SESSION = array();

    // delete the session cookies
    if (ini_get("session.use_cookies")) {
        $time = time() - (24 * 60 * 60);
        $params = session_get_cookie_params();
        setcookie(session_name(), '', $time, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
    }

    //destroy the current session
    session_destroy();
    header('Location:index.php?message="You have been successfully logged out"');
}

<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       sign_in.php
    Purpose:        This file will serve as a page that allows the user to sign
                    in using their email and password. If the sign in
                    information is valid, it will be stored in a session and the
                    user will be redirected to the home page. Otherwise, an
                    error message will be displayed
*/

    require_once("functions.php");
    $incorrectPassword = false;
    $incorrectEmail = false;

    if (isset($_POST['email']) && isset($_POST['password'])) {
        //Check the email and password entered by the user
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Check if the email entered was valid
        if(!empty(getUserRecord($email))) {
            session_start();
            //Store the valid user information in the session variable
            $_SESSION['username'] = getUserRecord($email);

            //Check if the password entered is valid
            if(password_verify($password, $_SESSION['username']["password"])) {
                //Redirect to the home page
                header("Location: index.php");
                exit();
            }//end if
            else {
                $incorrectPassword = true;
            }//end else
        }//end if
        else {
            $incorrectEmail = true;
        }//end else
    }//end if
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav><ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="sign_in.php">Sign In</a></li>
    <li><a href="create_account.php">Create Account</a></li>
</ul></nav>
<h1>Sign In</h1>

<form action="sign_in.php" method="post">
    <label>Email: <input type="email" name="email" required autofocus></label>
    <br>
    <label>Password: <input type="password" name="password" required></label>
    <br>
    <input type="submit" value="Sign In">
</form>

<?php
    //Error message for an incorrect password
    if($incorrectPassword) {
        print "<pre>Error: Password Invalid</pre>";
    }//end if
    //Error message for an invalid email
    if($incorrectEmail) {
        print "<pre>Error: Email Invalid</pre>";
    }//end if

?>
</body>
</html>

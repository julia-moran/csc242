<?php

//    Updated by:     Julia Moran
//    Major:          Computer Science
//    Creation Date:  November 17, 2022
//    Due Date:       November 28, 2022
//    Course:         CSC242 010
//    Professor Name: Dr. Schwesinger
//    Assignment:     #9
//    Filename:       sign_in.php
//    Purpose:        This file serves as the sign in page. It will redirect to
//                    the home page if the sign in information is valid.

//    Source Cited:

//    Author:         Dr. Schwesinger
//    Filename:       sign_in.php
//    Retrieved Date: November 17, 2022
//    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project9-handout/sign_in.php
//    Note:           All content except for the code in PHP
//                    was authored by Dr. Schwesinger.


// TODO
// 1. If the form values are set, then get the user record from the database
//    by calling the getUserRecord function.
// 2. If a record is returned, then store each of the values in session
//    variable and redirect to the home page.
// 3. If a record is not returned, then print a message that the email and
//    password combination is not valid.

    require_once("functions.php");

    //Check if the email and password fields are set
    if (isset($_POST['email'])
        && isset($_POST['password'])) {

        //Get the email and password from the user
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Check if the log in information matches any record in the database
        if(!empty(getUserRecord($email, $password))) {
            session_start();

            //Store the user information array to a session variable
            $_SESSION['username'] = getUserRecord($email, $password);

            //Redirect to the home page
            header("Location: index.php");
            exit();
        }//end if
        //Print an error message if the email and password were not found
        else {
            //$IS_VALID = false;
            print "<pre>Error: Sign In Information Invalid</pre>";
        }//end else
    }//end if     

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
</head>
<body>
<nav>
  <a href="index.php">Home</a>
</nav>
<h1>Sign In</h1>

<form action="sign_in.php" method="post">
    <label>User <input type="email" name="email" required autofocus></label>
    <br>
    <label>Password <input type="password" name="password" required></label>
    <br>
    <input type="submit" value="Sign In">
</form>

</body>
</html>

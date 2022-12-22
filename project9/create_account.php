<?php

//    Updated by:     Julia Moran
//    Major:          Computer Science
//    Creation Date:  November 17, 2022
//    Due Date:       November 28, 2022
//    Course:         CSC242 010
//    Professor Name: Dr. Schwesinger
//    Assignment:     #9
//    Filename:       index.php
//    Purpose:        This file serves as the page to create an account. It will
//                    insert a new user to the database if the input is valid.

//    Source Cited:

//    Author:         Dr. Schwesinger
//    Filename:       create_account.php
//    Retrieved Date: November 17, 2022
//    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project9-handout/create_account.php
//    Note:           All content except for the code in PHP
//                    was authored by Dr. Schwesinger.


// TODO 
// 1. Validate that the password fields match
// 2. If the password fields match attempt to insert the data into the database
//    by calling the insertUserRecord function
// 3. If the insertion is successful, then redirect to the sign in page
// 4. If the password fields do match or the insertion fails, then print a
//    message that the input is not valid.

    require_once("functions.php");

    //$IS_VALID = true;

    //Check if all fields are set
    if (isset($_POST['user'])
        && isset($_POST['email'])
        && isset($_POST['dob'])
        && isset($_POST['password1'])
        && isset($_POST['password2'])) {

        //Get the user information from the user
        $username = $_POST['user'];
        $email = $_POST['email'];
        $dateOfBirth = $_POST['dob'];
        $password = $_POST['password1'];
        $retypedPassword = $_POST['password2'];

        //Check if the password fields match
        if($password === $retypedPassword) {
            //Create an account by inserting the data to the database
            $status = insertUserRecord($username, $email, $dateOfBirth, $password);
        }//end if

        //else { $IS_VALID = false; }


        //Check if the passwords do not match or inserting a record fails
        if(($password != $retypedPassword) || ($status === FALSE)) {
            //Print an error message
            print "<pre>Invalid Input: Please check if the passwords match.</pre>";
        }//end if
        else {
            //Redirect to the sign in page if the input is valid
            header("Location: sign_in.php");
            exit();
        }//end else
    }//end if

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Account</title>
</head>
<body>
<nav>
  <a href="index.php">Home</a>
</nav>

<h1>Create an account</h1>
<form action="create_account.php" method="post">
  <label>User Name<input type="text" name="user" required autofocus> </label>
  <label>Email<input type="email" name="email" required></label>
  <label>Date of birth: <input type="date" name="dob" required></label>
  <label>Password<input type="password" name="password1" required></label>
  <label>Retype Password<input type="password" name="password2" required></label>
  <input type="submit" value="Create Account">
</form>

<?php
    //if(!$IS_VALID) {
    //  print error message
    //}
?>
</body>
</html>

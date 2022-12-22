<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       create_account.php
    Purpose:        This file will serve as a page that allows a user to create
                    an account. If the input is invalid, an error message will
                    print. Passwords will be hashed so that they are not stored
                    in plain text.
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Account</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav><ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="sign_in.php">Sign In</a></li>
  <li><a href="create_account.php">Create Account</a></li>
</ul></nav>

<h1>Create an Account</h1>
<form action="create_account.php" method="post" id="account">
    <label>User Name: <input type="text" name="user" required autofocus> </label>
    <br>
    <label>Email: <input type="email" name="email" required></label>
    <br>
    <label>Date of birth: <input type="date" name="dob" required></label>
    <br>
    <label>Password: <input type="password" name="password1" required></label>
    <br>
    <label>Retype Password: <input type="password" name="password2" required></label>
    <br>
    <input type="submit" value="Create Account">
</form>
<?php
    require_once("functions.php");
    $mismatchPasswords = false;
    $failToInsert = false;

    if (isset($_POST['user'])
        && isset($_POST['email'])
        && isset($_POST['dob'])
        && isset($_POST['password1'])) {

        $username = htmlspecialchars(filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
        $dateOfBirth = htmlspecialchars(filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_SPECIAL_CHARS));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS));
        $retypedPassword = htmlspecialchars(filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS));

        if($password === $retypedPassword) {
            $hashedPassword = password_hash($password, NULL);
            $status = insertUserRecord($username, $email, $dateOfBirth, $hashedPassword);
            if($status === FALSE) {
                print "<pre>Invalid Input: Usernames and emails must be unique.</pre>";
            }
            else {
                header("Location: sign_in.php");
                exit();
            }
        }
        else {
            print "<pre>Invalid Input: The passwords must match.</pre>";
        }//end else
    }//end if
?>
</body>
</html>

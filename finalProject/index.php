<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       index.php
    Purpose:        This file serves as the homepage and will display the
                    username and appropriate links if the user is logged in. If
                    the user is not logged it, it will print a message to log in
                    and show the links to sign in or create an account.
*/
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    //Show the options to go to the home page, view all sims, create a sim,
    //or log out if a user is logged in
    if(isset($_SESSION['username'])) {
        print "<nav><ul>";
        print "<li><a href=\"index.php\">Home</a></li>";
        print "<li><a href=\"my_characters.php\">My Sims</a></li>";
        print "<li><a href=\"add_character.php\">Create Sim</a></li>";
        print "<li><a href=\"log_out.php\">Log Out</a></li>";
        print "</ul></nav>";
    }//end if
    //Show the options to go to the home page, sign in, or create an account
    //if a user is not logged in
    else {
        print "<nav><ul>";
        print "<li><a href=\"index.php\">Home</a></li>";
        print "<li><a href=\"sign_in.php\">Sign In</a></li>";
        print "<li><a href=\"create_account.php\"> Create Account</a></li>";
        print "</ul></nav>";
    }//end else

?>

<h1>Home</h1>

<?php
    //Print a welcome message to a logged in user
    if(isset($_SESSION['username'])) {
        print "<p>Welcome " . $_SESSION['username']["username"] . "!</p>";
        print "<p>Visit My Sims to view your Sims or Create Sim to create a Sim.</p>";
    }//end if
    //Instruct a user who is not logged in to log in or create an account
    else {
        print "<p>Please Sign In or Create an Account.</p>";
    }//end else
?>

</body>
</html>

<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       log_out.php
    Purpose:        This file will destroy the current session variables and log
                    the user out of the website. It will also redirect the user
                    to the homepage.
*/
    session_start();

    //Destroy the session variables
    session_unset();
    session_destroy();

    //Redirect to the home page
    header("Location: index.php");
    exit();
?>

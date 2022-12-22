<?php

//    Author:         Julia Moran
//    Major:          Computer Science
//    Creation Date:  November 17, 2022
//    Due Date:       November 28, 2022
//    Course:         CSC242 010
//    Professor Name: Dr. Schwesinger
//    Assignment:     #9
//    Filename:       log_out.php
//    Purpose:        This file will log the user out of the site and
//                    redirect to the home page.


// TODO destroy the session variables and redirect to the home page
    session_start();

    //Destroy the session variable
    session_unset();
    session_destroy();

    //Redirect to the home page
    header("Location: index.php");
    exit();
?>

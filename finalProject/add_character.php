<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 27, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       add_character.php
    Purpose:        This file serves as a page that allows a user to add a new
                    sim to the database. It will store the basic information
                    about the sim in the characters table and prepare the
                    details table by adding the user and character IDs to the
                    table and filling the rest of the table with placeholder
                    NULL values, which will be filled with actual values if the
                    user adds details to the sim.
*/

    session_start();
    //Include functions to be used
    require_once("character_functions.php");
    require_once("detail_functions.php");

    $invalidAge = false;
    $failedInsert = false;

    if (isset($_POST['firstName'])
        && isset($_POST['lastName'])
        && isset($_POST['pronouns'])
        && isset($_POST['age'])) {

        //Get the user id from the session variable
        $username = $_SESSION['username']["username"];

        //Get and filter the basic information about the new sim
        $firstName = htmlspecialchars(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS));
        $lastName = htmlspecialchars(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS));
        $pronouns = htmlspecialchars(filter_input(INPUT_POST, 'pronouns', FILTER_SANITIZE_SPECIAL_CHARS));
        $age = htmlspecialchars(filter_input(INPUT_POST, 'age', FILTER_SANITIZE_SPECIAL_CHARS));

        //Check if the selected age is valid
        if(in_array($age, ["infant", "toddler", "child", "teenager", "young adult", "adult", "elder"])) {
            //Add the basic sim information to the characters table
            $status = insertCharacter($username, $firstName, $lastName, $pronouns, $age);

            //Check if the sim was successfully added to the table
            if ($status === TRUE) {
                //Get the character id of the last sim added to the table
                $lastSim = getLastSim($username);

                //Add the user id and character id of the last sim added to the
                //table storing the sim's details
                if(insertDetails($username, $lastSim)) {
                    //Redirect to the page showing all sims
                    header("Location: my_characters.php");
                    exit();
                }//end if

                //Sim failed to be inserted to the details table
                else {
                    $failedInsert = true;
                }//end if
            }//end if

            //Sim failed to be inserted to the characters table
            else { 
                $failedInsert = true;
            }//end else
        }//end if
        else {
            $invalidAge = true;
        }//end else
    }//end if
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Sim</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="my_characters.php">My Sims</a></li>
        <li><a href="add_character.php">Create Sim</a></li>
        <li><a href="log_out.php">Log Out</a></li>
    </ul>
</nav>

<h1>Create a Sim</h1>
<form action="add_character.php" method="post">
    <label>First Name:<input type="text" name="firstName" required autofocus> </label>
    <label>Last Name:<input type="text" name="lastName" required> </label>
    <br>
    <label>Pronouns:<input type="text" name="pronouns" required></label>
    <label>Age:
    <select name="age">
        <option value="infant">Infant</option>
        <option value="toddler">Toddler</option>
        <option value="child">Child</option>
        <option value="teenager">Teenager</option>
        <option value="young adult">Young Adult</option>
        <option value="adult">Adult</option>
        <option value="elder">Elder</option>
    </select> 
    </label>
    <br>
    <input type="submit" value="Create Sim">
</form>

<?php 
    //Print an error message if the age is invalid
    if($invalidAge === true) {
        echo "<pre>Invalid Age.</pre>";
    }//end if

    //Print an error message if the sim failed to be added to the table
    if($failedInsert === true) {
        echo "<pre>Sim failed to be added. Please Try Again.</pre>";
    }//end if
?>

</body>
</html>

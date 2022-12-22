<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 27, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       view_sim.php
    Purpose:        This file serves as a page that displays all the information
                    about a selected sim, including any details. It will also
                    allow for the user to go to the page to view all of their
                    sims, edit the current sim, or delete the current sim.
*/

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Sim</title>
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

<form action = "view_sim.php" method = "post">
<?php
    require_once("character_functions.php");
    require_once("detail_functions.php");

    $db = new PDO("sqlite:user.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['sim'])) {
        //Get the sim to view
        $sim = explode(",", $_SESSION['sim'][0]);
        print "<h1>" . $sim[2] . " " . $sim[3] . "'s Information" . "</h1>";

        //Get the sim's basic information
        $simRecord = getOneCharacter($sim[0], $sim[1]);
        //Get the details about the sim
        $details = getDetails($sim[1]);

        //Print the sim's basic information as well as their details
        printCharacter($simRecord, $details);

        //Redirect to the appropriate page if a button is selected
        if(isset($_POST['choice'])) {
            //Redirect to the page to view all of the user's sims
            if($_POST['choice'] === "View All Sims") {
                header("Location: my_characters.php");
                exit();
            }//end if

            //Redirect to the page to edit the selected sim
            else if($_POST['choice'] === "Edit Sim") {
                header("Location: edit_character.php");
                exit();
            }//end else if

            //Redirect to the page to delete the selected sim
            else if($_POST['choice'] === "Delete Sim") {
                header("Location: delete_sim.php");
                exit();
            }//end else if
        }//end if
    }//end if
?>

    <input type="submit" name="choice" value="View All Sims">
    <input type="submit" name="choice" value="Edit Sim">
    <input type="submit" name="choice" value="Delete Sim">
</form>
</body>
</html>

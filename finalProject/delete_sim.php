<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 27, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       delete_sim.php
    Purpose:        This file serves as a page that will delete a sim and all
                    its data if the user confirms they would like to delete the
                    sim.
*/

    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Delete Sim</title>
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

<h1>Delete Sim</h1>

<form action = "delete_sim.php" method = "post">

<?php
$db = new PDO("sqlite:user.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once("table_functions.php");

if (isset($_SESSION['sim'])) {
    $sim = explode(",", $_SESSION['sim'][0]);

    //Print the sim to be deleted
    print "<p>Are you sure you want to delete " . $sim[2] . " " . $sim[3] . "'s data?</p>";
    
    if (isset($_POST["choice"])) {
        //Delete the sim if the user confirms they would like to delete them
        if($_POST['choice'] === "Yes") {
            //Delete the sim from the characters and details tables
            deleteSim("characters", $sim[1]);
            deleteSim("details", $sim[1]);
        }//end if

        //Redirect to the My Sims page
        header("Location: my_characters.php");
        exit();
    }//end if
}
?>
    <input type="submit" name="choice" value="Yes">
    <input type="submit" name="choice" value="Cancel">
</form>


</body>
</html>

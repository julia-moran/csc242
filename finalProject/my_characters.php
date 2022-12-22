<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       my_characters.php
    Purpose:        This file will serve as a page to display all of the sims
                    associated with the current user. It will also allow the
                    user to select a certain character and choose whether to
                    view, edit, or delete their data.
*/
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>My Sims</title>
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

<form action = "my_characters.php" method = "post">
<?php
    $db = new PDO("sqlite:user.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    require_once("character_functions.php");
    if(isset($_SESSION['username'])) {
        print "<h1>" . $_SESSION['username']["username"] . "'s Sims</h1>";

        //Get the sims associated with the currently logged in user
        $data = getUserCharacters($_SESSION['username']["username"]);

        //Check if there are sims to display on this page
        if(!empty($data)) {
            print "<h3>Select a Sim to view, edit, or delete them.</h3>";
            //Print the user's sims
            printEditCharacter($data);

            //Show the buttons to view, edit, or delete sims if there are sims avaliable
            echo "<input type=\"submit\" name=\"choice\" value=\"View\">";
            echo "<input type=\"submit\" name=\"choice\" value=\"Edit\">";
            echo "<input type=\"submit\" name=\"choice\" value=\"Delete\">";
        }//end if
        else {
            print "<h3>Create a Sim to see them displayed here.</h3>";
        }//end else
    }//end if

    if(isset($_POST['choice'])) {
        //Store the selected sim
        $_SESSION['sim'] = $_POST['rows'];

        //Redirect to the appropriate page
        if(!empty($_SESSION['sim'])) {

            //Redirect to the page to view the selected sim
            if($_POST['choice'] === "View") {
                header("Location: view_sim.php");
                exit();
            }//end if

            //Redirect to the page to edit the selected sim
            else if($_POST['choice'] === "Edit") {
                header("Location: edit_character.php");
                exit();
            }//end else if

            //Redirect to the page to delete the selected sim
            else if($_POST['choice'] === "Delete") {
                header("Location: delete_sim.php");
                exit();
            }//end else if
        }//end if
    }//end if
?>
</form>

</body>
</html>

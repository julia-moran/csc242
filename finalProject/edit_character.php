<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 30, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       edit_character.php
    Purpose:        This file serves as a page that allows the user to edit
                    the selected sim's basic and detailed information. The
                    current information will be displayed as placeholders so
                    that it is not edited when no changes by the user are made.
*/

    session_start();
    require_once("table_functions.php");
    require_once("detail_functions.php");

    if (isset($_SESSION['sim'])) {
        //Get the basic information about the sim
        $sim = explode(",", $_SESSION['sim'][0]);
        //Get the details about the selected sim
        $details = getDetails($sim[1]);

        if (isset($_POST["submit"])) {
            $basicInfo = ["first_name", "last_name", "pronouns", "age"];
            $detailedInfo = ["lifestate", "aspiration", "more_details"];
    
            //Update the basic info when edited
            foreach ($basicInfo as $column) {
                if(!empty($_POST[$column])) {
                    $toUpdate = filter_input(INPUT_POST, $column, FILTER_SANITIZE_SPECIAL_CHARS);
                    $toUpdate = htmlspecialchars($toUpdate);
                    updateTable("characters", $column, $toUpdate, $sim[0], $sim[1]);
                }//end if
            }//end foreach

            //Update the details about the sim when edited
            foreach ($detailedInfo as $detailColumn) {
                if(!empty($_POST[$detailColumn])) {
                    $toUpdate = filter_input(INPUT_POST, $detailColumn, FILTER_SANITIZE_SPECIAL_CHARS);
                    $toUpdate = htmlspecialchars($toUpdate);
                    updateTable("details", $detailColumn, $toUpdate, $sim[0], $sim[1]);
                }//end if
            }//end foreach
 
            //Turn the traits selected into a string that can be inserted to the table
            $traits = implode(", ", $_POST['traits']);

            //Update the detail table with the selected traits
            updateTable("details", "traits", $traits, $sim[0], $sim[1]);

            //Redirect to the page to view all of the user's sims
            header("Location:my_characters.php");
            exit();
        }//end if
    }//end if
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Sim</title>
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

<h1>Edit Sim</h1>
<form action="edit_character.php" method="post">


    <label>First Name:<input type="text" name="first_name" placeholder= "<?php if (isset($sim[2])) { echo $sim[2]; } ?>" > </label>
    <label>Last Name:<input type="text" name="last_name" placeholder= "<?php if (isset($sim[3])) { echo $sim[3]; } ?>" > </label>
    <br>
    <label>Pronouns:<input type="text" name="pronouns" placeholder= "<?php if (isset($sim[4])) { echo $sim[4]; } ?>" > </label>
    <label>Age:
    <select name="age">
        <option value="infant" <?php echo (isset($sim[5])) && ($sim[5] === "infant") ? "selected" : "" ?> >Infant</option>
        <option value="toddler" <?php echo (isset($sim[5])) && ($sim[5] === "toddler") ? "selected" : "" ?> >Toddler</option>
        <option value="child" <?php echo (isset($sim[5])) && ($sim[5] === "child") ? "selected" : "" ?> >Child</option>
        <option value="teenager" <?php echo (isset($sim[5])) && ($sim[5] === "teenager") ? "selected" : "" ?> >Teenager</option>
        <option value="young adult" <?php echo (isset($sim[5])) && ($sim[5] === "young adult") ? "selected" : "" ?> >Young Adult</option>
        <option value="adult" <?php if((!empty($sim[5])) && ($sim[5] === "adult")) { echo "selected= \"selected\""; } ?> >Adult</option>
        <option value="elder" <?php echo (isset($sim[5])) && ($sim[5] === "elder") ? "selected" : "" ?> >Elder</option>
    </select>
    </label>
    <br>
    <label>Life State:
    <select name="lifestate">
        <option value="normal" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "normal") ? "selected" : "" ?> >Normal Sim</option>
        <option value="alien" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "alien") ? "selected" : "" ?> >Alien</option>
        <option value="ghost" <?php echo (isset($details['lifestate'])) && ($details['lifestate'] === "ghost") ? "selected" : "" ?> >Ghost</option>
        <option value="mermaid" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "mermaid") ? "selected" : "" ?> >Mermaid</option>
        <option value="spellcaster" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "spellcaster") ? "selected" : "" ?> >Spellcaster</option>
        <option value="vampire" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "vampire") ? "selected" : "" ?> >Vampire</option>
        <option value="werewolf" <?php echo (isset($details["lifestate"])) && ($details["lifestate"] === "werewolf") ? "selected" : "" ?> >Werewolf</option>
    </select>
    </label>    

    <?php
        //Display possible aspirations if the sim is older than a toddler
        if(isset($sim[5]) && ($sim[5] !== "infant") && ($sim[5] !== "toddler")) {        
            echo "<label>Aspiration:";
            echo "<select name=\"aspiration\" id=\"aspiration\">";

            //Display possible aspirations for children if the sim is a child
            if(isset($sim[5]) && ($sim[5] === "child")) {
                $aspirationOptions = ["None", "Artistic Prodigy", "Rambunctious Scamp", "Social Butterfly", "Whiz Kid"];
            }//end if
            //Display possible aspirations for teenagers and older if the sim
            //is older than a child
            else if(isset($sim[5])) {
                $aspirationOptions = [
                    "None", "Body Builder", "Painter Extraordinare", "Musical Genius", "Bestselling Author","Public Enemy", "Chief of Mischief",
                    "Successful Lineage", "Big Happy Family", "Master Chef", "Fabulously Wealthy", "Mansion Baron", "Renaissance Sim",
                    "Nerd Brain", "Computer Whiz", "Serial Romantic", "Soulmate", "Freelance Botanist", "The Curator", "The Angling Ace",
                    "Joke Star", "Party Animal", "Friend to the World"];
            }//end else if

            //Have the current aspiration for the sim selected if it is set
            foreach ($aspirationOptions as $option) {
                echo "<option value=\"" . $option . "\""; 
                if ((isset($details["aspiration"])) && ($details["aspiration"] === $option)) {
                    echo "selected";
                }//end if
                echo ">" . $option . "</option>";
            }//end foreach

            echo "</select>";
            echo "</label>";
        }//end if
    ?>
    <br>
    <label>Traits:</label>
    <?php
        $allTraits = [
            "Active", "Ambitious", "Art-Lover", "Bookworm", "Bro", "Cheerful", "Childish",
            "Clumsy", "Creative", "Evil", "Family-Oriented", "Foodie", "Geek", "Genius",
            "Gloomy", "Glutton", "Good", "Goofball", "Hot-Headed", 
            "Insane", "Jealous", "Lazy", "Loner", "Outdoorsy", "Materialistic",
            "Mean", "Music-Lover", "Neat", "Noncommital", "Outgoing", "Perfectionist",
            "Romantic", "Self-Assured", "Slob", "Snob"];

        $traitCounter = 0;
        echo "<table class=\"traitTable\">";
        echo "<tr>";

        //Print each trait
        foreach($allTraits as $allTrait) {
            //Get the traits from the detail table and store them in an array
            if(isset($details["traits"])) {
                $traitsFromTable = explode(", ", $details["traits"]);
            }//end if

            $found = false;
            //Check if the sim has the current trait
            if(isset($details["traits"])) {
                foreach($traitsFromTable as $traitFromTable) {
                    if($traitFromTable === $allTrait) { $found = true; }
                }//end foreach
            }//end if
            //Display each checkbox            
            echo "<td><label class=\"checkboxLabel\">" . $allTrait . "</label></td>";
            echo "<td><input type=\"checkbox\" name=\"traits[]\" ";
            echo "value=" . $allTrait;
            //Check the current checkbox if the sim already has that trait
            if($found === true) { echo " checked"; }
            echo "></td>";

            //Display every five traits on a seperate row
            $traitCounter++;
            if($traitCounter % 5 === 0) {
                //$traitCounter;
                echo "</tr>";
                if($traitCounter < 35) {
                    echo "<tr>";
                }
            }//end if
        }//end foreach
        echo "</table>";

        ?>
   
    <br>
    <label>More Info:</label><br>
        <textarea name="more_details" placeholder="<?php if (isset($details["more_details"])) { echo $details["more_details"]; } ?>"></textarea>
    <br>
    <input type="submit" name= "submit" value="Apply Changes">
</form>

</body>
</html>

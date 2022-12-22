<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  December 2, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       detail_functions.php
    Purpose:        This file provides various functions related to the details
                    of sims. The details for each sim can be inserted to the
                    details table and retrieved. In addition, the last sim's ID
                    added to the table can be retrieved in order to insert that
                    ID to the details table.
*/
/*
    Function Name:  getLastSim
    Description:    Gets the character ID for the last sim entered in the
                    characters table.
    Parameters:     $username(string) - the current user's ID
    Return Value:   $data["max(character_id)"] - the character ID for the last
                                                 sim created
                    NULL - returned on an error
*/
function getLastSim($username) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Select the last sim added to the characters table
        $sql = "SELECT max(character_id)
                FROM characters
                WHERE user_id = ?";
        $select = $db->prepare($sql);
        $select->execute([$username]);
        $data = $select->fetch();
        return $data["max(character_id)"];
    }//end try
    //Catch errors that may arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return NULL;
    }//end catch
}//end getLastSim

/*
    Function Name:  insertDetails
    Description:    Inserts the user and character IDs of the sim to the details
                    table to prepare it for the user's addition of details
    Parameters:     $username(string) - current user's ID
                    $character(int) - character ID of last sim created
    Return Value:   (bool): TRUE - the character and username were successfully
                                   added to the table
                            FALSE - an error occured
*/
function insertDetails($username, $character) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Attempt to insert the sim into the details table
        $sql = "INSERT INTO details
                VALUES (?, ?, ?, ?, ?, ?)";
        $insert = $db->prepare($sql);

        //Set all the details to NULL to start
        $insert->execute([$username, $character, NULL, NULL, NULL, NULL]);
        return TRUE;
    }//end try
    //Catch errors that may arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }//end catch
}//end insertDetails

/*
    Function Name:  getDetails
    Description:    Retrieves the details about the specified sim
    Parameters:     $character(string) - the ID of the specified sim
    Return Value:   (array): $data[0] - the row in the details table about the
                                        specified sim
                           : NULL - an error occured
*/
function getDetails($character) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Select the details about the current sim
        $sql = "SELECT *
                FROM details
                WHERE character_id = ?";
        $select = $db->prepare($sql);
        $select->execute([$character]);
        $data = $select->fetchall(PDO::FETCH_ASSOC);
        return $data[0];
    }//end try
    //Catch errors that may arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return array();
    }//end catch
}//end function getDetails
?>

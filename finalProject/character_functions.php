<?php 
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       character_functions.php
    Purpose:        This file provides functions related to sims' basic
                    information, which is stored in the characters table in the
                    database. These functions allow for sims to be added to and
                    retrieved from the table and allow for the data about the
                    sims to be printed
*/

session_start();
/*
    Function Name:  insertCharacter
    Description:    Attempts to add a sim to the characters table in the 
                    database
    Parameters:     $username(string) - user ID of the current user
                    $firstName(string) - first name of the sim
                    $lastName(string) - last name of the sim
                    $pronouns(string) - the sim's prounouns
                    $age(string) - the age of the sim
    Return Value:   (bool): TRUE - If the sim was successfully added to the
                                   database
                          : FALSE - If an error occurred
*/
function insertCharacter($username, $firstName, $lastName, $pronouns, $age) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Attempt to insert the new sim to the table
        $sql = "INSERT INTO characters 
                VALUES (?, ?, ?, ?, ?, ?)";
        $insert = $db->prepare($sql);
        $insert->execute([$username, NULL, $firstName, $lastName, $pronouns, $age]);
        return TRUE;
    }//end try
    //Catch errors that arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }//end catch
}//end function insertCharacter

/*
    Function Name:  getUserCharacters
    Description:    Get all the sims associated with the current user
    Parameters:     $username(string) - The user ID of the current user
    Return Value:   (array): $data - The data for all the sims associated with
                                     the user
                           : An empty array if an error occured   
*/
function getUserCharacters($username) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Select the data for all of the user's sims
        $sql = "SELECT *
                FROM characters
                WHERE user_id = ?";
        $select = $db->prepare($sql);
        $select->execute([$username]);
        $data = $select->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }//end try
    //Catch errors that arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return array();
    }//end catch
}//end function getUserCharacters

/*
    Function Name:  getOneCharacter
    Description:    Get the basic information about a sim from the database
    Parameters:     $username(string) - The current user's username
                    $character(string) - The sim's unique character ID
    Return Value:   (array): $data[0] - Array of basic information about the
                                        sim if it was successfully retrieved
                           : An empty array if the sim's information was not
                             retrieved
*/
function getOneCharacter($username, $character) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Select the data for the current sim
        $sql = "SELECT *
                FROM characters
                WHERE user_id = ? 
                AND character_id = ?";
        $select = $db->prepare($sql);
        $select->execute([$username, $character]);
        $data = $select->fetchall(PDO::FETCH_ASSOC);
        return $data[0];
    }//end try
    //Catch errors that arise
    catch (Exception $e) {
        print "<p>$e</p>";
        return array();
    }//end catch
}//end function getOneCharacter

/*
    Function Name:  printCharacter
    Description:    Prints the basic and detailed information about the sim
    Parameters:     $basicData(array) - array containing the basic information
                                        about the current sim
                    $details(array) - array containing details about the
                                      current sim
    Return Value:   N/A
*/
function printCharacter($basicData, $details) {
    print "<dl>";

    //Print the basic information about the sim
    foreach(array_slice($basicData, 4) as $key => $value) {
        print "<dt>" . ucfirst($key) . ":</dt>"; 
        print "<dd>" . ucfirst($value) . "</dd>";
    }//end foreach

    //Print the details about the selected sim
    foreach(array_slice($details, 2) as $key => $value) {
        if(!empty($value)) {
            print "<dt>";
            print ($key != "more_details") ? ucfirst($key) : "More Details";
            print ":</dt>";
            print "<dd>" . ucfirst($value) . "</dd>";
        }//end if
    }//end foreach
    print "</dl>";
}//end function printCharacter

/*
    Function Name:  printEditCharacter
    Description:    Prints the user's sims in a table that allows for a sim
                    to be selected
    Parameters:     $data(array) - The data holding all of the user's sims
    Return Value:   (bool) - False if there are no sims associated with the
                             user
                             True if there are sims associated with the user  
*/
function printEditCharacter($data) {
    if (count($data) === 0) {
        return false;
    }//end if

    //Set the header
    $header = ["First Name", "Last Name", "Pronouns", "Age"];

    print "<table class=\"simTable\">\n";
    print "<tr>";
    print "<th>Select</th>";

    //Print the header
    foreach ($header as $h) {
        print "<th>$h</th>";
    }//end foreach

    print "</tr>\n";

    foreach ($data as $record) {
        $values = array_values($record);
        $keys = array_keys($record);
        $form_value = implode(',', $values);
        print "<tr>";

        //Print the radio buttons to select a sim
        print "<td><input type=\"radio\" name=\"rows[]\" value=\"$form_value\"></td>";

        //Print the basic information about each sim, excluding the user ID
        //and character ID
        foreach($record as $key => $values) {
            if ($key != "user_id" && $key != "character_id") {
                print "<td>$values</td>";
            }//end if
        }//end foreach

        print "</tr>\n";
    }//end foreach
    print "</table>";

    return true;
}//end function printEditCharacter

?>

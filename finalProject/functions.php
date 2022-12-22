<?php
//  SOURCE CITED:
/*
    Author:         Dr. Schwesinger
    Filename:       functions.php
    Retrieved Date: November 21, 2022
    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project9-handout/functions.php
    Note:           All content was authored by Dr. Schwesinger.
*/
/*
    Retrieved by:   Julia Moran
    Major:          Computer Science
    Retrieved Date: November 21, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       functions.php
    Purpose:        This file provides functions that allow for a user to be
                    added to and retrieved from the database.
*/

/*  Citation Source: This file was retrieved from Dr. Schwesinger's acad public
    directory at schwesin/csc242/projects/project9-handout/functions.php. It
    was created for Assignment 9 for the Fall 2022 CSC 242 class. All content
    was authored by Dr. Schwesinger. */

/* Function Name: insertUserRecord
 * Description: insert user information into the database
 * Parameters: (string) $name: the user's name
 *             (string) $email: the user's email
 *             (string) $dob: the user's date of birth
 *             (string) $password: the user's password
 * Return Value: (boolean) TRUE if the information was successfully inserted,
 *               otherwise FALSE
 */
function insertUserRecord($name, $email, $dob, $password) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Attempt to insert the new account to the database        
        $sql = "INSERT INTO user VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $email, $dob, $password]);
        return TRUE;
    }//end try

    //Return FALSE if an error occured
    catch (Exception $e) {
        //DEBUGGING
        //print "<p>$e</p>";
        return FALSE;
    }//end catch
}//end function insertUserRecord

/* Function Name: getUserRecord
 * Description: get user information from the database
 * Parameters: (string) $email: the user's email
 *             (string) $password: the user's password
 * Return Value: (array) The user's record if it exists, otherwise an empty
 *               array
 */
function getUserRecord($email) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Attempt to select the record for the inputted email
        $sql = "SELECT * 
                FROM user
                WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
        print "<p>$e</p>";
        //Return an empty array if the email was not found in the database
        return array();
    }//end catch
}//end function getUserRecord
?>

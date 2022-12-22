<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  December 13, 2022
    Due Date:       December 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #10
    Filename:       table_functions.php
    Purpose:        This file provides various functions that allow for both the
                    characters table and details table to be updated or deleted. 
*/

/*
    Function Name:  updateTable
    Description:    Updates the table with a new value
    Parameters:     $table(string) - name of the table to update
                    $column(string) - name of the column to update
                    $value(string) - value to update the previous value with
                    $username(string) - the current user's user ID
                    $simID(int) - the sim to update's ID
    Return Value:   (bool): TRUE - if the table was successfully updated
                          : FALSE - if an error occured
*/
function updateTable($table, $column, $value, $username, $simID) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Update the table with the new value
        $sql = "UPDATE " . $table .
                " SET " . $column . " = ?
                WHERE user_id = ?
                AND character_id = ?";
        $update = $db->prepare($sql);
        $update->execute([$value, $username, $simID]);
        return TRUE;
    }//end catch

    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }//end catch
}//end function updateTable

/*
    Function Name:  deleteSim
    Description:    Deletes the sim's data from the specified table
    Parameters:     $table(string) - name of the table to delete from
                    $character_id(int) - the sim to delete's ID
    Return Value:   (bool): TRUE - if the sim was successfully deleted
                          : FALSE - if an error occured
*/
function deleteSim($table, $character_id) {
    try {
        $db =  new PDO("sqlite:user.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM " . $table .
               " WHERE character_id = ?";

        $delete = $db->prepare($sql);
        $delete->execute([$character_id]);
        return TRUE;
    }//end try

    catch (Exception $e) {
        print "<p>$e</p>";
        return FALSE;
    }//end catch
}
?>

<!DOCTYPE html>
<!--
    Updated by:     Julia Moran
    Major:          Computer Science
    Creation Date:  November 10, 2022
    Due Date:       November 17, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #8
    Filename:       index.php
    Purpose:        This program will allow a user to insert new rows of data into
                    a database of users, update the passwords of selected users,
                    and delete selected users.


    Source Cited:

    Author:         Dr. Schwesinger
    Filename:       index.php
    Retrieved Date: November 10, 2022
    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project8-handout/index.php
    Note:           All content except for the code to insert, update, and delete
                    was authored by Dr. Schwesinger. 
-->

<html lang=en>
  <head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include "nav.html" ?>
    <h1>List of Users</h1>
<?php
require_once("functions.php");

// open a database connection
$db = new PDO("sqlite:user.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];

    // INSERT
    if ($operation === 'create'
        && isset($_POST['name'])
        && isset($_POST['email'])
        && isset($_POST['dob'])
        && isset($_POST['password'])
    ){
        // TODO INSERT a record with a prepared statement

        //Store the information inputed by the user in variables
        $addedName = $_POST['name'];
        $addedEmail = $_POST['email'];
        $addedDOB = $_POST['dob'];
        $addedPassword = $_POST['password'];

        //Insert the inputted information to the database
        $sql = "INSERT INTO user (name, email, dob, password)
                VALUES (?, ?, ?, ?)";

        $insert = $db->prepare($sql);
        
        $insert->execute([$addedName, $addedEmail, $addedDOB, $addedPassword]);

    }//end if
    // UPDATE
    else if ($operation === 'update'
        && isset($_POST['password'])
        && isset($_POST['rows'])
    ){
        // TODO UPDATE a record with a prepared statement
        
        //Split the information in the selected row to an array
        foreach($_POST['rows'] as $row) {
            //Split the information in the selected row to an array
            $row = explode(",", $row);

            //Store the new password inputed by the user in a variable
            $newPassword = $_POST['password'];

            //Update the selected record to have the new password
            $sql = "UPDATE user
                    SET password = ?
                    WHERE name = ?
                    AND email = ?
                    AND dob = ?
                    AND password = ?";

            $update = $db->prepare($sql);

            $update->execute([$newPassword, $row[0], $row[1], $row[2], $row[3]]);
        }//end foreach
    }
    // DELETE
    else if ($operation === 'delete' && isset($_POST['rows'])){
        // TODO DELETE a record with a prepared statement

        foreach($_POST['rows'] as $row) {
            //Split the information in the selected row to an array
            $row = explode(",", $row);

            //Delete the selected row from the database
            $sql = "DELETE FROM user
                    WHERE name = ?
                    AND email = ?
                    AND dob = ?
                    AND password = ?";

            $delete = $db->prepare($sql);
            $delete->execute([$row[0], $row[1], $row[2], $row[3]]);       
        }//end foreach
    }//end else if
}

$stmt = $db->query("select * from user order by name");
$records = $stmt->fetchall(PDO::FETCH_ASSOC);
printTable($records);
$db = null;
?>

  </body>
</html>

<!DOCTYPE html>
<!--
    Updated by:     Julia Moran
    Major:          Computer Science
    Creation Date:  November 10, 2022
    Due Date:       November 17, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #8
    Filename:       search.php
    Purpose:        This program will allow a user to search from the database
                    of users and will print the data matching the user's
                    search


    Source Cited:

    Author:         Dr. Schwesinger
    Filename:       search.php
    Retrieved Date: November 10, 2022
    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project8-handout/search.php
    Note:           All content except for the code to insert, update, and delete
                    was authored by Dr. Schwesinger.
-->

<html lang=en>
  <head>
    <title>Search</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
<?php include "nav.html" ?>

<?php
$s_name = isset($_GET['category']) && $_GET['category'] === 'name';
$s_email = isset($_GET['category']) && $_GET['category'] === 'email';
$s_dob = isset($_GET['category']) && $_GET['category'] === 'dob';
$s_password = isset($_GET['category']) && $_GET['category'] === 'password';
?>
  <h1>Search</h1>
  <form action="search.php" method="get">
    <label>Category:
      <select name="category">
        <option value="name" <?php print $s_name ? "selected" : ""; ?> >Name</option>
        <option value="email" <?php print $s_email ? "selected" : ""; ?> >Email</option>
        <option value="dob" <?php print $s_dob ? "selected" : ""; ?> >Date of birth</option>
        <option value="password" <?php print $s_password ? "selected" : ""; ?> >Password</option>
      </select>
    </label>
    <label>Term: <input type="text" name="term"></label>
    <input type="submit">
  </form>
<?php
require_once("functions.php");

if (isset($_GET['category']) && isset($_GET['term'])) {
    // TODO SELECT the appropriate records in ascending order of user name

    //Store the user's choice of category and term in variables
    $category = $_GET['category'];
    $term = $_GET['term'];

    //Connect to the database
    $db = new PDO("sqlite:user.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Search for and select the records matching the user's search
    $sql = "SELECT *
            FROM user
            WHERE $category = ?
            ORDER BY name asc";

    $search = $db->prepare($sql);

    $search->execute([$term]);

    //Get the records matching the user's search
    $records = $search->fetchall(PDO::FETCH_ASSOC);


    print "<h2>Users where $category =  $term</h2>";
    // TODO print the table
    printTable($records);

    //Disconnect from the database
    $db = null;
}//end if

?>
  </body>
</html>

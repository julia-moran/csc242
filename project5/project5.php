<!DOCTYPE html>
<!--
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  October 25, 2022
    Due Date:       October 27, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #5
    Filename:       project5.php
    Purpose:        This program will read a .csv file with animal data
                    containing the animal names, classes, statuses, and totals.
                    Depending on the user's choice, it will print the data of
                    animals matching the user's choice of class or status.
-->

<html lang="en">
<head>
  <title>Animals</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Zoo Information</h1>

<form action="project5.php" method="get">
  <select name="type">
    <option value="class">Class</option>
    <option value="status">Status</option>
  </select>
  <input type="text" name="term">
  <input type="submit" value="Search">
</form>

<?php
// TODO print table or error message
    /*
        Function Name:  readFromFile
        Description:    Reads the contents of the animal file to an array
        Parameters:     N/A
        Return Value:   $animals(array) - array of animal data from the file
    */
    function readFromFile() : array {
        //Read the data from the file to an array
        $dataFromFile = file("animals.csv");

        //Explode the data from the file on the comma to an array of arrays
        foreach($dataFromFile as $key => $value) {
            $animals[$key] = explode(",", $value);
        }//end foreach

        return $animals;
    }//end function readFromFile

    /*
        Function Name:  printHeader
        Description:    Prints the first row of data from the animal file as
                        the header of the table
        Parameters:     $animals(array) - array of animal data
        Return Value:   N/A
    */
    function printHeader($animals) {
        print "<table>";
        print "<tr>";

        //Print the first element in the animal array as the header
        foreach($animals[0] as $header) {
            print "<th>" . $header . "</th>";
        }//end foreach

        print "</tr>";
    }//end function printHeader

    /*
        Function Name:  printTableData
        Description:    Prints the data in the array to a table
        Parameters:     $tableData(array) - array of data to be printed to a
                                            table
        Return Value:   N/A
    */
    function printTableData($tableData) {
        foreach($tableData as $row) {
            print "<tr>";

            //Print the data in the array to a table
            foreach($row as $element) {
                print "<td>" . $element . "</td>";
            }//end foreach

            print "</tr>";
        }//end foreach

        print "</table>";
    }//end function printTableData

    /*
        Function Name:  printOptions
        Description:    Print avaliable options when invalid input is entered
        Parameters:     $animals(array) - array of animal data
                        $index(int) - key value in the array within the animal
                                      array to get the options from
        Return Value:   N/A
    */
    function printOptions($animals, $index) {
        $options = array();

        //Make an array of the avaliable options for the selected type
        foreach($animals as $animal) {
            foreach($animal as $key => $value) {
                $options[] = $animal[$index];
            }//end foreach
        }//end foreach

        //Remove the repeated values in the options
        $options = array_unique($options);

        //Remove the first element in the options array, which will be the
        //header
        array_shift($options);

        print "<ul>";

        //Print the avaliable options as a list
        foreach($options as $elem) {
            print "<li>" . $elem . "</li>";
        }//end foreach

        print "</ul>";
    }//end function printOptions

    /*
        Function Name:  findTerm
        Description:    Find the terms in the selected option with the same
                        value as the searched term and return a sorted array
                        made of those terms
        Parameters:     $animals(array) - array of animal data from the file
                        $index(int) - key value in the animal array to search
                                      from
        Return Value:   $optionArray(array) - array containing the animals with
                                              the same value as the searched
                                              term
    */
    function findTerms($animals, $index) : array {
        $optionArray = array();

        //Get the term to search from the user
        if(!empty($_GET["term"])) {
            $searchTerm = $_GET["term"];

            //Create an array made of animals that have values matching the
            //searched term
            $optionArray = $animals;
            $optionArray = array_filter($optionArray, fn($animal) => $animal[$index] == $searchTerm);

            //Sort the data in the array
            $optionArray = sortData($optionArray);
        }//end if

        return $optionArray;
    }//end function findTerm

    /*
        Function Name:  sortData
        Description:    Sort the animals in the array first by total then by
                        name in alphabetical order
        Parameters:     $optionArray(array) - array of animals with values
                                              matching the searched term
        Return Value:   $optionArray(array) - array of animals with values
                                              matching the searched term
                                              after being sorted
    */
    function sortData($optionArray) : array {
        //Sort the animals by their totals
        usort($optionArray, myCompare);

        return $optionArray;
    }//end function sortData

    /*
        Function Name:  myCompare
        Description:    The comparison function to sort the animals by total
                        and name
        Parameters:     $element1(string) - the first element to compare, will
                                            be casted to an integer when
                                            sorting the totals
                        $element2(string) - second element to compare, will be
                                            casted to an integer when sorting
                                            the totals
        Return Value:   $result(int) - the result found when comparing the
                                       elements
    */
    function myCompare($element1, $element2) {
        //Compare the totals
        $result = (int)$element2[3] - (int)$element1[3];

        //If the totals are the same, compare the name
        if ($result === 0) {
            $result = strcmp($element1[0], $element2[0]);
        }//end if

        return $result;
    }//end function myCompare

    /*
        Function Name:  printOutput
        Description:    Prints the array of animals with values matching the
                        searched term or an error message if the input is
                        invalid
        Parameters:     $animals(array) - array of animals from the data file
                        $typename(string) - name of the selected option
                        $index(int) - key value in the animal array to print
                                      from
                        $optionArray(array) - array of animals with values
                                              matching the searched term
        Return Value:   N/A
    */
    function printOutput($animals, $typeName, $index, $optionArray) {
        //The case of valid user input
        if(!empty($optionArray)) {
            //Print the table's header
            printHeader($animals);

            //Print the data of the table
            printTableData($optionArray);
        }//end if

        //The case of invalid user input
        if(empty($_GET["term"]) || empty($optionArray)) {
            //Print error message
            print "<p>Error: Please choose one of the avaliable " . $typeName . "</p>";

            //Print avaliable options for the selected type
            printOptions($animals, $index);
        }//end if
    }//end function printOutput

    /*
        Function Name:  selectType
        Description:    Calls the appropriate functions based on whether the
                        user decides to search for classes or statuses
        Parameters:     $animals(array) - array of animal data from the file
        Return Value:   N/A
    */
    function selectType($animals) {
        //Get the selected type from the user
        if(isset($_GET["type"])) {
            $selection = $_GET["type"];

            //The case of the selection being class
            if($selection === "class") {
                //Create an array of animals that match the searched class
                $classArray = findTerms($animals, 1);

                //Print the output for the classes
                printOutput($animals, "classes", 1, $classArray);

            }//end if

            //The case of the selection being status
            if($selection === "status") {
                //Create an array of animals that match the searched status
                $statusArray = findTerms($animals, 2);

                //Print the output for the statuses
                printOutput($animals, "statuses", 2, $statusArray);
            }//end if
        }//end if
    }//end function selectType

    /*
        Function Name:  main
        Description:    Calls the function to read from the file and select
                        which type to operate on
        Parameters:     N/A
        Return Value:   N/A
    */
    function main() {
        //Read the data from the file
        $animals = readFromFile();

        //Select the type to operate on
        selectType($animals);
    }//end main

    //Call the main function
    main();

?>

</body>
</html>

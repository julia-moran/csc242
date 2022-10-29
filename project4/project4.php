<!DOCTYPE html>
<!--
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  October 13, 2022
    Due Date:       October 20, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #4
    Filename:       project4.php
    Purpose:        This program will read a .csv file with animal data inside
                    in and output the data to a table on a web page.


Julia Moran, CSC 242, Fall 2022, Assignment 4
-->

<!--
TODO:
* Add any required HTML elements that are missing
* Attach the style.css file
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 4 Animal Table</title>
        <link rel="stylesheet" href="newstyle.css">
    </head>
    <body>
    <?php
    /* TODO: PHP code to generate an HTML table from the file "animals.csv" */

        /*
            Function Name:  readFromFile
            Description:    Reads the contents of the animal file to an array
            Parameters:     N/A
            Return Value:   $animals(array) - array of animal data from the file
        */
        function readFromFile() : array {
            print "<table>";

            //Get the data from the animals.csv file
            $dataFromFile = file("animals.csv");

            //Format the data into an array of arrays, with each subarray
            //containing the data for one animal
            foreach($dataFromFile as $key => $value) {
                $animals[$key] = explode(",", $value);
            }//end foreach

            return $animals;
        }//end function readFromFile

        /*
            Function Name:  printHeader
            Description:    Prints the first row of data from the animal file
                            as the header of the table
            Parameters:     $animals(array) - array of animal data
            Return Value:   $animalsWithoutHeader(array) - array of animal data
                                                           after the header
                                                           is removed
        */
        function printHeader($animals) : array {
            print "<tr>";

            //Print the first row of the animal array as a header
            foreach($animals[0] as $header)
            {
                print "<th>". $header . "</th>";
            }//end foreach

            //Remove the header from the array so that only the data about the
            //animals remain
            array_shift($animals);
            print "</tr>";

            return $animals;
        }//end function printHeader

        /*
            Function Name:  printTableData
            Description:    Prints the data within the animals array as data in
                            an HTML table
            Parameters:     $animals(array) - array of animal data
            Return Value:   N/A
        */
        function printTableData($animals) {
            foreach($animals as $animal)
            {
                print "<tr>";

                //Print each animal's data as the data in the HTML table
                foreach($animal as $elem)
                {
                    print "<td>" . $elem . "</td>";
                }//end foreach

                print "</tr>";
            }//end foreach

        print "</table>";
        }//end printTableData

        /*
            Function Name:  main
            Description:    Calls the other functions
            Parameters:     N/A
            Return Value:   N/A
        */
        function main()
        {
            //Read the animal data from the file
            $animalsFromFile = readFromFile();

            //Print the header
            $animals = printHeader($animalsFromFile);

            //Print the rest of the table
            printTableData($animals);
        }//end main

        main();

    ?>
    </body>
</html>

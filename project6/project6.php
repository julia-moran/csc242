<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  October 28, 2022
    Due Date:       November 3, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #6
    Filename:       project6.php
    Purpose:        This program will read in a file about grade information for
                    students and produce a script that creates a SQL table.
*/

/*
    Function Name:  readToFile
    Description:    Reads the data file to an array
    Parameters:     $inputFile(string) - name of the file to read from
    Return Value:   $gradesArray(array) - the grade data from the file as an array
*/
function readToFile($inputFile) : array {
    $gradesArray = array();

    //Read the data from the file to an array
    $gradesArray = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    //Chunk the data into subarrays, where each subarray is each student
    $gradesArray = array_chunk($gradesArray, 8);

    return $gradesArray;
}//end function readToFile

/*
    Function Name:  createTable
    Description:    Writes the script for creating the SQL table
    Parameters:     $outputFile(string) - name of the file to write to
    Return Value:   $fout - file to write the data to
*/
function createTable($outputFile) {
    //Create the string that creates a SQL table
    $makeTable = "CREATE table grade_report (
    student_id TEXT,
    last_name TEXT,
    first_name TEXT,
    course TEXT,
    section TEXT,
    category TEXT,
    grade_item INTEGER,
    grade REAL
);\n\n";

    //Write the create statement to the SQL table script
    $fout = fopen($outputFile, "w");
    fwrite($fout, $makeTable);

    return $fout;
}//end function writeHeader

/*
    Function Name:  writeRows
    Description:    Writes the data to put in the rows of the SQL table
    Parameters:     $gradesArray(array) - array of grade data from the file
                    $fout - file to write the data to
    Return Value:   N/A
*/
function writeRows(array $gradesArray, $fout) {
    //Create an insert statement for each row as a string
    foreach($gradesArray as $student) {

        //Begin the string
        $insert = "INSERT INTO grade_report VALUES (";

        //Read each grade data item about each student into the string
        foreach($student as $key => $value) {
            if($key <= 5) {
                //Surround data meant to be read as strings with quotes     
                //and include a comma
                $insert .= "'" . $student[$key] . "', ";
            }//end if

            else if($key === 6) {
                //Put the data meant to be read as integers or floats in the
                //string without quotes and include a comma
                $insert .= $student[$key] . ", ";
            }//end else if

            else {
                //Put the last data item into the string without a comma
                $insert .= $student[$key];       
            }//end else
        }//end foreach   

        //End the string
        $insert .= ");\n";

        //Write each insert statment to the script
        fwrite($fout, $insert);
    }//end foreach
}//end function writeRows

/*
    Function Name:  main
    Description:    Calls the other functions in the program based on
                    the user's input
    Parameters:     N/A
    Return Value:   N/A
*/
function main() {
    //Get the input and output filenames from the user
    $fin = readline("Enter input filename: ");
    $fout = readline("Enter output filename: ");

    //Check if the file to read from exists
    if (file_exists($fin)) {
        //Write the contents of the file and the create table statement to
        //the SQL script
        writeRows(readToFile($fin), createTable($fout));
        
        print "SUCCESS: file $fout written\n";
    }//end if
    else {
        //Print an error message if the file to write from does not exist
        print "ERROR: file does not exist\n";
    }//end else
}//end main

main();

?>

<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  September 26, 2022
    Due Date:       September 30, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #3
    Filename:       project3.php
    Purpose:        This program will read in a file about animals, transform
                    that data, and write the transformed data to another file.
*/

/*
    Function Name:  readToFile
    Description:    Reads the contents of the animal file to an array
    Parameters:     $filename(array) - the name of the input file
    Return Value:   $animalData(array) - array of data from the file
*/
function readToFile($filename) : array {
    $animalData = array();

    //Read the file
    $contents = file_get_contents($filename); //file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    //Explode the data from the file to an array
    $animalData = explode("\r\n", $contents);

    //Pop the last element of the array off to remove the last newline
    //character that was read as an extra element of the animalData array
    array_pop($animalData);

    return $animalData;
}//end function readToFile

/*
    Function Name:  sumAnimalsInZoo
    Description:    Replaces the element with the numbers of each animal in
                    ten different zoos with the sum of those numbers, the total
                    population of each animal in the zoos
    Parameters:     $animalData(array) - the original array of data read from
                                         the file
    Return Value:   $animalData(array) - the array with the row containing the
                                         numbers of the animals at the zoos
                                         replaced with the sum of those numbers
                                         for each animal
*/
function sumAnimalsInZoo(array $animalData) : array {
    $numInZoo = array();

    //Sum up the numbers of the animals in the different zoos
    foreach ($animalData as $key => $value) {
        if(($key + 1) % 4 === 0) {
            //Seperate the numbers of each animal in the different zoos into a
            //new array
            $numInZoo = explode(" ", $animalData[$key]);

            //Sum up the values of the array containing the numbers of the
            //animal in the zoo
            $sumInZoo = array_sum($numInZoo);

            //Replace the numbers of the animal in the zoos with the summed total
            $animalData[$key] = $sumInZoo;
        }//end if
    }//end for

    return $animalData;
}//end function sumAnimalsInZoo

/*
    Function Name:  sortData
    Description:    Sorts the array of animal data from highest to lowest
                    population by chunking the data
    Parameters:     $animalData(array) - array of animal data
    Return Value:   N/A
*/
function sortData(array $animalData) : array {
    //Chunk the data into subarrays, where each subarray is each animal
    $chunkedData = array();
    $chunkedData = array_chunk($animalData, 4);

    //Sort the array by the population in descending order
    $sumsInZoo = array_column($chunkedData, 3);
    array_multisort($sumsInZoo, SORT_DESC, $chunkedData);

    return $chunkedData;
}//end function sortData

/*
    Function Name:  writeToFile
    Description:    Writes the final form of the data to a file with each line
                    containing the information of each animal seperated with
                    commas
    Parameters:     $dataToFile(array) - the data from the file, after being
                                         read, summed, sorted, and chunked
                                         together, that will be written to the
                                         output file
                    $fileout(string) - file that the data will be written to
    Return Value:   N/A
*/
function writeToFile(array $dataToFile, $fileout) {
    //Open the file to write to
    $fout = fopen($fileout, "w");

    //Write the header to the file
    fwrite($fout, "Animal,Class,Status,Total");

    //Write the data to the file
    foreach($dataToFile as $key => $value) {
        //Seperate the data for each animal with commas
        $implodedData = ("\n" . implode(",", $dataToFile[$key]));

        //Write the imploded data to the file
        fwrite($fout, $implodedData);
    }//end foreach
}//end function writeToFile


function main() {
    $fin = readline("Enter input filename: ");
    $fout = readline("Enter output filename: ");
    if (file_exists($fin)) {

        $animalsArray = readToFile($fin);
        $summedArray = sumAnimalsInZoo($animalsArray);
        $sortedArray = sortData($summedArray);
        writeToFile($sortedArray, $fout);

        print "SUCCESS: file $fout written\n";
    }
    else {
        print "ERROR: file does not exist\n";
    }
}

main();

?>

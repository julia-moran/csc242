<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  September 15, 2022
    Due Date:       September 22, 2022
    Updated Date:   September 27, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #2
    Filename:       project2.php
    Purpose:        This program takes an account number as an input and
                    determines if it is valid based on some calculations.
*/
//  SOURCE CITED:
/*
    Author:         Dr. Schwesinger
    Filename:       project2.php
    Retrieved Date: September 27, 2022
    Retrieved from: Dr. Schwesinger's acad public directory at schwesin/csc242/projects/project2-handout/project2.php
    Note:           The function toDigits was updated on September 27, 2022
                    after the assignment was due to be based on Dr. Schwesinger's
                    example since the original function written by Julia
                    Moran was incorrect. The original function incorrectly
                    converted the array of digits to a string instead of
                    maintaining the digits as integers. The current function
                    in this file is the corrected version based on Dr.
                    Schwesinger's example.
*/


main();

function main() {
    $input = readline("Enter an account number: ");
    $acct_num = filter_var($input, FILTER_VALIDATE_INT);

    if ($acct_num) {
        print validate($acct_num) ? "Valid\n" : "Invalid\n";
    }
    else {
        print "ERROR: input is not an integer\n";
    }
}

/*
    Function Name:  validate
    Description:    Calls the other functions that edit the inputted account
                    number and uses those functions to check if the account
                    number is valid.
    Parameters:     $acct_num(int) - the account number inputted by the user
    Return Value:   bool - true if the account number is valid
                           false otherwise
*/
function validate(int $acct_num) : bool {

    //Convert the account number to digits
    $digit_array = toDigits($acct_num);

    //Double every other digit
    $doubled_array = doubleEveryOther($digit_array);

    //Sum up the digits
    $sum_of_array = sumDigits($doubled_array);

    //Output if the account number is valid based on the sum
    if($sum_of_array % 10 === 0) {
        return true;
    }//end if

    else {
        return false;
    }//end else
}//end function validate

/*
    Function Name:  toDigits
    Description:    Converts the account number into an array of integers, with
                    each digit being an element in the array.
    Parameters:     $acct_num (int) - the account number inputted by the user
    Return Value:   $digit_array (array of ints) - the account number in array
                                                   form
*/
/*
    Citation Source: This function was based on Dr. Schwesinger's example in
    the acad public directory at schwesin/csc242/projects/project2-handout/project2.php.
    It was updated after this assignment was due on September 27, 2022 to the
    current corrected version based on Dr. Schwesinger's toDigits function
*/

function toDigits(int $acct_num) : array {
    $digit_array = array();

    do {
        array_unshift($digit_array, $acct_num % 10);
        $acct_num = intdiv($acct_num, 10);

    } while($acct_num != 0);

    return $digit_array;
}//end function toDigits

/*
    Function Name:  doubleEveryOther
    Description:    Doubles every other digit in the array, starting from the
                    right and continuing to the left.
    Parameters:     $digit_array (array of ints) - account number in array form
    Return Value:   $doubled_array (array of ints) - account number with every
                                                     other digit doubled
*/
function doubleEveryOther($digit_array) : array {
    //Start from the rightmost end of the array
    $digit_array = array_reverse($digit_array);

    $double_flag = 1;
    $doubled_array = array();

    foreach($digit_array as $key => $value) {

        //Double the digit every other time
        if($double_flag === -1) {
            $doubled_array[$key] = $digit_array[$key] * 2;
        }//end if
        else {
            $doubled_array[$key] = $digit_array[$key];
        }//end else

        //Multiply the flag by negative one each time so that every other
        //digit is doubled
        $double_flag *= -1;
    }//end foreach

    //Revert the array to its original order
    return(array_reverse($doubled_array));
}//end function doubleEveryOther

/*
    Function Name:  sumDigits
    Description:    Calculates the sum of the digits in the newly doubled
                    array by sending the array back to toDigits in order to
                    seperate integers in the array that are two digits long
    Parameters:     $doubled_array (array of ints) - account number with every
                                                     other digit doubled
   Return Value:    $sum_of_digits (int) - sum of digits in the doubled and
                                           modified array
*/
function sumDigits($doubled_array) : int {
    $sum_of_digits = 0;

    //Seperate the values of the array after doubling, including those that
    //are two digits long
    $doubled_array = toDigits(implode($doubled_array));

    //Add together the digits in the array
    $sum_of_digits = array_sum($doubled_array);

    return ($sum_of_digits);
}//end function sumDigits*/

?>

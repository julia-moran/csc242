<?php
/*
    Author:         Julia Moran
    Major:          Computer Science
    Creation Date:  September 8, 2022
    Due Date:       September 15, 2022
    Course:         CSC242 010
    Professor Name: Dr. Schwesinger
    Assignment:     #1
    Filename:       project1.php
    Purpose:        This program will accept a donor's and recipient's
                    blood type and determine if the two blood types are
                    compatible.
*/

//Get the user's input for the donor and recipient blood types
$donor_blood_type = readline("Enter the donor's blood type: \n");
$recipient_blood_type = readline("Enter the recipient's blood type: \n");

//Compare the donor blood type to the recipient blood type
switch ($donor_blood_type) {

    //The case the donor's blood type is O-
    case ("O-"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("O-"):
            case ("O+"):
            case ("A+"):
            case ("A-"):
            case ("B-"):
            case ("B+"):
            case ("AB-"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is O+
    case ("O+"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("O+"):
            case ("A+"):
            case ("B+"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("A-"):
            case ("B-"):
            case ("AB-"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is A-
    case ("A-"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("A-"):
            case ("A+"):
            case ("AB-"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("B-"):
            case ("B+"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is A+
    case ("A+"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("A+"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("A-"):
            case ("B-"):
            case ("B+"):
            case ("AB-"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is B-
    case ("B-"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("B-"):
            case ("B+"):
            case ("AB-"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("A-"):
            case ("A+"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is B+
    case ("B+"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("AB+"):
            case ("B+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("A-"):
            case ("A+"):
            case ("B-"):
            case ("AB-"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is AB-
    case ("AB-"):
        switch ($recipient_blood_type) {
            //Compatible blood types
            case ("AB-"):
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("A-"):
            case ("A+"):
            case ("B-"):
            case ("B+"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the donor's blood type is AB+
    case ("AB+"):
        switch ($recipient_blood_type) {
            //Compatible blood type
            case ("AB+"):
                print "Compatible\n";
                break;
            //Incompatible blood types
            case ("O-"):
            case ("O+"):
            case ("A-"):
            case ("A+"):
            case ("B-"):
            case ("B+"):
            case ("AB-"):
                print "Incompatible\n";
                break;
            //Invalid recipient input
            default:
                print "ERROR: invalid recipient blood type\n";
                break;
        }//end switch

        break;

    //The case the user's donor blood type is invalid
    default:
        print "ERROR: invalid donor blood type\n";
        break;
}//end switch

?>

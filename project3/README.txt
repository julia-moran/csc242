Assignment Instructions:
This file program has a main function that prompts the user for an input file name and an output file name; 
The program should have the following general outline:

    Read the contents of the input file (the main function checks if the file exists, so you do not need to check that.)
    Transform the data into a different format.
    Write the transformed data to the output file.

There is an input file named animals.dat included in the handout directory.
This file has four lines for; the lines of data will contain the following information, in this order:

    Common name
    Class (mammal, bird, fish, reptile, amphibian)
    Conservation status code
        EX: extinct
        EW: Extinct in the wild
        CR: critically endangered
        EN: endangered
        VU: vulnerable
        NT: near threatened
        LC: least concern
        DD: data deficient
        NE: not evaluated
    Number of the animal at ten different zoos, each number separated by a space.

The expected output file format is as follows:
    The first line of the file must be:
    
    Animal,Class,Status,Total
    
    Each animal has one line in the output file of the following form:

    <animal name>,<animal class>,<status code>,<total number>

    where the first three values are from the input file directly and the last value is the sum total population of the given animal among all zoos.
    The rows must be sorted according to the highest population to the lowest population.
    If there are more than one animal with the same total population, then arbitrarily choose which one comes first.

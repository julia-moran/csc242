Link to Web Page:
https://csit.kutztown.edu/~jmora678/csc242/project8/

Assignment Instructions:

The assignment8 directory contains an incomplete multiple page CRUD application.
There is a a SQLite database file named user.db with the following table schema:

CREATE TABLE user (
  name TEXT NOT NULL,
  email TEXT NOT NULL PRIMARY KEY,
  dob TEXT NOT NULL,
  password TEXT NOT NULL
);

You are to finish the implementation of the CRUD application by using a PHP Data Object to connect to the database and execute the appropriate SQL statements.
Prepared statements must be used for statements that use form data.
The sections of code that you need to implement are in the index.php and search.php files and are denoted with comments containing the text TODO.

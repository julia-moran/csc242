Link to Web Page:
https://csit.kutztown.edu/~jmora678/csc242/finalProject/

Description:
This project is a web page based on The Sims 4 that allows a user to create a character or "sim" based on the possible attributes one can give
a sim in The Sims 4. These attributes include basic information — which consists of a first and last name, pronouns, and age — that are required
of each sim. If the user chooses to edit their sim, they may edit any basic information as well as add and/or edit more detailed information about
the sim, such as the sim's aspiration and traits. The user can also view all of their sims or a single sim at a time. Sims can also be deleted. 

The user must create an account to create sims. The user information is stored in a SQLite table where the usernames and emails of each user must
be unique. Passwords in this table are hashed to make sure they are not stored in pain text. Logging in to the website will start a session that will
last until the user logs out. 

The information about user-created sims is stored in two tables, one that stores the basic information about each sim, and one that stored the detailed
information. Each sim is given a unique ID so they can be individually referenced. 

Assignment Instructions:

The goal of this project is to develop a basic data driven web application.

The theme of your project is up to you, but it must meet the following criteria:
  The application data must be stored in a SQLite database.
  The PDO library must be used to access the database.
  The application must have a login / logout mechanism for users.
  A user must be able to manipulate data in some fashion.
    (It does not necessarily need to use all CRUD operations depending on the theme of the application.)
  All data submitted via forms must be validated and appropriate error messages must be shown to the user if the data is not valid.
  Each page in of the web application must link to the same external CSS style sheet.
  The CSS style sheet must have at least ten rules and be named style.css.
  The server-side code must be modular.
    (That is, do not put all the code in a single file.)
  The web application must be sufficiently complex.
    (This criteria is somewhat subjective; if you think your idea for the web application is too simplistic, then ask me.)
  The home page of the web application must be named index.php.

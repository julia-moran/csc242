--------------------------------------------------------------------------------
-- Name: Julia Moran 
-- CSC 242, Fall, 2022, Assignment 7
--------------------------------------------------------------------------------


--------------------------------------------------------------------------------
SELECT '
Problem 1:';
-- Question 1 
-- Write a query to return the number of rows in the grade_report table.
--------------------------------------------------------------------------------
select count(*) 
from grade_report;

--------------------------------------------------------------------------------
SELECT '
Question 2:';
-- Question 2
-- Write a query to list the first names of the students that have a last name
-- of Hatfield. Order the results in alphabetically by first name.
--------------------------------------------------------------------------------
select distinct first_name 
from grade_report 
where last_name = 'Hatfield' 
order by first_name;

--------------------------------------------------------------------------------
SELECT '
Question 3:';
-- Write a query to list Gil Yates's CSC136 exam grades. Order the results by
-- grade item number ascending.
--------------------------------------------------------------------------------
select category, grade_item, grade 
from grade_report 
where first_name = 'Gil' 
and last_name = 'Yates' 
and course = 'CSC136'
and category = 'exam'
order by grade_item asc;

--------------------------------------------------------------------------------
SELECT '
Question 4:';
-- Write a query to return the exam 2 grades in CSC253 030 in descending order.
--------------------------------------------------------------------------------
select grade 
from grade_report
where course = 'CSC253'
and section = '030'
and category = 'exam'
and grade_item = 2
order by grade desc;

--------------------------------------------------------------------------------
SELECT '
Question 5:';
-- Write a query to return the total number of students.
--------------------------------------------------------------------------------
select count(distinct student_id) 
from grade_report;

--------------------------------------------------------------------------------
SELECT '
Question 6:';
-- Write a query to return the students in CSC242 010 that received an 'A' on
-- the first homework. Order the results alphabetically by last name.
-- (Note: an 'A' is 90 or better.
--------------------------------------------------------------------------------
select first_name, last_name 
from grade_report
where course = 'CSC242'
and section = '010'
and category = 'homework'
and grade_item = 1
and grade >= 90
order by last_name;

--------------------------------------------------------------------------------
SELECT '
Question 7:';
-- Write a query to return the number of students that have taken CSC223. Order
-- the results by student ID ascending.
--------------------------------------------------------------------------------
select count(distinct student_id) 
from grade_report
where course = 'CSC223'
order by student_id asc;

--------------------------------------------------------------------------------
SELECT '
Question 8:';
-- Write a query to return Inez Wilder's average exam grade among all courses.
--------------------------------------------------------------------------------
select avg(grade) 
from grade_report
where last_name = 'Wilder'
and first_name = 'Inez'
and category = 'exam';

--------------------------------------------------------------------------------
SELECT '
Question 9:';
-- Write a query to return the students that received a passing exam 1 grade in
-- CSC242 010. Order the results in alphabetically by last name. (Note; a
-- passing grade is 60 or greater)
--------------------------------------------------------------------------------
select distinct first_name, last_name 
from grade_report
where course = 'CSC242'
and section = '010'
and category = 'exam'
and grade_item = 1
and grade >= 60
order by last_name;

--------------------------------------------------------------------------------
SELECT '
Question 10';
-- Write a query to return the minimum homework grade in CSC125 010.
--------------------------------------------------------------------------------
select min(grade) 
from grade_report
where course = 'CSC125'
and section = '010'
and category = 'homework';

--------------------------------------------------------------------------------
SELECT '
Question 11:';
-- Write a query to return the average exam 1 grade among all sections of
-- CSC135.
--------------------------------------------------------------------------------
select avg(grade) 
from grade_report
where course = 'CSC135'
and category = 'exam'
and grade_item = 1;

--------------------------------------------------------------------------------
SELECT '
Question 12:';
-- Write a query to return the students that have a last name that starts with
-- the letter 'D'. Order the results alphabetically by last name.
--------------------------------------------------------------------------------
select distinct first_name, last_name 
from grade_report
where last_name like 'D%'
order by last_name;

--------------------------------------------------------------------------------
SELECT '
Question 13:';
-- Write a query to return the number of homework assignments that were
-- assigned in CSC136 020.
--------------------------------------------------------------------------------
select count(distinct grade_item) 
from grade_report
where course = 'CSC136'
and section = '020'
and category = 'homework';

--------------------------------------------------------------------------------
SELECT '
Question 14:';
-- Write a query to return the number of CSC135 sections.
--------------------------------------------------------------------------------
select count(distinct section) 
from grade_report
where course = 'CSC135';

--------------------------------------------------------------------------------
SELECT '
Question 15:';
-- Write a query to return the students that have a first name that starts with
-- the letter 'O' or ends with the letter 'o'. Order the results alphabetically
-- by first name.
--------------------------------------------------------------------------------
select distinct first_name 
from grade_report
where first_name like 'O%'
or first_name like '%o'
order by first_name;

--------------------------------------------------------------------------------
SELECT '
Question 16:';
-- Write a query to return the students that have taken CSC125 010 in
-- descending order of last name.
--------------------------------------------------------------------------------
select distinct first_name, last_name 
from grade_report
where course = 'CSC125'
and section = '010'
order by last_name desc; 

--------------------------------------------------------------------------------
SELECT '
Question 17:';
-- Write a query to return the highest grade that Jarvis Leach has on any grade
-- item from any course.
--------------------------------------------------------------------------------
select max(grade) 
from grade_report
where last_name = 'Leach'
and first_name = 'Jarvis';

--------------------------------------------------------------------------------
SELECT '
Question 18:';
-- Write a query to list the number of students that have a failing grade on at
-- least one assignment. (Note: a failing grade is less than 60)
--------------------------------------------------------------------------------
select count(distinct student_id) 
from grade_report
where grade < 60;

--------------------------------------------------------------------------------
SELECT '
Question 19:';
-- Write a query to return the students that failed the first exam in CSC242
-- 010. Order the results alphabetically by last name. (Note: a failing grade
-- is less than 60)
--------------------------------------------------------------------------------
select distinct first_name, last_name 
from grade_report
where course = 'CSC242'
and section = '010'
and category = 'exam'
and grade_item = 1
and grade < 60
order by last_name;

--------------------------------------------------------------------------------
SELECT '
Question 20:';
-- Write a query to return the minimum, maximum, and average quiz grades for
-- all sections of CSC135.
--------------------------------------------------------------------------------
select min(grade), max(grade), avg(grade) 
from grade_report
where course = 'CSC135'
and category = 'quiz';

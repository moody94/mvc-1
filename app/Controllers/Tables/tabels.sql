DROP DATABASE laravel;

CREATE DATABASE laravel;
USE laravel;
CREATE TABLE books
(
    title VARCHAR(60),
    author CHAR(20),
    ISBN VARCHAR(20),
    image VARCHAR(20),
    PRIMARY KEY (Title)
);

CREATE TABLE score
(
    winner CHAR(20),
      score INT

);

CREATE TABLE diceresults
(
    winner VARCHAR(20),
    score VARCHAR(100)

);


INSERT INTO diceresults (winner, score)
VALUES ("moody", 22);



INSERT INTO books (title, author, ISBN, image)
VALUES ("PHP & MySQL", "Brett McLaughlin", "9781449325572", "moody.jfif");

INSERT INTO books (title, author, ISBN, image)
VALUES ("Learning PHP, MySQL & JavaScript", "Robin Nixon", " 9781491918661", "moody2.jpg");

DROP DATABASE IF EXISTS ushop_db;
CREATE DATABASE ushop_db;
USE ushop_db;

CREATE TABLE users(
    userID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL,
    userFName VARCHAR(255) NOT NULL,
    userLName VARCHAR(255) NOT NULL,
    userAddress VARCHAR(255),
    userPass VARCHAR(255) NOT NULL
);

CREATE TABLE categories(
    catID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    catName VARCHAR(255) NOT NULL
);

CREATE TABLE products(
    prodID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    catID INT(11) NOT NULL,
    prodName VARCHAR(255) NOT NULL,
    prodPrice DEC(65,2) NOT NULL,
    prodDes TEXT NOT NULL,
    prodPhoto VARCHAR(255)
);

CREATE TABLE orders(
    orderID INT(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userID INT(11) NOT NULL,
    orderTime DATETIME NOT NULL,
    orderTotal DEC(65,2) NOT NULL
);

CREATE TABLE siteSettings(
    feature VARCHAR(255) NOT NULL,
    switch int(1) NOT NULL
);

INSERT INTO users VALUES
(1,'admin','Kevin','Cheng','123 Main Street','123');

INSERT INTO categories VALUES
(1,'Uncategorized');

INSERT INTO siteSettings VALUES
('useDark',0);

CREATE USER IF NOT EXISTS ushop_admin@localhost
IDENTIFIED BY '123';

GRANT SELECT , INSERT, DELETE, UPDATE
ON *
TO ushop_admin@localhost;
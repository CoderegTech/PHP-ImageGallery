-- create a database for phpgallery
CREATE DATABASE php_gallery;
-- use the database
USE php_gallery;
-- create table to database
CREATE TABLE gallery (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uid VARCHAR(250) NOT NULL,
    postTitle VARCHAR(250) NOT NULL,
    postDescription LONGTEXT NOT NULL,
    postImage VARCHAR(250) NOT NULL,
    postCreated DATETIME NOT NULL
);
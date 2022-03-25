CREATE DATABASE socialMedia;
CREATE TABLE users (
    fname TEXT,
    lname TEXT,
    username TEXT,
    password varchar(225),
    email varchar(225),
    birthdate TEXT,
    gender TEXT,
    phonenumber TEXT,
    profilepicture varchar(255),
    hometown TEXT,
    martialstatus TEXT,
    aboutme varchar(500),
    PRIMARY KEY (email)
    );
CREATE TABLE post (
    posteremail varchar(225),
    post_id int AUTO_INCREMENT,
    poster_name varchar(225),
    isPublic boolean,
    timeposted timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    image varchar(225),
    caption TEXT,
    PRIMARY KEY (post_id),
    FOREIGN KEY (posteremail) REFERENCES users (email)
    );
CREATE TABLE friend (
    friend_id int AUTO_INCREMENT,
    email1 varchar(225),
    email2 varchar(225),
    isFriend varchar(20),
    PRIMARY KEY (friend_id),
    FOREIGN KEY (email1) REFERENCES users(email),
    FOREIGN KEY (email2) REFERENCES users(email)
    );

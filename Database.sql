CREATE DATABASE IF NOT EXISTS data_timeat;

USE data_timeat;

CREATE TABLE IF NOT EXISTS users (
    usersId int(3)  PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersUsername varchar(128) NOT NULL,
    usersPasswword varchar(128) NOT NULL
);


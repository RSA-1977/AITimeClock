CREATE DATABASE TimeClock;

USE TimeClock;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_supervisor BOOLEAN DEFAULT FALSE
);

CREATE TABLE shifts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    start_time DATETIME,
    end_time DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

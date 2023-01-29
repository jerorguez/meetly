CREATE DATABASE IF NOT EXISTS meetly;
USE meetly;

GRANT ALL PRIVILEGES ON meetly.* TO jerobel@'%' IDENTIFIED BY '12345';
FLUSH PRIVILEGES;

CREATE TABLE users (
    `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `surname_1` VARCHAR(30) NOT NULL,
    `surname_2` VARCHAR(30),
    `email` VARCHAR(50) UNIQUE,
    `password` VARCHAR(255),
    `create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `update_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE events (
    `event_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(30) NOT NULL,
    `description` VARCHAR(500) NOT NULL,
    `place` VARCHAR(100),
    `date` DATE,
    `create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `update_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE participants (
    `event_id` INT UNSIGNED,
    `user_id` INT UNSIGNED,
    PRIMARY KEY (`event_id`, `user_id`),

    CONSTRAINT `fk1_event`
        FOREIGN KEY (`event_id`) REFERENCES events (`event_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    CONSTRAINT `fk2_user`
        FOREIGN KEY (`user_id`) REFERENCES users (`user_id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
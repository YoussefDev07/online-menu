-- CREATE DATABASE

CREATE DATABASE java;

-- Create `menu` Table

CREATE TABLE menu (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  thumbnail varchar(10000) UNIQUE,
  title varchar(60),
  price double(6,2),
  discount double(6,2) NOT NULL,
  category int(3) DEFAULT 0,
  date date
);

-- Create `categories` Table

CREATE TABLE categories (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  title varchar(40) UNIQUE,
  date date
);

-- Create `branches` Table

CREATE TABLE branches (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  title varchar(50),
  thumbnail varchar(10000),
  address varchar(255) UNIQUE,
  map varchar(999) UNIQUE
);
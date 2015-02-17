--
-- To use this file do either of:
-- - copy/paste all the following code into the mysql client (in terminal)
-- - $ cat schema.sql | mysql -u root
--

DROP DATABASE IF EXISTS posbetter;
CREATE DATABASE posbetter;
USE posbetter;

--
-- Create database tables
--
CREATE TABLE customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    gender VARCHAR(50),
    customer_since DATE
);

CREATE TABLE item (
    id INT auto_increment primary key,
    name VARCHAR(100),
    price DECIMAL(7,2)
);

CREATE TABLE invoice (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    created_at TIMESTAMP
);

CREATE TABLE invoice_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT
);

--
-- Insert sample data
--

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('homer', 'simpson', 'doh@moes.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('frank', 'sinatra', 'blueeyes@swinger.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('dean', 'martin', 'deano@ladidadoo.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('ben', 'franklin', 'zapped@foundingfathers.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('otis', 'campbell', 'towndrunk@mayberryjail.gov', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('george', 'thorogood', 'george@badbone.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('mickey', 'mantle', '7@yankees.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('marilyn', 'monroe', 'realeminem@bombshell.com', 'female', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('norm', 'peterson', 'norm!@cheers.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('don', 'draper', 'mowomen@motroubles.com', 'male', CURDATE());

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('lindsey', 'lohan', '2ndhome@rehab.com', 'female', CURDATE());

INSERT INTO item (name, price) VALUES ('draft beer', 4.00);

INSERT INTO item (name, price) VALUES ('jack daniels', 6.00);

INSERT INTO item (name, price) VALUES ('scotch', 5.00);

INSERT INTO item (name, price) VALUES ('whiskey', 2.00);

INSERT INTO item (name, price) VALUES ('bourbon', 2.00);

INSERT INTO item (name, price) VALUES ('bloody mary', 8.00);

INSERT INTO item (name, price) VALUES ('rum', 4.00);

INSERT INTO item (name, price) VALUES ('tequila', 3.00);

INSERT INTO item (name, price) VALUES ('martini', 10.00);

INSERT INTO item (name, price) VALUES ('water', 15.00);

INSERT INTO invoice (customer_id, created_at) VALUES (1, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (2, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (3, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (4, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (5, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (6, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (7, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (8, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (9, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (10, NOW());

INSERT INTO invoice (customer_id, created_at) VALUES (11, NOW());

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (1, 1, 24);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (2, 2, 15);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 3, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 4, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 4, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 5, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 9, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (4, 1, 10);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (4, 5, 5);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (4, 10, 1);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (5, 5, 12);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (6, 5, 1);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (6, 3, 1);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (6, 1, 1);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (7, 7, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (7, 10, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (8, 6, 3);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (8, 9, 8);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (9, 1, 25);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 3, 4);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 4, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 5, 4);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 7, 3);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 9, 2);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 2, 6);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (10, 6, 8);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 2, 9);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 5, 12);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 4, 7);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 9, 11);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 7, 9);

INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (11, 10, 2);
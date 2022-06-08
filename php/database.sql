CREATE DATABASE scandiweb_test;

CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sku VARCHAR(30) NOT NULL,
  name VARCHAR(30) NOT NULL,
  price DECIMAL(19, 2) NOT NULL,
  type VARCHAR(20) NOT NULL,
  weight VARCHAR(20),
  size VARCHAR(20),
  height VARCHAR(20),
  width VARCHAR(20),
  length VARCHAR(20)
);

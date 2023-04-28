CREATE DATABASE IF NOT EXISTS employee_db CHARACTER SET cp1250_czech_cs COLLATE cp1250_czech_cs_ci;

USE employee_db;

CREATE TABLE IF NOT EXISTS manager (
  id_man INT NOT NULL AUTO_INCREMENT,
  firstname TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  companyName TEXT NOT NULL,
  PRIMARY KEY (id_man)
) CHARACTER SET cp1250_czech_cs COLLATE cp1250_czech_cs_ci;

CREATE TABLE IF NOT EXISTS employee (
  id_emp INT NOT NULL AUTO_INCREMENT,
  firstname TEXT NOT NULL,
  lastname TEXT NOT NULL,
  entryDate DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_emp)
) CHARACTER SET cp1250_czech_cs COLLATE cp1250_czech_cs_ci;

CREATE TABLE IF NOT EXISTS department (
  id_dep INT NOT NULL AUTO_INCREMENT,
  departmentName TEXT NOT NULL,
  abbreviation TEXT NOT NULL,
  city TEXT NOT NULL,
  color TEXT NOT NULL,
  id_man INT NOT NULL,
  PRIMARY KEY (id_dep),
  FOREIGN KEY (id_man) REFERENCES manager (id_man)
) CHARACTER SET cp1250_czech_cs COLLATE cp1250_czech_cs_ci;

CREATE TABLE IF NOT EXISTS employee_department (
  id_emp INT NOT NULL,
  id_dep INT NOT NULL,
  FOREIGN KEY (id_emp) REFERENCES employee (id_emp),
  FOREIGN KEY (id_dep) REFERENCES department (id_dep)
) CHARACTER SET cp1250_czech_cs COLLATE cp1250_czech_cs_ci;

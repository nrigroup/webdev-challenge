CREATE DATABASE auction;

CREATE TABLE files(
id SERIAL PRIMARY KEY,
date_info DATE NOT NULL,
category VARCHAR(255) NOT NULL,
lot_title VARCHAR(255) NOT NULL,
lot_location VARCHAR(255) NOT NULL, 
lot_condition VARCHAR(255) NOT NULL, 
pre_tax_amount DECIMAL NOT NULL, 
tax_name VARCHAR(255), 
tax_amount DECIMAL
);
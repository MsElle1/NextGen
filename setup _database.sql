-- Database setup for NextGen University
-- Run this in your MySQL/MAMP phpMyAdmin or MySQL command line

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS nextgen_university;
USE nextgen_university;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert test user (password is 'password123')
INSERT INTO users (username, password, email, full_name) VALUES 
('admin', 'password123', 'admin@nextgen.edu', 'Administrator'),
('student1', 'password123', 'student1@nextgen.edu', 'John Doe'),
('faculty1', 'password123', 'faculty1@nextgen.edu', 'Dr. Jane Smith');

-- For production, you should use hashed passwords like this:
-- INSERT INTO users (username, password, email, full_name) VALUES 
-- ('admin', '$2y$10$example_hashed_password_here', 'admin@nextgen.edu', 'Administrator');

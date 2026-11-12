
-- Create Database
CREATE DATABASE student_management;

-- Select Database
USE student_management;

-- Create Students Table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    status ENUM('Active', 'Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Sample Student Records
INSERT INTO students (name, email, course, status)
VALUES
('Rahul Sharma', 'rahul@gmail.com', 'BCA', 'Active'),
('Priya Patil', 'priya@gmail.com', 'BBA', 'Active'),
('Arjun Rao', 'arjun@gmail.com', 'MCA', 'Inactive'),
('Sneha Kulkarni', 'sneha@gmail.com', 'BCA', 'Active'),
('Rohan Desai', 'rohan@gmail.com', 'B.Com', 'Inactive');

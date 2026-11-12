
CREATE DATABASE IF NOT EXISTS student_management;

USE student_management;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    course VARCHAR(100) NOT NULL,
    status ENUM('Active', 'Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO students (name, email, course, status)
VALUES
('Rahul Sharma', 'rahul@gmail.com', 'BCA', 'Active'),
('Priya Patil', 'priya@gmail.com', 'BBA', 'Active'),
('Arjun Rao', 'arjun@gmail.com', 'MCA', 'Inactive'),
('Sneha Kulkarni', 'sneha@gmail.com', 'BCA', 'Active'),
('Rohan Desai', 'rohan@gmail.com', 'B.Com', 'Inactive');

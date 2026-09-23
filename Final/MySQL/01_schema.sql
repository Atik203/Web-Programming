-- ============================================================================
-- CSE 4165 Web Programming — Complete schema for ALL past-paper databases
-- ----------------------------------------------------------------------------
-- HOW TO RUN (XAMPP MySQL is on port 3307):
--   Get-Content 01_schema.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307
--
-- Safe to re-run: it drops and recreates every table, so use it to RESET data
-- after running the UPDATE query files.
-- ============================================================================


-- ============================================================================
-- 1) SAMPLE QUIZ — database: bank, table: employees
-- ============================================================================
CREATE DATABASE IF NOT EXISTS bank;
USE bank;

DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
    id     INT PRIMARY KEY,
    name   VARCHAR(50),
    salary DECIMAL(10,2)
);

INSERT INTO employees (id, name, salary) VALUES
(1, 'Arif Rahman',   45000),
(2, 'Marium Khan',   52000),
(3, 'Sabbir Hossain',38000),
(4, 'Samira Begum',  42000);

-- Expected: SUM = 177000, AVG = 44250


-- ============================================================================
-- 2) FINAL 243 (Fall 2024) — database: uiuweb_final, table: student_final
-- ============================================================================
CREATE DATABASE IF NOT EXISTS uiuweb_final;
USE uiuweb_final;

DROP TABLE IF EXISTS student_final;
CREATE TABLE student_final (
    StudentID   INT PRIMARY KEY,
    StudentName VARCHAR(50),
    CourseID    INT,
    CourseTitle VARCHAR(60),
    Grade       INT,
    LetterGrade VARCHAR(2)
);

INSERT INTO student_final VALUES
(1, 'Karim Uddin',   101, 'Web Programming',            85, 'B'),
(2, 'Rahim Ahmed',   101, 'Web Programming',            92, 'A'),
(3, 'Jashim Hossain',102, 'Project Management',         78, 'C'),
(4, 'Jasica Ahmed',  101, 'Web Programming',            65, 'D'),
(5, 'Faria Karim',   102, 'Project Management',         95, 'A'),
(6, 'Niassoh Dihan', 103, 'System Analysis and Design', 80, 'B');


-- ============================================================================
-- 3) FINAL 251 — database: uiutech_final, table: employee_final
-- ============================================================================
CREATE DATABASE IF NOT EXISTS uiutech_final;
USE uiutech_final;

DROP TABLE IF EXISTS employee_final;
CREATE TABLE employee_final (
    EmployeeID        INT PRIMARY KEY,
    EmployeeName      VARCHAR(50),
    DepartmentID      INT,
    DepartmentName    VARCHAR(50),
    Salary            DECIMAL(10,2),
    PerformanceRating VARCHAR(2)
);

INSERT INTO employee_final VALUES
(1, 'Arif Rahman',   201, 'Software Development', 45000, 'B'),
(2, 'Marium Khan',   201, 'Software Development', 52000, 'A'),
(3, 'Sabbir Hossain',202, 'Quality Assurance',    38000, 'C'),
(4, 'Samira Begum',  203, 'UI/UX Design',         42000, 'B');


-- ============================================================================
-- 4) FINAL 252 (Summer 2025) — database: sundarban, table: sales_data
-- ============================================================================
CREATE DATABASE IF NOT EXISTS sundarban;
USE sundarban;

DROP TABLE IF EXISTS sales_data;
CREATE TABLE sales_data (
    SaleID       INT PRIMARY KEY,
    ProductName  VARCHAR(50),
    CategoryID   INT,
    CategoryName VARCHAR(50),
    Quantity     INT,
    Revenue      DECIMAL(12,2)
);

INSERT INTO sales_data VALUES
(1, 'Laptop', 301, 'Electronics',  5, 350000),
(2, 'Mouse',  301, 'Electronics', 15,  45000),
(3, 'Chair',  302, 'Furniture',    8,  64000),
(4, 'Desk',   302, 'Furniture',    6,  72000),
(5, 'Bottle', 303, 'Accessories', 20,  30000),
(6, 'Pen',    303, 'Accessories', 25,  20000);


-- ============================================================================
-- 5) FINAL 253 (Fall 2025) — database: campus_library, table: book_loans
-- ============================================================================
CREATE DATABASE IF NOT EXISTS campus_library;
USE campus_library;

DROP TABLE IF EXISTS book_loans;
CREATE TABLE book_loans (
    LoanID       INT PRIMARY KEY,
    StudentName  VARCHAR(50),
    BookTitle    VARCHAR(60),
    DaysOverdue  INT,
    PenaltyFee   DECIMAL(10,2),
    Status       VARCHAR(20)
);

INSERT INTO book_loans VALUES
(101, 'Abdul',  'Data Structures',    0,  0.00, 'Returned'),
(102, 'Jabbar', 'Operating Systems', 12, 24.00, 'Overdue'),
(103, 'Barkat', 'Discrete Math',      5, 10.00, 'Overdue'),
(104, 'Rahim',  'Linear Algebra',     2,  4.00, 'Overdue'),
(105, 'Karim',  'Data Structures',   15, 30.00, 'Lost'),
(106, 'Fahim',  'Operating Systems',  0,  0.00, 'Returned');


-- ============================================================================
-- 6) FINAL 261 SET-A (Spring 2026) — database: tourism, table: tourist_spot
-- ============================================================================
CREATE DATABASE IF NOT EXISTS tourism;
USE tourism;

DROP TABLE IF EXISTS tourist_spot;
CREATE TABLE tourist_spot (
    SpotID         INT PRIMARY KEY,
    SpotName       VARCHAR(50),
    Region         VARCHAR(10),
    Category       VARCHAR(20),
    Rating         DECIMAL(3,1),
    EntryFee       DECIMAL(10,2),
    VisitorsPerYear INT
);

INSERT INTO tourist_spot VALUES
(1, 'Cox''s Bazar Beach',  'CTG', 'Beach',    4.9,   0, 150000),
(2, 'Sundarbans Forest',   'KHL', 'Nature',   4.3, 150,  80000),
(3, 'Ratargul Forest',     'SYL', 'Nature',   4.8, 100,  60000),
(4, 'Kuakata Beach',       'PTU', 'Beach',    4.5,   0,  90000),
(5, 'Shat Gambuj Mosque',  'BGH', 'Heritage', 4.7,  30,  70000),
(6, 'Paharpur',            'NWG', 'Heritage', 4.1,  30,  40000);


-- ============================================================================
-- 7) FINAL 261 SET-B (Spring 2026) — database: uiu_bookshop, table: book_info
-- ============================================================================
CREATE DATABASE IF NOT EXISTS uiu_bookshop;
USE uiu_bookshop;

DROP TABLE IF EXISTS book_info;
CREATE TABLE book_info (
    BookID    INT PRIMARY KEY,
    BookTitle VARCHAR(60),
    Author    VARCHAR(50),
    Category  VARCHAR(30),
    Price     DECIMAL(10,2),
    Stock     INT
);

INSERT INTO book_info VALUES
(1, 'Web Basics',      'John Smith', 'Programming', 450, 10),
(2, 'Database Guide',  'Alice Roy',  'Programming', 550,  8),
(3, 'English Grammar', 'Mary Khan',  'Language',    300, 15),
(4, 'Business Math',   'David Lee',  'Business',    400, 12),
(5, 'Python Mastery',  'Sara Ahmed', 'Programming', 600,  5),
(6, 'French Made Easy','Paul Costa', 'Language',    350,  7);

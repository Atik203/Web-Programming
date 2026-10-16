-- ============================================================================
-- SAMPLE QUIZ — Q3 (4 marks)
-- Table: bank.employees — print TOTAL salary and AVERAGE salary
-- (in the exam this is done through a PHP fetch loop — see 08_php_mysql_bridge.php)
-- ============================================================================
USE bank;

-- The whole answer is 2 aggregate functions on one row:
SELECT SUM(salary) AS totalSalary,
       AVG(salary) AS averageSalary
FROM employees;

-- Expected: totalSalary = 177000.00 | averageSalary = 44250.000000

-- If the question instead asks for every employee's salary:
SELECT name, salary FROM employees;

-- ============================================================================
-- FINAL 251 — Q3 (10 marks)
-- Database: uiutech_final | Table: employee_final
-- ============================================================================
USE uiutech_final;

-- ---------------------------------------------------------------------------
-- 1) Total number of employees per performance rating (A, B, C, D)
-- ---------------------------------------------------------------------------
SELECT PerformanceRating, COUNT(*) AS TotalEmployees
FROM employee_final
GROUP BY PerformanceRating;
-- Expected: A=1, B=2, C=1

-- ---------------------------------------------------------------------------
-- 2) Salary below 40,000 and rating is not 'D'  ->  rating becomes 'C'
-- ---------------------------------------------------------------------------
UPDATE employee_final
SET PerformanceRating = 'C'
WHERE Salary < 40000 AND PerformanceRating <> 'D';
-- Sabbir (38000, C) already C; guard makes this a no-op. Safe to re-run.

-- ---------------------------------------------------------------------------
-- 3) Salary > 50,000  ->  +5,000 bonus, but only if result <= 60,000
-- ---------------------------------------------------------------------------
UPDATE employee_final
SET Salary = Salary + 5000
WHERE Salary > 50000 AND Salary + 5000 <= 60000;
-- Marium 52000 -> 57000. Next run: 57000+5000=62000 > 60000, stops. Safe.

-- ---------------------------------------------------------------------------
-- 4) Each department: name + employee count, largest department first
-- ---------------------------------------------------------------------------
SELECT DepartmentName, COUNT(*) AS TotalEmployees
FROM employee_final
GROUP BY DepartmentName
ORDER BY TotalEmployees DESC;
-- Expected: Software Development = 2, others = 1

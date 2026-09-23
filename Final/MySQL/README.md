# MySQL — CSE 4165 Web Programming — Final Revision

> **Where it appears:** the last question of every paper (Q3, 10 marks / 4 marks in the quiz).
> Format: *"Create a database named X and a table named Y … now do the following"* → you write **SQL inside PHP** (251/252/261 demand "full PHP–MySQL code, not just SQL").
> There are only **4 query patterns**. Every paper recycles them with different column names.

---

## 📖 Index

1. [Know This Cold — the 4 query patterns](#1-know-this-cold--the-4-query-patterns)
2. [How to Run SQL on Your Machine (port 3307)](#2-how-to-run-sql-on-your-machine-port-3307)
3. [DDL: CREATE DATABASE / TABLE / INSERT](#3-ddl-create-database--table--insert)
4. [SELECT: WHERE, AND/OR, LIKE, BETWEEN, ORDER BY](#4-select-where-andor-like-between-order-by)
5. [Aggregate Functions](#5-aggregate-functions)
6. [GROUP BY + HAVING](#6-group-by--having)
7. [UPDATE — guarded and arithmetic](#7-update--guarded-and-arithmetic)
8. [Computed Columns & Subqueries](#8-computed-columns--subqueries)
9. [PHP ↔ MySQL Bridge (full exam answer shape)](#9-php--mysql-bridge-full-exam-answer-shape)
10. [Example Files — mapped to past papers](#10-example-files--mapped-to-past-papers)
11. [Traps — the marks people lose](#11-traps--the-marks-people-lose)
12. [Write From Memory — Self Test](#12-write-from-memory--self-test)

---

## 1. Know This Cold — the 4 query patterns

**Pattern 1 — count per group (+ optional HAVING):**

```sql
SELECT LetterGrade, COUNT(*) AS Total
FROM student_final
GROUP BY LetterGrade;

-- only groups with more than 1 entry:
SELECT Status, COUNT(*) AS Total
FROM book_loans
GROUP BY Status
HAVING COUNT(*) > 1;
```

**Pattern 2 — guarded conditional UPDATE:**

```sql
UPDATE student_final
SET LetterGrade = 'C'
WHERE Grade < 75 AND LetterGrade <> 'D';
```

**Pattern 3 — arithmetic UPDATE with a guard on the new value:**

```sql
UPDATE student_final
SET Grade = Grade + 5
WHERE Grade > 80 AND Grade + 5 <= 90;
```

**Pattern 4 — group + aggregate + sort:**

```sql
SELECT CourseTitle, COUNT(*) AS Total
FROM student_final
GROUP BY CourseTitle
ORDER BY Total DESC;
```

Almost every "do the following" list is just these four in some order. Learn the shapes, swap the column names.

---

## 2. How to Run SQL on Your Machine (port 3307)

XAMPP's MySQL runs on **port 3307**. Two ways to run the files in this folder:

**Option A — PowerShell one-liner (no phpMyAdmin):**

```powershell
Get-Content 01_schema.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307
Get-Content 05_queries_252.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307
```

**Option B — phpMyAdmin:** open `http://localhost/phpmyadmin` → SQL tab → paste → Go.

**Reset the data** after running UPDATE files (they permanently change rows):

```powershell
Get-Content 01_schema.sql | & "G:\xampp\mysql\bin\mysql.exe" -u root -P 3307
```

The schema file is safe to re-run any time — it drops and recreates every table.

---

## 3. DDL: CREATE DATABASE / TABLE / INSERT

The exam starts with *"Create a database named X and a table named Y with the following structure and values"* — so you write all three statements:

```sql
CREATE DATABASE campus_library;          -- 1) the database

USE campus_library;                      -- 2) switch into it

CREATE TABLE book_loans (                -- 3) the table
    LoanID       INT PRIMARY KEY,
    StudentName  VARCHAR(50),
    BookTitle    VARCHAR(60),
    DaysOverdue  INT,
    PenaltyFee   DECIMAL(10,2),
    Status       VARCHAR(20)
);

INSERT INTO book_loans VALUES            -- 4) the data rows
(101, 'Abdul',  'Data Structures',    0,  0.00, 'Returned'),
(102, 'Jabbar', 'Operating Systems', 12, 24.00, 'Overdue'),
(103, 'Barkat', 'Discrete Math',      5, 10.00, 'Overdue'),
(104, 'Rahim',  'Linear Algebra',     2,  4.00, 'Overdue'),
(105, 'Karim',  'Data Structures',   15, 30.00, 'Lost'),
(106, 'Fahim',  'Operating Systems',  0,  0.00, 'Returned');
```

**Column types to know:**

| Type | Use for | Example |
|---|---|---|
| `INT` | whole numbers | IDs, counts, days |
| `VARCHAR(n)` | text up to n chars | names, titles, status |
| `DECIMAL(10,2)` | money — 2 decimal places | 24.00, 350000.00 |
| `FLOAT` / `DECIMAL(3,1)` | ratings like 4.9 | |
| `DATE` | dates | '2026-09-23' |

**Single quotes in data:** escape by doubling — `'Cox''s Bazar Beach'` (needed for Final 261).

---

## 4. SELECT: WHERE, AND/OR, LIKE, BETWEEN, ORDER BY

```sql
-- exact match
SELECT * FROM book_info WHERE Category = 'Programming';

-- two conditions
SELECT BookTitle, Author, Price
FROM book_info
WHERE Price > 400 AND Category = 'Programming';

-- OR: rating above 4.5 OR name contains "Beach"  (Final 261A Q1)
SELECT SpotName, Region, Rating
FROM tourist_spot
WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
ORDER BY Rating DESC;

-- BETWEEN is INCLUSIVE on both ends
SELECT * FROM tourist_spot WHERE Rating BETWEEN 4.0 AND 4.5;

-- ORDER BY: DESC = highest first
SELECT * FROM book_info WHERE Category = 'Programming' ORDER BY Price DESC;
```

| Symbol | Meaning |
|---|---|
| `=` | equal (single `=`, not `==`) |
| `<>` or `!=` | not equal |
| `>` `>=` `<` `<=` | comparisons |
| `LIKE '%Beach%'` | contains "Beach" (`%` = any characters) |
| `LIKE 'Beach%'` | starts with "Beach" |
| `BETWEEN a AND b` | inclusive range |
| `AND` / `OR` | combine conditions |

---

## 5. Aggregate Functions

| Function | Returns | Example |
|---|---|---|
| `COUNT(*)` | number of rows | `COUNT(*) AS Total` |
| `SUM(col)` | total | `SUM(Revenue)` |
| `AVG(col)` | average | `AVG(salary)` |
| `MIN(col)` / `MAX(col)` | smallest / largest | |

```sql
-- whole-table totals: no GROUP BY, returns ONE row
SELECT SUM(salary) AS totalSalary, AVG(salary) AS averageSalary
FROM employees;

-- computed aggregate (Final 261B Q4): net worth = price × stock summed
SELECT SUM(Price * Stock) AS TotalNetWorth
FROM book_info;
```

---

## 6. GROUP BY + HAVING

**`GROUP BY`** splits rows into groups; **aggregates** then work per group.
**`HAVING`** filters the groups *after* aggregation (WHERE filters rows *before*).

```sql
-- count per category
SELECT CategoryName, COUNT(*) AS TotalBooks
FROM book_info
GROUP BY CategoryName;

-- sum per category (Final 252 Q1)
SELECT CategoryName, SUM(Revenue) AS TotalRevenue
FROM sales_data
GROUP BY CategoryName;

-- HAVING: only groups bigger than 1 (Final 253 Q1)
SELECT Status, COUNT(*) AS TotalBooks
FROM book_loans
GROUP BY Status
HAVING COUNT(*) > 1;

-- multi-aggregate + HAVING + sort (Final 261A Q3)
SELECT Category,
       COUNT(*)             AS TotalSpots,
       AVG(Rating)          AS AverageRating,
       SUM(VisitorsPerYear) AS TotalVisitors
FROM tourist_spot
GROUP BY Category
HAVING AVG(Rating) > 4.4
ORDER BY AverageRating DESC;

-- sort by an aggregate alias, biggest first (every paper's last task)
SELECT DepartmentName, COUNT(*) AS TotalEmployees
FROM employee_final
GROUP BY DepartmentName
ORDER BY TotalEmployees DESC;
```

**Memory hook:** `WHERE` → rows, `HAVING` → groups. You cannot use `WHERE COUNT(*) > 1` — use `HAVING`.

---

## 7. UPDATE — guarded and arithmetic

```sql
-- plain conditional update
UPDATE employee_final
SET PerformanceRating = 'C'
WHERE Salary < 40000 AND PerformanceRating <> 'D';

-- arithmetic update with a guard on the RESULT (Final 251 Q3)
UPDATE employee_final
SET Salary = Salary + 5000
WHERE Salary > 50000 AND Salary + 5000 <= 60000;

-- update TWO columns at once (Final 253 Q2)
UPDATE book_loans
SET Status = 'Grace Period', PenaltyFee = 0
WHERE Status = 'Overdue' AND DaysOverdue < 7;

-- percentage increase (Final 253 Q3)
UPDATE book_loans
SET PenaltyFee = PenaltyFee * 1.1
WHERE PenaltyFee > 20 AND PenaltyFee * 1.1 <= 50;

-- rating + 0.2 AND fee + 10% (Final 261A Q2)
UPDATE tourist_spot
SET Rating = Rating + 0.2, EntryFee = EntryFee * 1.1
WHERE Rating BETWEEN 4.0 AND 4.5 AND EntryFee > 0;

-- 10% reduction (Final 261B Q5)
UPDATE book_info SET Price = Price * 0.9 WHERE Category = 'Language';
```

**Guard trick:** when the question says *"but only if the resulting value is ≤ X"*, put the arithmetic expression itself in the WHERE: `AND Salary + 5000 <= 60000`. Do **not** add it as a second condition on the old value.

---

## 8. Computed Columns & Subqueries

```sql
-- computed column in the SELECT list
SELECT BookTitle, Price, Price * Stock AS StockValue FROM book_info;

-- 'Top Seller' if revenue is above the AVERAGE OF ITS OWN CATEGORY (Final 252 Q4)
SELECT ProductName,
       CategoryName,
       Revenue,
       CASE
           WHEN Revenue > (SELECT AVG(s2.Revenue)
                           FROM sales_data s2
                           WHERE s2.CategoryID = s1.CategoryID)
           THEN 'Top Seller'
           ELSE 'Regular Seller'
       END AS SellerLabel
FROM sales_data s1;
```

`CASE WHEN condition THEN 'A' ELSE 'B' END` is the SQL if/else — you may be asked for a label column.

---

## 9. PHP ↔ MySQL Bridge (full exam answer shape)

The papers say *"write full PHP–MySQL code"* — that means the SQL must be wrapped like this. **This is the most important block on the page.**

```php
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "campus_library";

// 1) CONNECT
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2) QUERY
$sql = "SELECT Status, COUNT(*) AS TotalBooks
        FROM book_loans
        GROUP BY Status
        HAVING COUNT(*) > 1";
$result = $conn->query($sql);

// 3) FETCH + LOOP + PRINT   <- memorise this loop
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Status: " . $row["Status"] . " - " . $row["TotalBooks"] . "<br>";
    }
} else {
    echo "0 results";
}

// 4) CLOSE
$conn->close();
?>
```

**Rules for the bridge:**
- `$row["alias"]` uses the column name **or the `AS` alias** — that's why every query in this folder uses `AS`.
- Run each of the question's tasks as its own `$conn->query(...)` block (the UPDATE tasks print nothing; you can `echo "Updated successfully"`).
- On your XAMPP add the port as the 5th argument: `new mysqli("localhost", "root", "", $dbname, 3307);` — **not** in the exam.
- The quiz Q3 version (total + average salary) is `09_php_mysql_bridge.php` — run it and compare.

---

## 10. Example Files — mapped to past papers

| File | Paper | Queries inside |
|---|---|---|
| `01_schema.sql` | all | every database/table/data — re-run to reset |
| `02_queries_sample_quiz.sql` | **Sample Quiz Q3** | `SUM`, `AVG` |
| `03_queries_243.sql` | Final 243 | GROUP BY count, guarded UPDATE, +5 bonus, GROUP BY + ORDER BY |
| `04_queries_251.sql` | Final 251 | same 4 patterns, salary/rating |
| `05_queries_252.sql` | Final 252 | SUM per category, rename, ×1.1, CASE + subquery |
| `06_queries_253.sql` | Final 253 | HAVING, two-column UPDATE, ×1.1 guard, SUM per book |
| `07_queries_261.sql` | Final 261 Set-A | OR + LIKE, BETWEEN UPDATE, HAVING AVG, computed SUM |
| `08_queries_261b.sql` | Final 261 Set-B | WHERE + ORDER BY, COUNT per group, net worth, ×0.9 |
| `09_php_mysql_bridge.php` | Sample Quiz Q3 | **full PHP answer** — total + average salary |
| `10_php_mysql_multiple_rows.php` | 251 paper's printed sample | multi-row fetch loop |

Every query file has the expected output in comments — run it and compare.

---

## 11. Traps — the marks people lose

1. **`UPDATE` without `WHERE` updates EVERY row** — always include the guard.
2. **`HAVING` not `WHERE` for aggregates** — `WHERE COUNT(*) > 1` is an error.
3. **`=` in SQL, `==` does not exist** — `WHERE id = 2`, not `==`.
4. **Single quotes for text, no quotes for numbers** — `'Overdue'`, `24.00`, `Grade < 75`.
5. **Escape apostrophes by doubling** — `'Cox''s Bazar'`.
6. **`BETWEEN` is inclusive** — `BETWEEN 4.0 AND 4.5` includes both 4.0 and 4.5.
7. **"Only if the result ≤ X" guard goes on the expression** — `AND Fee * 1.1 <= 50`.
8. **`GROUP BY` needs every non-aggregated selected column** — select `Category, COUNT(*)` → `GROUP BY Category`.
9. **Aliases matter for PHP** — `$row["TotalBooks"]` works only because of `AS TotalBooks`.
10. **Running UPDATE files changes data** — re-run `01_schema.sql` to reset before re-testing.
11. **Check ranges in order** — classification `>= 500` before `>= 300`, etc. (PHP side).
12. **`COUNT(*)` counts rows; `COUNT(col)` skips NULLs** — use `COUNT(*)` for "how many".

---

## 12. Write From Memory — Self Test

- [ ] `CREATE DATABASE` + `USE` + `CREATE TABLE` + `INSERT INTO ... VALUES` for one of the paper tables
- [ ] Pattern 1: `SELECT col, COUNT(*) AS Total FROM t GROUP BY col`
- [ ] Pattern 1b: add `HAVING COUNT(*) > 1`
- [ ] Pattern 2: guarded `UPDATE ... SET ... WHERE ... AND col <> 'D'`
- [ ] Pattern 3: `SET Salary = Salary + 5000 WHERE Salary > 50000 AND Salary + 5000 <= 60000`
- [ ] Pattern 4: `GROUP BY ... ORDER BY Total DESC`
- [ ] `SELECT SUM(Price * Stock) FROM book_info`
- [ ] The `LIKE '%Beach%'` + `OR` + `ORDER BY Rating DESC` query
- [ ] The mysqli bridge: connect → query → `while ($row = $result->fetch_assoc())` → close
- [ ] `$row["alias"]` — and why the `AS` matters

---

**Suggested practice loop (30 min):**
1. Read sections 1, 6, 7, 9 for 10 minutes.
2. Run `01_schema.sql` to load the data.
3. Take a blank sheet. Write the full answers for Final 253 Q3 from memory.
4. Run `06_queries_253.sql` and compare row by row.
5. Reset with `01_schema.sql`, repeat for 252 or 261.

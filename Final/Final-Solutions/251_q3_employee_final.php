<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 251 — Q3: employee_final (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 251 — Q3: uiutech_final.employee_final</h2>

<?php
// ============================================================================
// FINAL 251 — Q3 (10 marks)                      [cheat sheet: boxes 18, 22]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE uiutech_final;
//   USE uiutech_final;
//   CREATE TABLE employee_final (
//       EmployeeID        INT PRIMARY KEY,
//       EmployeeName      VARCHAR(50),
//       DepartmentID      INT,
//       DepartmentName    VARCHAR(50),
//       Salary            DECIMAL(10,2),
//       PerformanceRating VARCHAR(2)
//   );
//   INSERT INTO employee_final VALUES
//   (1, 'Arif Rahman',    201, 'Software Development', 45000, 'B'),
//   (2, 'Marium Khan',    201, 'Software Development', 52000, 'A'),
//   (3, 'Sabbir Hossain', 202, 'Quality Assurance',    38000, 'C'),
//   (4, 'Samira Begum',   203, 'UI/UX Design',         42000, 'B');
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uiutech_final";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — total employees per performance rating (A, B, C, D)
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Employees per performance rating</h3>";
$sql1 = "SELECT PerformanceRating, COUNT(*) AS TotalEmployees
         FROM employee_final
         GROUP BY PerformanceRating";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["PerformanceRating"] . " | " . $row["TotalEmployees"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — salary below 40,000 and rating is not 'D' -> rating becomes 'C'
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Salary below 40,000 (not D) -> rating C</h3>";
$sql2 = "UPDATE employee_final
         SET PerformanceRating = 'C'
         WHERE Salary < 40000 AND PerformanceRating <> 'D'";
if ($conn->query($sql2) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — salary above 50,000 -> +5,000 bonus, but total must stay <= 60,000
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Salary above 50,000 -> +5,000 bonus (max 60,000)</h3>";
$sql3 = "UPDATE employee_final
         SET Salary = Salary + 5000
         WHERE Salary > 50000 AND Salary + 5000 <= 60000";
if ($conn->query($sql3) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — each department: name + employee count, largest department first
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Employees per department (largest first)</h3>";
$sql4 = "SELECT DepartmentName, COUNT(*) AS TotalEmployees
         FROM employee_final
         GROUP BY DepartmentName
         ORDER BY TotalEmployees DESC";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo $row["DepartmentName"] . " | " . $row["TotalEmployees"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

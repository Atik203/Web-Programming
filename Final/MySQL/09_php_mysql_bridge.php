<?php
// ============================================================================
// SAMPLE QUIZ — Q3 (4 marks) : FULL ANSWER
// Connect to database 'bank' and print total + average salary from 'employees'
// using the fetch function and a loop.
//
// Run:  & "G:\xampp\php\php.exe" 09_php_mysql_bridge.php
// (XAMPP MySQL is on port 3307, so 3307 is passed as the 5th mysqli argument.
//  In the exam they use the default port — just drop the 5th argument there.)
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "bank";
$port       = 3307;

// 1) CONNECT
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2) QUERY — aggregates return exactly one row
$sql = "SELECT SUM(salary) AS totalSalary, AVG(salary) AS averageSalary FROM employees";
$result = $conn->query($sql);

// 3) FETCH + LOOP + PRINT
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Total Salary: " . $row["totalSalary"] . "<br>";
        echo "Average Salary: " . $row["averageSalary"] . "<br>";
    }
} else {
    echo "0 results";
}

// 4) CLOSE
$conn->close();

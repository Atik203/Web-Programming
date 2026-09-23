<?php
// ============================================================================
// BONUS — the SAME boilerplate fetching MANY rows (the pattern printed in the
// 251 paper). This is the one to memorise: it works for ANY SELECT.
//
// Run:  & "G:\xampp\php\php.exe" 10_php_mysql_multiple_rows.php
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

// Example query: employees per department, biggest department first
$sql = "SELECT DepartmentName, COUNT(*) AS TotalEmployees
        FROM employee_final
        GROUP BY DepartmentName
        ORDER BY TotalEmployees DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["DepartmentName"] . " : " . $row["TotalEmployees"] . " employee(s)<br>";
    }
} else {
    echo "0 results";
}

$conn->close();

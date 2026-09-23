<?php
// ============================================================================
// BONUS — the SAME quiz-Q3 bridge written with PDO, for comparison with
// 09_php_mysql_bridge.php (mysqli). Both print identical output.
//
// Run:  & "G:\xampp\php\php.exe" 11_php_mysql_pdo.php
//
// Differences to notice:
//   - PDO takes ONE DSN string; the port goes inside it
//   - errors are handled with try / catch (no connect_error check)
//   - fetch uses fetch(PDO::FETCH_ASSOC) instead of fetch_assoc()
// ============================================================================

try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=bank", "root", "");
} catch (Exception $e) {
    die("Connection failed");
}

$stmt = $pdo->query("SELECT SUM(salary) AS totalSalary, AVG(salary) AS averageSalary FROM employees");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Total Salary: " . $row["totalSalary"] . "<br>";
    echo "Average Salary: " . $row["averageSalary"] . "<br>";
}

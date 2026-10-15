<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 252 — Q3: sales_data (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 252 — Q3: sundarban.sales_data</h2>

<?php
// ============================================================================
// FINAL 252 (Summer 2025) — Q3 (10 marks)        [cheat sheet: boxes 18, 19, 22, 23]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE sundarban;
//   USE sundarban;
//   CREATE TABLE sales_data (
//       SaleID       INT PRIMARY KEY,
//       ProductName  VARCHAR(50),
//       CategoryID   INT,
//       CategoryName VARCHAR(50),
//       Quantity     INT,
//       Revenue      DECIMAL(12,2)
//   );
//   INSERT INTO sales_data VALUES
//   (1, 'Laptop', 301, 'Electronics',  5, 350000),
//   (2, 'Mouse',  301, 'Electronics', 15,  45000),
//   (3, 'Chair',  302, 'Furniture',    8,  64000),
//   (4, 'Desk',   302, 'Furniture',    6,  72000),
//   (5, 'Bottle', 303, 'Accessories', 20,  30000),
//   (6, 'Pen',    303, 'Accessories', 25,  20000);
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Tasks run IN ORDER (task 4 uses the revenues changed by task 3).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sundarban";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — total revenue per category
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Total revenue per category</h3>";
$sql1 = "SELECT CategoryName, SUM(Revenue) AS TotalRevenue
         FROM sales_data
         GROUP BY CategoryName";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["CategoryName"] . " | " . $row["TotalRevenue"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — revenue below 40,000 -> category becomes 'Low Performing'
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Revenue below 40,000 -> Low Performing</h3>";
$sql2 = "UPDATE sales_data
         SET CategoryName = 'Low Performing'
         WHERE Revenue < 40000";
if ($conn->query($sql2) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — revenue above 70,000 -> add 10% bonus revenue  (not idempotent!)
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Revenue above 70,000 -> +10%</h3>";
$sql3 = "UPDATE sales_data
         SET Revenue = Revenue * 1.1
         WHERE Revenue > 70000";
if ($conn->query($sql3) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — product + category + 'Top Seller' if revenue is above the average
//          revenue of its OWN category, else 'Regular Seller'
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Top Seller / Regular Seller per product</h3>";
$sql4 = "SELECT ProductName, CategoryName, Revenue,
                CASE
                    WHEN Revenue > (SELECT AVG(s2.Revenue)
                                    FROM sales_data s2
                                    WHERE s2.CategoryID = s1.CategoryID)
                    THEN 'Top Seller'
                    ELSE 'Regular Seller'
                END AS SellerLabel
         FROM sales_data s1";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo $row["ProductName"] . " | " . $row["CategoryName"] . " | " . $row["SellerLabel"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 261 Set B — Q3: book_info (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 261 Set B — Q3: uiu_bookshop.book_info</h2>

<?php
// ============================================================================
// FINAL 261 SET-B (Spring 2026) — Q3 (10 marks)  [cheat sheet: boxes 18, 19, 22]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE uiu_bookshop;
//   USE uiu_bookshop;
//   CREATE TABLE book_info (
//       BookID    INT PRIMARY KEY,
//       BookTitle VARCHAR(60),
//       Author    VARCHAR(50),
//       Category  VARCHAR(30),
//       Price     DECIMAL(10,2),
//       Stock     INT
//   );
//   INSERT INTO book_info VALUES
//   (1, 'Web Basics',      'John Smith', 'Programming', 450, 10),
//   (2, 'Database Guide',  'Alice Roy',  'Programming', 550,  8),
//   (3, 'English Grammar', 'Mary Khan',  'Language',    300, 15),
//   (4, 'Business Math',   'David Lee',  'Business',    400, 12),
//   (5, 'Python Mastery',  'Sara Ahmed', 'Programming', 600,  5),
//   (6, 'French Made Easy','Paul Costa', 'Language',    350,  7);
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Task 5 is an UPDATE + read-back (not idempotent).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uiu_bookshop";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — all Programming books, highest price first
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Programming books (price descending)</h3>";
$sql1 = "SELECT * FROM book_info
         WHERE Category = 'Programming'
         ORDER BY Price DESC";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["BookID"] . " | " . $row["BookTitle"] . " | " . $row["Author"] . " | " . $row["Category"] . " | " . $row["Price"] . " | " . $row["Stock"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — title + author + price where price > 400 and category Programming
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Programming books above 400</h3>";
$sql2 = "SELECT BookTitle, Author, Price
         FROM book_info
         WHERE Price > 400 AND Category = 'Programming'";
$result2 = $conn->query($sql2);
if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        echo $row["BookTitle"] . " | " . $row["Author"] . " | " . $row["Price"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — number of books available in each category
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Books per category</h3>";
$sql3 = "SELECT Category, COUNT(*) AS TotalBooks
         FROM book_info
         GROUP BY Category";
$result3 = $conn->query($sql3);
if ($result3 && $result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        echo $row["Category"] . " | " . $row["TotalBooks"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — total net worth of the bookshop = SUM(price * stock)
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Total net worth</h3>";
$sql4 = "SELECT SUM(Price * Stock) AS TotalNetWorth
         FROM book_info";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo "Total Net Worth: " . $row["TotalNetWorth"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 5 — 10% price reduction for Language, then show the updated prices
// ---------------------------------------------------------------------------
echo "<h3>Task 5: Language books -10%, updated prices</h3>";
$sql5 = "UPDATE book_info
         SET Price = Price * 0.9
         WHERE Category = 'Language'";
if ($conn->query($sql5) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

$sql6 = "SELECT BookTitle, Price
         FROM book_info
         WHERE Category = 'Language'";
$result6 = $conn->query($sql6);
if ($result6 && $result6->num_rows > 0) {
    while ($row = $result6->fetch_assoc()) {
        echo $row["BookTitle"] . " | " . $row["Price"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

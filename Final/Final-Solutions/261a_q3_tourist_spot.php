<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 261 Set A — Q3: tourist_spot (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 261 Set A — Q3: tourism.tourist_spot</h2>

<?php
// ============================================================================
// FINAL 261 SET-A (Spring 2026) — Q3 (10 marks)  [cheat sheet: boxes 18, 20, 22, 23]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE tourism;
//   USE tourism;
//   CREATE TABLE tourist_spot (
//       SpotID          INT PRIMARY KEY,
//       SpotName        VARCHAR(50),
//       Region          VARCHAR(10),
//       Category        VARCHAR(20),
//       Rating          DECIMAL(3,1),
//       EntryFee        DECIMAL(10,2),
//       VisitorsPerYear INT
//   );
//   INSERT INTO tourist_spot VALUES
//   (1, 'Cox''s Bazar Beach', 'CTG', 'Beach',    4.9,   0, 150000),
//   (2, 'Sundarbans Forest',  'KHL', 'Nature',   4.3, 150,  80000),
//   (3, 'Ratargul Forest',    'SYL', 'Nature',   4.8, 100,  60000),
//   (4, 'Kuakata Beach',      'PTU', 'Beach',    4.5,   0,  90000),
//   (5, 'Shat Gambuj Mosque', 'BGH', 'Heritage', 4.7,  30,  70000),
//   (6, 'Paharpur',           'NWG', 'Heritage', 4.1,  30,  40000);
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Tasks run IN ORDER (tasks 3+4 use the ratings/fees changed by task 2).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "tourism";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — rating > 4.5 OR name contains 'Beach', highest rating first
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Rating above 4.5 or name contains Beach</h3>";
$sql1 = "SELECT SpotName, Region, Rating
         FROM tourist_spot
         WHERE Rating > 4.5 OR SpotName LIKE '%Beach%'
         ORDER BY Rating DESC";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["SpotName"] . " | " . $row["Region"] . " | " . $row["Rating"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — rating between 4.0 and 4.5 (inclusive) AND entry fee > 0
//          -> rating + 0.2 and entry fee + 10%   (not idempotent!)
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Rating 4.0-4.5 with a fee -> +0.2 rating, +10% fee</h3>";
$sql2 = "UPDATE tourist_spot
         SET Rating = Rating + 0.2,
             EntryFee = EntryFee * 1.1
         WHERE Rating BETWEEN 4.0 AND 4.5 AND EntryFee > 0";
if ($conn->query($sql2) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — each category: spots, average rating, total visitors
//          only average rating > 4.4, highest average first
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Categories with average rating above 4.4</h3>";
$sql3 = "SELECT Category,
                COUNT(*)             AS TotalSpots,
                AVG(Rating)          AS AverageRating,
                SUM(VisitorsPerYear) AS TotalVisitors
         FROM tourist_spot
         GROUP BY Category
         HAVING AVG(Rating) > 4.4
         ORDER BY AverageRating DESC";
$result3 = $conn->query($sql3);
if ($result3 && $result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        echo $row["Category"] . " | " . $row["TotalSpots"] . " | " . $row["AverageRating"] . " | " . $row["TotalVisitors"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — each region: total yearly revenue = SUM(fee * visitors)
//          only regions above 1,000,000, highest first
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Region revenue above 1,000,000</h3>";
$sql4 = "SELECT Region,
                SUM(EntryFee * VisitorsPerYear) AS TotalRevenue
         FROM tourist_spot
         GROUP BY Region
         HAVING SUM(EntryFee * VisitorsPerYear) > 1000000
         ORDER BY TotalRevenue DESC";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo $row["Region"] . " | " . $row["TotalRevenue"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

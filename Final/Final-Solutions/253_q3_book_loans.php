<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 253 — Q3: book_loans (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 253 — Q3: campus_library.book_loans</h2>

<?php
// ============================================================================
// FINAL 253 (Fall 2025) — Q3 (10 marks)          [cheat sheet: boxes 18, 22, 23]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE campus_library;
//   USE campus_library;
//   CREATE TABLE book_loans (
//       LoanID       INT PRIMARY KEY,
//       StudentName  VARCHAR(50),
//       BookTitle    VARCHAR(60),
//       DaysOverdue  INT,
//       PenaltyFee   DECIMAL(10,2),
//       Status       VARCHAR(20)
//   );
//   INSERT INTO book_loans VALUES
//   (101, 'Abdul',  'Data Structures',    0,  0.00, 'Returned'),
//   (102, 'Jabbar', 'Operating Systems', 12, 24.00, 'Overdue'),
//   (103, 'Barkat', 'Discrete Math',      5, 10.00, 'Overdue'),
//   (104, 'Rahim',  'Linear Algebra',     2,  4.00, 'Overdue'),
//   (105, 'Karim',  'Data Structures',   15, 30.00, 'Lost'),
//   (106, 'Fahim',  'Operating Systems',  0,  0.00, 'Returned');
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "campus_library";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — total books per Status, only statuses with MORE THAN 1 entry
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Books per status (more than 1 only)</h3>";
$sql1 = "SELECT Status, COUNT(*) AS TotalBooks
         FROM book_loans
         GROUP BY Status
         HAVING COUNT(*) > 1";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["Status"] . " | " . $row["TotalBooks"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — status Overdue and less than 7 days -> 'Grace Period' and fee = 0
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Overdue below 7 days -> Grace Period (fee 0)</h3>";
$sql2 = "UPDATE book_loans
         SET Status = 'Grace Period', PenaltyFee = 0
         WHERE Status = 'Overdue' AND DaysOverdue < 7";
if ($conn->query($sql2) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — penalty fee above 20 -> +10% processing charge, final fee <= 50
//          (no status condition in the question)
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Penalty fee above 20 -> +10% (max 50)</h3>";
$sql3 = "UPDATE book_loans
         SET PenaltyFee = PenaltyFee * 1.1
         WHERE PenaltyFee > 20 AND PenaltyFee * 1.1 <= 50";
if ($conn->query($sql3) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — each book: title + total penalty fee, highest money first
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Total penalty fee per book (highest first)</h3>";
$sql4 = "SELECT BookTitle, SUM(PenaltyFee) AS TotalPenalty
         FROM book_loans
         GROUP BY BookTitle
         ORDER BY TotalPenalty DESC";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo $row["BookTitle"] . " | " . $row["TotalPenalty"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

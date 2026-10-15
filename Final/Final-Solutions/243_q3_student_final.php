<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 243 — Q3: student_final (PHP + MySQL)</title>
</head>
<body>

<h2>FINAL 243 — Q3: uiuweb_final.student_final</h2>

<?php
// ============================================================================
// FINAL 243 (Fall 2024) — Q3 (10 marks)          [cheat sheet: boxes 18, 22]
// ----------------------------------------------------------------------------
// PART 1 — DATABASE + TABLE: in the exam you create this FIRST as plain SQL
// (in phpMyAdmin). It is NOT part of the PHP answer:
//
//   CREATE DATABASE uiuweb_final;
//   USE uiuweb_final;
//   CREATE TABLE student_final (
//       StudentID   INT PRIMARY KEY,
//       StudentName VARCHAR(50),
//       CourseID    INT,
//       CourseTitle VARCHAR(60),
//       Grade       INT,
//       LetterGrade VARCHAR(2)
//   );
//   INSERT INTO student_final VALUES
//   (1, 'Karim Uddin',   101, 'Web Programming',            85, 'B'),
//   (2, 'Rahim Ahmed',   101, 'Web Programming',            92, 'A'),
//   (3, 'Jashim Hossain',102, 'Project Management',         78, 'C'),
//   (4, 'Jasica Ahmed',  101, 'Web Programming',            65, 'D'),
//   (5, 'Faria Karim',   102, 'Project Management',         95, 'A'),
//   (6, 'Niassoh Dihan', 103, 'System Analysis and Design', 80, 'B');
//
// PART 2 — the answer: PHP + MySQL bridge (Box 22). Local XAMPP MySQL runs on
// port 3307 -> 5th mysqli argument (in the exam: drop it, default port).
// Reset local data: re-run Final/MySQL/01_schema.sql
// ============================================================================

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "uiuweb_final";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------------------------------------------------------------------
// TASK 1 — total students per letter grade (A, B, C, D)
// ---------------------------------------------------------------------------
echo "<h3>Task 1: Students per letter grade</h3>";
$sql1 = "SELECT LetterGrade, COUNT(*) AS TotalStudents
         FROM student_final
         GROUP BY LetterGrade";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        echo $row["LetterGrade"] . " | " . $row["TotalStudents"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

// ---------------------------------------------------------------------------
// TASK 2 — grade below 75 and letter grade is not 'D' -> change letter to 'C'
// ---------------------------------------------------------------------------
echo "<h3>Task 2: Grades below 75 (not D) -> C</h3>";
$sql2 = "UPDATE student_final
         SET LetterGrade = 'C'
         WHERE Grade < 75 AND LetterGrade <> 'D'";
if ($conn->query($sql2) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 3 — grade above 80 -> +5 bonus points, but must stay <= 90
// ---------------------------------------------------------------------------
echo "<h3>Task 3: Grades above 80 -> +5 bonus (max 90)</h3>";
$sql3 = "UPDATE student_final
         SET Grade = Grade + 5
         WHERE Grade > 80 AND Grade + 5 <= 90";
if ($conn->query($sql3) === TRUE) {
    echo "Updated rows: " . $conn->affected_rows . "<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// ---------------------------------------------------------------------------
// TASK 4 — each course: title + student count, most popular course first
// ---------------------------------------------------------------------------
echo "<h3>Task 4: Students per course (most popular first)</h3>";
$sql4 = "SELECT CourseTitle, COUNT(*) AS TotalStudents
         FROM student_final
         GROUP BY CourseTitle
         ORDER BY TotalStudents DESC";
$result4 = $conn->query($sql4);
if ($result4 && $result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        echo $row["CourseTitle"] . " | " . $row["TotalStudents"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$conn->close();
?>

</body>
</html>

<?php
// ============================================================================
// BONUS — prepared statements: prepare -> bind_param -> execute
//
// WHY: user input (form data) must NEVER be pasted straight into SQL.
//      Prepared statements send the query and the data SEPARATELY, so the
//      data can never be executed as SQL — this blocks SQL injection.
//
// Run:  & "G:\xampp\php\php.exe" 12_php_mysql_prepared.php
// Re-runnable: it recreates its own demo table every time.
// ============================================================================

$conn = new mysqli("localhost", "root", "", "bank", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// demo table so this file can be re-run any time
$conn->query("CREATE TABLE IF NOT EXISTS demo_students (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    age INT
)");
$conn->query("DELETE FROM demo_students");

// ---- INSERT with prepare / bind / execute ----
$id   = 1;
$name = "Arif'; DROP TABLE demo_students; --";   // evil-looking input
$age  = 21;

$stmt = $conn->prepare("INSERT INTO demo_students (id, name, age) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $id, $name, $age);      // i = int, s = string, d = double
$stmt->execute();
$stmt->close();

echo "Inserted safely (stored as plain text, NOT executed): " . $name . "<br><br>";

// ---- SELECT with prepare / bind / execute ----
$minAge = 20;

$stmt = $conn->prepare("SELECT id, name, age FROM demo_students WHERE age >= ?");
$stmt->bind_param("i", $minAge);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo $row["id"] . " - " . $row["name"] . " - " . $row["age"] . "<br>";
}
$stmt->close();

$conn->close();

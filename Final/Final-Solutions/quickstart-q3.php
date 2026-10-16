<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Q3</title>
</head>

<body>

    <h2>Questions 3</h2>

    <?php
    // Q3 quickstart (Boxes 17, 18, 22) — the Box 22 PHP + MySQL bridge.
    // Each task block is independent — copy/delete to match the question.

    // PART 1 — create the DB/table FIRST in phpMyAdmin as plain SQL
    // (not PHP). Use the real names/values from the question:
    //
    //   CREATE DATABASE your_db;
    //   USE your_db;
    //   CREATE TABLE your_table (
    //       id     INT PRIMARY KEY,
    //       name   VARCHAR(50),
    //       amount DECIMAL(10,2)
    //   );
    //   INSERT INTO your_table VALUES (1, 'first row', 100), (2, 'second row', 250);
    //
    // PART 2 — the bridge below. Local XAMPP MySQL = port 3307 (5th argument);
    // in the exam drop it (default port).

    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "your_db";   // EDIT
    $port       = 3307;

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // TASK 1 — display/filter rows (EDIT: real table + columns)
    echo "<h3>Task 1</h3>";
    $sql1 = "SELECT * FROM your_table";   // EDIT: WHERE / ORDER BY as asked
    $result1 = $conn->query($sql1);
    if ($result1 && $result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            // EDIT: named columns (Box 22: always alias aggregates!)
            echo $row["name"] . " | " . $row["amount"] . "<br>";
        }
    } else {
        echo "0 results<br>";
    }

    // TASK 2 — guarded UPDATE (EDIT: real table/columns/condition)
    echo "<h3>Task 2</h3>";
    $sql2 = "UPDATE your_table SET amount = amount + 10 WHERE amount < 200";   // EDIT
    if ($conn->query($sql2) === TRUE) {
        echo "Updated rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }

    // TASK 3 — group/count/aggregate (EDIT: real GROUP BY / ORDER BY)
    echo "<h3>Task 3</h3>";
    $sql3 = "SELECT name, COUNT(*) AS TotalRows
         FROM your_table
         GROUP BY name
         ORDER BY TotalRows DESC";   // EDIT: ORDER BY the alias!
    $result3 = $conn->query($sql3);
    if ($result3 && $result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            echo $row["name"] . " | " . $row["TotalRows"] . "<br>";
        }
    } else {
        echo "0 results<br>";
    }

    // TASK 4 — value-change UPDATE with a cap guard (EDIT or DELETE if not asked)
    // Guard trick: put the limit inside WHERE (example: AND Bonus + 5 <= 90)
    echo "<h3>Task 4</h3>";
    $sql4 = "UPDATE your_table SET amount = amount * 1.10 WHERE amount < 300";   // EDIT
    if ($conn->query($sql4) === TRUE) {
        echo "Updated rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }

    $conn->close();
    ?>

</body>

</html>
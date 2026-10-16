<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Q3</title>
</head>

<body>

    <h2>Questions 3</h2>

    <?php

    $connn = new mysqli('localhost', 'root', '', "campus_library", 3307);
    if ($connn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }

    $sql1 = "SELECT Status,count(*) as total_books 
    from book_loans
    Group by Status
    Having count(*) > 1;
    ";

    $result1 = $connn->query($sql1);

    if ($result1 && $result1->num_rows > 0) {

        while ($row = $result1->fetch_assoc()) {
            echo $row["Status"] . " - " . $row["total_books"] . "<br>";
        }
    }



    ?>


</body>

</html>
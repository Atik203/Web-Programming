<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Q3</title>
</head>

<body>

    <h2>Questions 3</h2>

    <?php

    $conn = new mysqli('localhost', 'root', '', "campus_library", 3307);
    if ($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }

    $sql1 = "SELECT Status,count(*) as total_books 
    from book_loans
    Group by Status
    Having count(*) > 1;
    ";

    $result1 = $conn->query($sql1);

    if ($result1 && $result1->num_rows > 0) {

        while ($row = $result1->fetch_assoc()) {
            echo $row["Status"] . " - " . $row["total_books"] . "<br>";
        }
    }


    $sql2 = "UPDATE book_loans
    SET Status='Grace Period',PenaltyFee = 0.0
    WHERE Status='Overdue' and DaysOverdue < 7
    ";

    $result2 = $conn->query($sql2);

    if ($result2 && $result2 === TRUE) {
        echo "Updated rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }

    $sql3 = "UPDATE book_loans
    SET PenaltyFee = PenaltyFee * 1.10
    Where PenaltyFee > 20.00 and PenaltyFee * 1.10 <=50
    ";

    $result3 = $conn->query($sql3);

    if ($result3 && $result3 === TRUE) {
        echo "Updated rows: " . $conn->affected_rows . "<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }

    $sql4 = "SELECT BookTitle,SUM(PenaltyFee) as TotalPenalty
     From book_loans
     Group BY BookTitle
    order by TotalPenalty DESC
    ";

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
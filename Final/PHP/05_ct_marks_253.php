<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CT & Exam Marks Processor</title>
</head>
<body>

<h2>Student CT & Exam Marks</h2>

<form method="post">
    CT 1:       <input type="number" name="ct1" required><br><br>
    CT 2:       <input type="number" name="ct2" required><br><br>
    CT 3:       <input type="number" name="ct3" required><br><br>
    Midterm:    <input type="number" name="midterm" required><br><br>
    Final Exam: <input type="number" name="final" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 253 (Fall 2025) — Q1 (10 marks)
// Best TWO of three CTs -> average -> total = avg + midterm + final
// Status: 'Passed' if total > 54, otherwise 'Failed'
// Trick: best two = (sum of all three) - (smallest one), using min()
// ============================================================================

if (isset($_POST["submit"])) {
    $ct1     = $_POST["ct1"];
    $ct2     = $_POST["ct2"];
    $ct3     = $_POST["ct3"];
    $midterm = $_POST["midterm"];
    $final   = $_POST["final"];

    // 1) best two CTs = total of all three - the worst one
    $sumOfAll = $ct1 + $ct2 + $ct3;
    $bestTwo  = $sumOfAll - min($ct1, $ct2, $ct3);

    // 2) CT average (best two out of 2)
    $ctAverage = $bestTwo / 2;

    // 3) total marks
    $total = $ctAverage + $midterm + $final;

    // 4) pass/fail
    if ($total > 54) {
        $status = "Passed";
    } else {
        $status = "Failed";
    }

    echo "<h3>Result</h3>";
    echo "Best Two CT Total: " . $bestTwo . "<br>";
    echo "CT Average: " . $ctAverage . "<br>";
    echo "Total Marks: " . $total . "<br>";
    echo "Status: " . $status . "<br>";
}
?>

</body>
</html>

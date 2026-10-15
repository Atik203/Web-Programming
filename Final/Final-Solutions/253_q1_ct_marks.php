<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 253 — Q1: CT and Exam Marks Processor</title>
</head>
<body>

<h2>Student CT &amp; Exam Marks</h2>

<form method="post">
    CT 1:       <input type="number" name="ct1" required><br><br>
    CT 2:       <input type="number" name="ct2" required><br><br>
    CT 3:       <input type="number" name="ct3" required><br><br>
    Midterm:    <input type="number" name="midterm" required><br><br>
    Final Exam: <input type="number" name="final" required><br><br>
    <input type="submit" name="btnSubmit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 253 (Fall 2025) — Q1 (10 marks)          [cheat sheet: boxes 10, 13A, 16]
// Best TWO of three CTs (drop the lowest with min()) -> average ->
// total = CT average + midterm + final.  Status: "Passed" if total > 54.
// (Strict > per the paper: "if the total marks > 54")
// Example: 20,15,10 + mid 15 + final 25 -> avg 17.5, total 57.5 -> Passed
// ============================================================================

if (isset($_POST["btnSubmit"])) {
    $ct1     = intval($_POST["ct1"]);
    $ct2     = intval($_POST["ct2"]);
    $ct3     = intval($_POST["ct3"]);
    $midterm = intval($_POST["midterm"]);
    $final   = intval($_POST["final"]);

    $bestTwo = $ct1 + $ct2 + $ct3 - min($ct1, $ct2, $ct3);   // Box 13A: drop lowest
    $ctAvg   = $bestTwo / 2;                                 // average of best two
    $total   = $ctAvg + $midterm + $final;

    $status  = ($total > 54) ? "Passed" : "Failed";          // strict > (paper)

    echo "<h3>Result</h3>";
    echo "Best Two CT Total: " . $bestTwo . "<br>";
    echo "CT Average: " . $ctAvg . "<br>";
    echo "Total Marks: " . $total . "<br>";
    echo "Status: " . $status . "<br>";
}
?>

</body>
</html>

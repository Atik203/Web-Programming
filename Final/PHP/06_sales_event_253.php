<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Planning — Sales Report</title>
</head>
<body>

<h2>Event Sales Report</h2>

<form method="post">
    Items Sold per Day: <input type="number" name="itemsPerDay" required><br><br>
    Number of Days:     <input type="number" name="days" required><br><br>
    Target Items:       <input type="number" name="target" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 253 (Fall 2025) — Q2 (10 marks)
// total = itemsPerDay * days
// Classify:  >= 500 Excellent | >= 300 Good | >= 150 Average | else Poor
// Compare with target: above / below / exactly + difference
// Sample: 25/day, 12 days, target 300 -> total 300, Good, "Target met exactly"
//
// NOTE: the paper's sample table shows 400 as "Excellent", which contradicts the
// written rule (Excellent = 500 or more). This code follows the WRITTEN RULE.
// In the exam, follow the written conditions — that is what the grader marks.
// ============================================================================

if (isset($_POST["submit"])) {
    $itemsPerDay = $_POST["itemsPerDay"];
    $days        = $_POST["days"];
    $target      = $_POST["target"];

    // 1) total items sold
    $totalSold = $itemsPerDay * $days;

    // 2) performance category (check from highest to lowest!)
    if ($totalSold >= 500) {
        $performance = "Excellent";
    } elseif ($totalSold >= 300) {
        $performance = "Good";
    } elseif ($totalSold >= 150) {
        $performance = "Average";
    } else {
        $performance = "Poor";
    }

    // 3) compare with target
    if ($totalSold > $target) {
        $result = "Above target by " . ($totalSold - $target) . " items";
    } elseif ($totalSold < $target) {
        $result = "Below target by " . ($target - $totalSold) . " items";
    } else {
        $result = "Target met exactly (0 difference)";
    }

    echo "<h3>Result</h3>";
    echo "Total Items Sold: " . $totalSold . "<br>";
    echo "Performance: " . $performance . "<br>";
    echo "Target: " . $target . "<br>";
    echo "Result: " . $result . "<br>";
}
?>

</body>
</html>

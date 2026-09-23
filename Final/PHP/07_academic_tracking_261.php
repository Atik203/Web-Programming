<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Academic Tracking</title>
</head>
<body>

<h2>Student Academic Tracking</h2>

<form method="post">
    Credits Earned per Course: <input type="number" name="creditsPerCourse" required><br><br>
    Number of Courses Completed: <input type="number" name="coursesCompleted" required><br><br>
    Target Graduation Credits: <input type="number" name="targetCredits" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 261 SET-A (Spring 2026) — Q2 (10 marks)
// total = creditsPerCourse * coursesCompleted
// Classify: >= 120 Excellent | >= 90 Good | >= 60 Average | else Poor
// Compare with target: above / below / exactly + difference
// Sample: 4 credits, 30 courses, target 120 -> 120, Excellent, exactly met
// ============================================================================

if (isset($_POST["submit"])) {
    $creditsPerCourse  = $_POST["creditsPerCourse"];
    $coursesCompleted  = $_POST["coursesCompleted"];
    $targetCredits     = $_POST["targetCredits"];

    // 1) total credits earned
    $totalCredits = $creditsPerCourse * $coursesCompleted;

    // 2) progress category (check from highest to lowest!)
    if ($totalCredits >= 120) {
        $progress = "Excellent";
    } elseif ($totalCredits >= 90) {
        $progress = "Good";
    } elseif ($totalCredits >= 60) {
        $progress = "Average";
    } else {
        $progress = "Poor";
    }

    // 3) compare with target
    if ($totalCredits > $targetCredits) {
        $result = "Above target by " . ($totalCredits - $targetCredits);
    } elseif ($totalCredits < $targetCredits) {
        $result = "Below target by " . ($targetCredits - $totalCredits);
    } else {
        $result = "Target met exactly (0 difference)";
    }

    echo "<h3>Result</h3>";
    echo "Total Credits: " . $totalCredits . "<br>";
    echo "Progress: " . $progress . "<br>";
    echo "Target: " . $targetCredits . "<br>";
    echo "Result: " . $result . "<br>";
}
?>

</body>
</html>

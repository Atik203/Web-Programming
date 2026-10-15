<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 243 — Q2: Pizza Party Planner</title>
</head>
<body>

<h2>Pizza Party Planner</h2>

<form method="post">
    Number of Students: <input type="number" name="students" required><br><br>
    Slices per Student: <input type="number" name="slicesPerStudent" required><br><br>
    Slices per Pizza:   <input type="number" name="slicesPerPizza" required><br><br>
    <input type="submit" name="btnSubmit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 243 (Fall 2024) — Q2 (10 marks)          [cheat sheet: boxes 10, 12, 16]
// Whole pizzas only (ceil). Leftover slices + money wasted on them.
// Each pizza costs 1050 BDT -> price of ONE slice = 1050 / slicesPerPizza.
// calcAlloc() = Box 16 helper; the 5-line formula inside = Box 12.
// Sample: 10 students, 3 slices each, 8 slices/pizza
//      -> 4 pizzas, 2 leftover, 262.5 BDT      (7,2,6 -> 3,4,700 | 12,2,4 -> 6,0,0)
// ============================================================================

function calcAlloc($demand, $rate, $cap, $cost = 0) {
    $needed   = $demand * $rate;              // 1) total required
    $units    = ceil($needed / $cap);         // 2) whole items only (round UP)
    $supplied = $units * $cap;                // 3) capacity of what we ordered
    $left     = $supplied - $needed;          // 4) leftover / empty / unused
    return ["needed" => $needed, "units" => $units, "left" => $left,
            "wasted" => $left * $cost];       // 5) money wasted
}

if (isset($_POST["btnSubmit"])) {
    $students         = intval($_POST["students"]);
    $slicesPerStudent = intval($_POST["slicesPerStudent"]);
    $slicesPerPizza   = intval($_POST["slicesPerPizza"]);
    $pricePerPizza    = 1050;                                // fixed price (paper)

    $res = calcAlloc($students, $slicesPerStudent, $slicesPerPizza,
                     $pricePerPizza / $slicesPerPizza);

    echo "<h3>Result</h3>";
    echo "Total Pizzas: " . $res["units"] . "<br>";
    echo "Leftover Slices: " . $res["left"] . "<br>";
    echo "Wasted Money (BDT): " . $res["wasted"] . "<br>";
}
?>

</body>
</html>

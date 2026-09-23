<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pizza Party Planner</title>
</head>
<body>

<h2>Pizza Party Planner</h2>

<form method="post">
    Number of Students:  <input type="number" name="students" required><br><br>
    Slices per Student:  <input type="number" name="slicesPerStudent" required><br><br>
    Slices per Pizza:    <input type="number" name="slicesPerPizza" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 243 (Fall 2024) — Q2 (10 marks)
// Whole pizzas only (ceil). Leftover slices + money wasted on them.
// Each pizza costs 1050 BDT.
// Sample: 10 students, 3 slices each, 8 slices/pizza
//         -> 4 pizzas, 2 leftover, 262.5 BDT wasted
// ============================================================================

if (isset($_POST["submit"])) {
    $students          = $_POST["students"];
    $slicesPerStudent  = $_POST["slicesPerStudent"];
    $slicesPerPizza    = $_POST["slicesPerPizza"];
    $pizzaPrice        = 1050;

    // 1) total slices needed
    $totalNeeded = $students * $slicesPerStudent;

    // 2) whole pizzas only -> ceil (round UP)
    $totalPizzas = ceil($totalNeeded / $slicesPerPizza);

    // 3) leftover slices = capacity ordered - needed
    $totalSlices = $totalPizzas * $slicesPerPizza;
    $leftover    = $totalSlices - $totalNeeded;

    // 4) money wasted = leftover slices * price of ONE slice
    $pricePerSlice = $pizzaPrice / $slicesPerPizza;
    $wastedMoney   = $leftover * $pricePerSlice;

    echo "<h3>Result</h3>";
    echo "Total Pizzas: " . $totalPizzas . "<br>";
    echo "Leftover Slices: " . $leftover . "<br>";
    echo "Wasted Money (BDT): " . $wastedMoney . "<br>";
}
?>

</body>
</html>

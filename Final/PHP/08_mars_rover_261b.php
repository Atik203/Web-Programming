<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UIU Mars Rover — Battery Modules</title>
</head>
<body>

<h2>UIU Mars Rover — Battery Calculator</h2>

<form method="post">
    Mission Distance (meters):   <input type="number" name="distance" required><br><br>
    Energy per Meter:            <input type="number" name="energyPerMeter" required><br><br>
    Battery Module Capacity:     <input type="number" name="batteryCapacity" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 261 SET-B (Spring 2026) — Q2 (10 marks)
// required = distance * energyPerMeter
// modules  = ceil(required / capacity)  [whole modules only]
// unused   = modules*capacity - required
// Status by unused / total carried:
//   <= 10%  Efficient | <= 25% Acceptable | else Wasteful
// Sample: 1200m, 8/m, 5000 cap -> 9600 required, 2 modules, 400 unused, Efficient
// ============================================================================

if (isset($_POST["submit"])) {
    $distance        = $_POST["distance"];
    $energyPerMeter  = $_POST["energyPerMeter"];
    $batteryCapacity = $_POST["batteryCapacity"];

    // 1) total energy required
    $energyRequired = $distance * $energyPerMeter;

    // 2) minimum COMPLETE battery modules -> ceil
    $modules = ceil($energyRequired / $batteryCapacity);

    // 3) unused energy capacity
    $carriedEnergy = $modules * $batteryCapacity;
    $unusedEnergy  = $carriedEnergy - $energyRequired;

    // 4) efficiency status
    $unusedPercent = ($unusedEnergy / $carriedEnergy) * 100;

    if ($unusedPercent <= 10) {
        $status = "Efficient";
    } elseif ($unusedPercent <= 25) {
        $status = "Acceptable";
    } else {
        $status = "Wasteful";
    }

    echo "<h3>Result</h3>";
    echo "Total Energy Required: " . $energyRequired . "<br>";
    echo "Battery Modules Needed: " . $modules . "<br>";
    echo "Unused Energy: " . $unusedEnergy . "<br>";
    echo "Status: " . $status . "<br>";
}
?>

</body>
</html>

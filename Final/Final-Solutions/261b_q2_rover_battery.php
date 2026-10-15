<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 261 Set B — Q2: Mars Rover Battery Modules</title>
</head>
<body>

<h2>UIU Mars Rover — Battery Calculator</h2>

<form method="post">
    Mission Distance (meters): <input type="number" name="distance" required><br><br>
    Energy per Meter:          <input type="number" name="energyPerMeter" required><br><br>
    Battery Module Capacity:   <input type="number" name="batteryCapacity" required><br><br>
    <input type="submit" name="btnSubmit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 261 SET-B (Spring 2026) — Q2 (10 marks)  [cheat sheet: boxes 10, 12, 16]
// required = distance * energyPerMeter  |  modules = ceil(required / capacity)
// unused   = modules * capacity - required
// Status by unused / total carried:  <=10% Efficient | <=25% Acceptable | else Wasteful
// Sample: 1200m, 8/m, 5000 cap -> 9600 required, 2 modules, 400 unused, Efficient
//         1500,9,4000 -> 13500, 4, 2500, Acceptable | 1000,6,5000 -> 6000, 2, 4000, Wasteful
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
    $distance        = intval($_POST["distance"]);
    $energyPerMeter  = intval($_POST["energyPerMeter"]);
    $batteryCapacity = intval($_POST["batteryCapacity"]);

    $res      = calcAlloc($distance, $energyPerMeter, $batteryCapacity, 0);
    $supplied = $res["units"] * $batteryCapacity;      // total carried capacity
    $ratio    = $res["left"] / $supplied;              // unused share (Box 12)

    if ($ratio <= 0.10) {
        $status = "Efficient";
    } elseif ($ratio <= 0.25) {
        $status = "Acceptable";
    } else {
        $status = "Wasteful";
    }

    echo "<h3>Result</h3>";
    echo "Total Energy Required: " . $res["needed"] . "<br>";
    echo "Battery Modules Needed: " . $res["units"] . "<br>";
    echo "Unused Energy: " . $res["left"] . "<br>";
    echo "Status: " . $status . "<br>";
}
?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 251 — Q2: UIU Tech Fest Venue Booking</title>
</head>
<body>

<h2>UIU Tech Fest — Venue Booking</h2>

<form method="post">
    Expected Attendees: <input type="number" name="attendees" required><br><br>
    Cost per Person:    <input type="number" name="costPerPerson" required><br><br>
    Venue Capacity:     <input type="number" name="venueCapacity" required><br><br>
    <input type="submit" name="btnSubmit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 251 — Q2 (10 marks)                      [cheat sheet: boxes 10, 12, 16]
// Whole venues only (ceil). Empty seats + money wasted on them.
// DISTRACTOR: the 15,000 BDT per-venue cost is NOT used — the sample proves
// wasted money = empty seats * cost per person.
// number_format() matches the paper's sample output (8,400 / 3,000).
// Sample: 250 attendees, 120 BDT/person, 80 capacity
//      -> 4 venues, 70 empty seats, 8,400 BDT  (180,150,100 -> 2,20,3000)
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
    $attendees     = intval($_POST["attendees"]);
    $costPerPerson = intval($_POST["costPerPerson"]);
    $venueCapacity = intval($_POST["venueCapacity"]);

    $res = calcAlloc($attendees, 1, $venueCapacity, $costPerPerson);  // rate 1: attendees is a count

    echo "<h3>Result</h3>";
    echo "Total Venues: " . $res["units"] . "<br>";
    echo "Empty Seats: " . $res["left"] . "<br>";
    echo "Wasted Money (BDT): " . number_format($res["wasted"]) . "<br>";
}
?>

</body>
</html>

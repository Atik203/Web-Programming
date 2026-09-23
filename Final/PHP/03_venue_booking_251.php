<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UIU Tech Fest — Venue Booking</title>
</head>
<body>

<h2>UIU Tech Fest — Venue Booking</h2>

<form method="post">
    Expected Attendees:     <input type="number" name="attendees" required><br><br>
    Cost per Person:        <input type="number" name="costPerPerson" required><br><br>
    Venue Capacity:         <input type="number" name="venueCapacity" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 251 — Q2 (10 marks)
// Whole venues only (ceil). Empty seats + money wasted on them.
// The 15,000 BDT per-venue cost is a DISTRACTOR — the wasted-money formula
// from the sample output is: empty seats * cost per person.
// Sample: 250 attendees, 120 BDT/person, 80 capacity
//         -> 4 venues, 70 empty seats, 8,400 BDT
// ============================================================================

if (isset($_POST["submit"])) {
    $attendees      = $_POST["attendees"];
    $costPerPerson  = $_POST["costPerPerson"];
    $venueCapacity  = $_POST["venueCapacity"];

    // 1) whole venues only -> ceil (round UP)
    $totalVenues = ceil($attendees / $venueCapacity);

    // 2) empty seats
    $totalSeats = $totalVenues * $venueCapacity;
    $emptySeats = $totalSeats - $attendees;

    // 3) money wasted on empty seats
    $wastedMoney = $emptySeats * $costPerPerson;

    echo "<h3>Result</h3>";
    echo "Total Venues: " . $totalVenues . "<br>";
    echo "Empty Seats: " . $emptySeats . "<br>";
    echo "Wasted Money (BDT): " . $wastedMoney . "<br>";
}
?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FINAL 252 — Q2: Movie Night Screen Booking</title>
</head>
<body>

<h2>Movie Night — Screen Booking</h2>

<form method="post">
    Total People Attending:    <input type="number" name="attendees" required><br><br>
    Seat Capacity per Screen:  <input type="number" name="seatCapacity" required><br><br>
    Ticket Price per Seat:     <input type="number" name="ticketPrice" required><br><br>
    <input type="submit" name="btnSubmit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 252 (Summer 2025) — Q2 (10 marks)        [cheat sheet: boxes 10, 12, 16]
// Whole screens only (ceil). Empty seats + money wasted on them.
// DISTRACTOR: the 25,000 BDT screen rental is NOT used — the sample proves
// wasted money = empty seats * ticket price.
// number_format() matches the paper's sample output (15,000 / 8,000).
// Sample: 150 attendees, 60 seats, 500 BDT ticket
//      -> 3 screens, 30 empty seats, 15,000 BDT  (280,100,400 -> 3,20,8000)
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
    $attendees    = intval($_POST["attendees"]);
    $seatCapacity = intval($_POST["seatCapacity"]);
    $ticketPrice  = intval($_POST["ticketPrice"]);

    $res = calcAlloc($attendees, 1, $seatCapacity, $ticketPrice);   // rate 1: attendees is a count

    echo "<h3>Result</h3>";
    echo "Total Screens: " . $res["units"] . "<br>";
    echo "Empty Seats: " . $res["left"] . "<br>";
    echo "Wasted Money (BDT): " . number_format($res["wasted"]) . "<br>";
}
?>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movie Night — Screen Booking</title>
</head>
<body>

<h2>Movie Night — Screen Booking</h2>

<form method="post">
    Total People Attending: <input type="number" name="attendees" required><br><br>
    Seat Capacity per Screen: <input type="number" name="seatCapacity" required><br><br>
    Ticket Price per Seat:  <input type="number" name="ticketPrice" required><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

<hr>

<?php
// ============================================================================
// FINAL 252 (Summer 2025) — Q2 (10 marks)
// Whole screens only (ceil). Empty seats + wasted money.
// The 25,000 BDT screen rental is a DISTRACTOR — wasted money per the sample
// output is: empty seats * ticket price.
// Sample: 150 attendees, 60 seats, 500 BDT ticket
//         -> 3 screens, 30 empty seats, 15,000 BDT
// ============================================================================

if (isset($_POST["submit"])) {
    $attendees    = $_POST["attendees"];
    $seatCapacity = $_POST["seatCapacity"];
    $ticketPrice  = $_POST["ticketPrice"];

    // 1) whole screens only -> ceil (round UP)
    $totalScreens = ceil($attendees / $seatCapacity);

    // 2) empty seats
    $totalSeats = $totalScreens * $seatCapacity;
    $emptySeats = $totalSeats - $attendees;

    // 3) wasted money = unused seats * ticket price
    $wastedMoney = $emptySeats * $ticketPrice;

    echo "<h3>Result</h3>";
    echo "Total Screens: " . $totalScreens . "<br>";
    echo "Empty Seats: " . $emptySeats . "<br>";
    echo "Wasted Money (BDT): " . $wastedMoney . "<br>";
}
?>

</body>
</html>

<?php

function calculateDaysDifference($date1, $date2) {

    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);

    $interval = $date1->diff($date2);

    $totalDays = $interval->days;

    if ($totalDays % 2 == 0) {
        $oddOrEven = "even";
    } else {
        $oddOrEven = "odd";
    }

    echo "The number of days between " . $date1->format('Y-m-d') . " and " . $date2->format('Y-m-d') . " is $totalDays days, which is $oddOrEven.\n";
}

echo "Enter the first date (YYYY/MM/DD): ";
$handle = fopen("php://stdin", "r");
$date1 = trim(fgets($handle));

echo "Enter the second date (YYYY/MM/DD): ";
$date2 = trim(fgets($handle));

calculateDaysDifference($date1, $date2);

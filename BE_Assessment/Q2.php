<?php

function checkDiscount($purchaseValue) {
    if ($purchaseValue > 500) {
        $discount = 10; // more than or equal to 500 get 10% discount
    } elseif ($purchaseValue >= 100 && $purchaseValue <= 500) {
        $discount = 5; // between 100 and 500 get 5% discount
    } else {
        $discount = 0; // 0% discount if less than 100
    }

    if ($discount > 0) {
        echo "Purchase Value is $purchaseValue , discount is $discount%\n";
    } else {
        echo "Purchase Value is $purchaseValue , there are no discount.\n";
    }
}

while (true) {
    echo "Enter the purchase value ( E to exit the program): ";
    $handle = fopen("php://stdin", "r");
    $purchaseValue = trim(fgets($handle));

    if (($purchaseValue) == 'E' || strtolower($purchaseValue) == 'e') {
        echo "Exiting the program...\n";
        break; 
    }

    if (!is_numeric($purchaseValue) || $purchaseValue <= 0) { // cannot be less than or equal to 0
        echo "Invalid input. Please enter a positive number.\n";
        continue;
    }
    checkDiscount($purchaseValue);
}

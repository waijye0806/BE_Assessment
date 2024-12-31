<?php

$item_tier_rarity = [1, 2, 3, 4, 5]; // 1 is lowest, 5 is legend

$vip_rank = [ // rank 1-5, 1 is lowest, 5 is highest
    'v1' => [1, 2], 
    'v2' => [1, 2, 3],
    'v3' => [1, 2, 3, 4],
    'v4' => [1, 2, 3, 4, 5],
    'v5' => [1, 2, 3, 4, 5]
];

function roll_item($vip_rank) {
    global $item_tier_rarity;
    $available_tiers = $vip_rank;
    $random_value = rand(0, count($available_tiers) - 1); // generate random number of available tiers
    return $available_tiers[$random_value]; // return a randomly selected item tier
}

function simulate_rolls() {
    global $vip_rank, $item_tier_rarity;

    $results = []; // store the results for each VIP rank in an array

    foreach ($vip_rank as $rank => $available_tiers) {
        $results[$rank] = array_fill_keys($item_tier_rarity, 0);

        for ($i = 0; $i < 100; $i++) {
            $item = roll_item($available_tiers); // roll an item for this VIP rank
            $results[$rank][$item]++; 
        }
    }

    return $results;
}

$item_distribution = simulate_rolls();

print_r($item_distribution);

?>

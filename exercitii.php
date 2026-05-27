<?php
// ===== ZIUA 2 =====
error_log("Salut din consola PHP!");

$mesaj = "Salut din PHP!";
$nume = "FierForjat";
$an = date("Y");

echo "<h1>$mesaj</h1>";
echo "<p>Proiect: <strong>$nume</strong></p>";
echo "<p>Anul curent: <strong>$an</strong></p>";

$planuri = ["Starter", "Pro", "Elite"];
echo "<ul>";
foreach($planuri as $plan) {
    echo "<li>$plan</li>";
}
echo "</ul>";

// ===== ZIUA 3 - if si for =====
$numere = [4, 7, 12, 3, 8, 15, 6, 11, 2, 9];

$pare = 0;
$impare = 0;

for ($i = 0; $i < count($numere); $i++) {
    if ($numere[$i] % 2 == 0) {
        $pare++;
        echo "<p>{$numere[$i]} - par</p>";
    } else {
        $impare++;
        echo "<p>{$numere[$i]} - impar</p>";
    }
}

echo "<h3>Total pare: $pare</h3>";
echo "<h3>Total impare: $impare</h3>";
?>
<?php
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
?>
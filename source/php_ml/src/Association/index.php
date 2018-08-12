<?php
$samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
$labels  = [];

include 'Apriori.php';

$associator = new Apriori($support = 0.5, $confidence = 1);
$associator->train($samples, $labels);
print_r($associator->predict(['alpha','theta']));
echo "<hr>";
print_r($associator->getRules());
echo "<hr>";
print_r($associator->apriori());
?>
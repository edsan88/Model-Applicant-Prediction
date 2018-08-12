<?php
require_once "vadersentiment.php";

$textToTest = "find it easy";

$sentimenter = new SentimentIntensityAnalyzer();
$result = $sentimenter->getSentiment($textToTest);

print_r($result);
?>
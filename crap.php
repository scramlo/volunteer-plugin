<?php

$database_file = 'database.json';
$json_data = file_get_contents($database_file);
$tasks = json_decode($json_data);

echo '<html><body><pre>';
var_dump($tasks);
echo '</body></html></pre>';

$open_database = fopen($database_file, 'w') or die("Error opening database file");
fwrite($open_database, json_encode($tasks,JSON_PRETTY_PRINT));
fclose($open_database);

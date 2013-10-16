<?php
include 'functions.php';

header('Content-Type: text/plain');

$N = sample_size($_GET);

$samples = array();

srand(1);

for($i = 0; $i < $N; ++$i) {
 array_push($samples, rand());
}

print implode(', ', $samples);

?>

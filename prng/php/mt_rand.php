<?php
header('Content-Type: text/plain');

$N = sample_size($_GET);

$samples = array();

for($i = 0; $i < $N; ++$i) {
 array_push($samples, mt_rand());
}

print implode(', ', $samples);

?>

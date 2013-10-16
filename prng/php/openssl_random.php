<?php
include 'functions.php';

header('Content-Type: text/plain');

$N = sample_size($_GET);

$samples = array();

$b = true;

$bytes = openssl_random_pseudo_bytes($N, $b);

print bin2hex($bytes);

?>

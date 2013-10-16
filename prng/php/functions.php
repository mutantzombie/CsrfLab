<?php

function sample_size($arg)
{
  $N = isset($arg['samples']) ? intval($arg['samples']) : 1;

  if($N < 1) {
    print 'Minimum sample size = 1';
    die;
  }
  else if($N > 10000) {
    print 'Maximum sample size = 10000';
    die;
  }

  return $N;
}

?>

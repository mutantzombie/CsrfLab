<?php
session_start();

session_regenerate_id();

print session_id();
?>

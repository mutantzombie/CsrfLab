<?php
session_start();

if(!isset($_SESSION['n'])) {
  $_SESSION['n'] = 0;
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CORS Isolation - jQuery XHR</title>
<script src="/CsrfLab/js/jquery-2.0.3.min.js"></script>
<script src="code1.js"></script>
</head>
<body>
<div id="main">
  <form id="dragon" action="">
    <input id="act" type="hidden" name="act" value="increase">
    Value: <input id="gems" type="text" name="gems" value=""><br>
    <input type="submit">
  </form>
<br>
  <div id="results"></div>
</div>
<br>
<a href="reset.php">reset session</a>
</body>
</html>

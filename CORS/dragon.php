<?php
session_start();

function adjust($op, $value)
{
  $value = max(intval($value), 0);

  if(strcmp($op, 'increase') == 0)
    $_SESSION['n'] += $value;
  else if(strcmp($op, 'decrease') == 0)
    $_SESSION['n'] -= $value;
}

function checkCors()
{
  $requiredOrigin = 'web.site';
  $headers = apache_request_headers();

  $origin = getHeaderValue('Origin', $headers);
  $headers = getHeaderValue('Access-Control-Request-Headers', $headers);
  $methods = getHeaderValue('Access-Control-Request-Method', $headers);

  if($origin) {
    if(strcmp($requiredOrigin, $origin) != 0) {
      print "Origin {$origin} does not match {$requiredOrigin}\n";
      die;
    }
  }
  else {
    print 'Missing Origin';
    die;
  }
}

function getHeaderValue($name, $headers)
{
  if(array_key_exists($name, $headers))
    return $headers[$name];

  return null;
}

function reportHeader($name, $headers)
{
  if(array_key_exists($name, $headers))
    print "{$name} contains {$headers[$name]}\n";
  else
    print "{$name} missing\n";
}

function sendCors()
{
  $responseHeaders = array(
    'Access-Control-Allow-Origin'       => 'http://web.site',
    'Access-Control-Allow-Credentials'  => null,
    'Access-Control-Allow-Headers'      => 'X-CSRF',
//    'Access-Control-Allow-Methods'      => 'XCSRF',
    'Access-Control-Expose-Headers'     => null,
    'Access-Control-Max-Age'            => '10'
  );

  foreach($responseHeaders as $name => $value) {
    if($value)
      header("{$name}: {$value}");
  }

}

function sendResponse()
{
  header('Content-Type: application/json');

  $headers = apache_request_headers();

  $msg = '';

//  reportHeader('Origin', $headers);

  if(array_key_exists('X-CSRF', $headers)) {
    $csrf = $headers['X-CSRF'];
    if(strcmp($csrf, '1') == 0) {
      if(isset($_REQUEST['act']) && isset($_REQUEST['gems'])) {
        adjust($_REQUEST['act'], $_REQUEST['gems']);
      }
      $msg = array('n' => $_SESSION['n']);
    }
    else
      $msg = 'invalid X-CSRF header';
  }
  else
    $msg = 'missing X-CSRF header';

  print json_encode($msg);
}

if(strcmp(apache_getenv('REQUEST_METHOD'), 'OPTIONS') == 0)
  sendCors();
else
  sendResponse();

?>

<?php
function getRealIpAddr()
{
if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
{
	$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
{
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"]))
{
	$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
else
{
	$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}
$_SERVER['REMOTE_ADDR'] = getRealIpAddr();
require_once 'db.php';
?>
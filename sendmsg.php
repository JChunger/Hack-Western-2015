<?php
require_once('includes/main.php');
session_start();
$id = strip_tags(htmlentities($_GET['id']));
$craw = $odb ->prepare("SELECT * FROM `services` WHERE ID = :id");
$craw -> execute(array(":id" => $id));
$trill = $craw -> fetch(PDO::FETCH_ASSOC);

$thesix = $odb ->prepare("INSERT INTO `inbox` VALUES(NULL, :serv, :from, :to, 'Hi, I am interested in completeing your task. Get back to me!', 0, UNIX_TIMESTAMP())");
$thesix -> execute(array(':from' => $_SESSION['ID'], ':serv' => $trill['amount'], ':to' => $trill['uid']));
echo '<div class="alert alert-success"> Your Request has been sent in! </div>';


?>
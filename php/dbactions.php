<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/php/dbconnect.php'); //include database connectivity
require_once($_SERVER['DOCUMENT_ROOT'].'/php/dbdataget/dbgetdata.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/dbfunctions/dbfunctions.php');


$dbase = new dbase($dbh);
$lkbase = new lkbase($dbase);
$lkdata = new lkdata($dbase);
$data = json_decode(file_get_contents("php://input"));






require_once($_SERVER['DOCUMENT_ROOT'].'/php/dbdataget/dbdatarouter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/php/dbfunctions/dbfunctionsrouter.php');
?>

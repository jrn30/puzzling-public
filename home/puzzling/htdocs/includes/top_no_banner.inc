<?php
session_start();
$chosenStyle = $_SESSION['style'];

if (empty($chosenStyle)) {
	$chosenStyle = $_COOKIE['style'];
}

if (empty($chosenStyle) | !is_numeric($chosenStyle)) {
	$chosenStyle = 2;
}


$imgDir = "images/design".$chosenStyle."/";
?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$pagetitle ?></title>

<link rel="stylesheet" href="css/common.css" />
<link rel="stylesheet" href="css/style<?=$chosenStyle ?>.css" />

<script language="JavaScript" type="text/javascript" src="scripts/scripts.js" ></script>

<style type="text/css">

img#personphoto { float: right; }
body { background-image: none; margin: 5px; }

</style>

</head>

<body <?=$bodyOnLoad ?>>
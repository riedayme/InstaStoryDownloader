<?php defined('BASEPATH') OR exit('no direct script access allowed');

$is_index = true;
include "template/header.php";
?>

<?php 
if ($_POST) {
	include "modules/login/process.php";
}else{	
	include "modules/login/index.php";
}
?>

<?php
include "template/footer.php";
?>
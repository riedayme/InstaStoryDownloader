<?php defined('BASEPATH') OR exit('no direct script access allowed');

switch (@$_GET['page']) {

	case 'tos':
	$title = 'Term of Services';
	break;

	case 'privacy':
	$title = 'Privacy Policy';
	break;

	case 'howtouse':
	$title = 'How to use';
	break;

	case 'about':
	$title = 'About App';
	break;		

}	

include "template/header.php";
?>

<?php 
switch (@$_GET['page']) {
	case 'privacy':
	include "modules/pages/privacy.php";
	break;

	case 'tos':
	include "modules/pages/tos.php";
	break;

	case 'howtouse':
	include "modules/pages/howtouse.php";
	break;
	
	case 'about':
	include "modules/pages/about.php";
	break;


	default:
	header("Location: ./");
	break;
}
?>

<?php
include "template/footer.php";
?>
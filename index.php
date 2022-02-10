<?php define('BASEPATH', true); // protect script from direct access

require "includes/helper.php";
require "includes/config.php";

switch (@$_GET['module']) {	

	case 'pages':
	include "modules/pages.php";
	break;

	case 'imageproxy':
	include "modules/imageproxy.php";
	break;

	case 'logout':
	include "modules/logout.php";
	break;

	default:
	if (!isset($_SESSION['login'])) {
		include "modules/login.php";
	}else{
		include "modules/app.php";
	}
	break;
}
?>
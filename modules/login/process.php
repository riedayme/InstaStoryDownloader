<?php defined('BASEPATH') OR exit('no direct script access allowed');

require "library/InstagramStory.php";

$ig = new InstagramStory();


// check if cookie is json format
if ($ig->isJson($_POST['cookie'])) {
	// convert
	$_POST['cookie'] = $ig->ReadEditThisCookie($_POST['cookie']);
}

$login = $ig->Auth($_POST['cookie']);

if ($login['status']) {
	$_SESSION['login'] = $login['response'];
	header("location: ./");
}else {
	$_SESSION['error']['message'] = "<strong>Oops</strong>, ".$login['response'];
	header("location: ./");
}
<?php defined('BASEPATH') OR exit('no direct script access allowed');
include "template/header.php";
?>

<?php if (isset($_SESSION['login'])): ?>
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="alert alert-primary" role="alert">
				Welcome 
				<a target="_blank" class="text-decoration-none" href="https://instagram.com/<?php echo $_SESSION['login']['username'] ?>">
					<?php echo $_SESSION['login']['username'] ?>
				</a>, 
				<a href="?module=logout" class="alert-link text-decoration-none">
					Click here to Logout
				</a>.
			</div>
		</div>
	</div>
<?php endif ?>

<?php 
if ($_POST) {
	include "modules/app/process.php";
}else{	
	include "modules/app/index.php";
}
?>

<?php
include "template/footer.php";
?>
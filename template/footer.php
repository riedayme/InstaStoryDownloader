<?php defined('BASEPATH') OR exit('no direct script access allowed');?>

</div>
</div>

<footer class="footer mt-auto">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="p-3 bg-light rounded-top border-top border-start border-end">					
					<div class="row">
						<div class="col-5">
							<p class="m-0 fw-bold">
								&copy;<?php echo date('Y') ?> by <?php echo $appinfo['creator']; ?>
							</p>
						</div>
						<div class="col-7">
							<div class="text-end">						
								<?php include "template/nav.php"; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
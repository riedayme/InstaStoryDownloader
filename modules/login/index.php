<?php defined('BASEPATH') OR exit('no direct script access allowed');?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<main>				

			<?php if (isset($_SESSION['error'])): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
					</svg>
					<?php echo $_SESSION['error']['message']; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php unset($_SESSION['error']); ?>
			<?php endif ?>

			<form method="POST" class="form-floating">
				<div class="form-floating mb-3">
					<textarea name="cookie" required="" class="form-control" placeholder="Cookie" id="floatingtextarea" style="height: 200px"></textarea>
					<label for="floatingtextarea">Insert Instagram Cookie</label>
					<div id="emailHelp" class="form-text">If you don't familiar with cookie, <a class="text-decoration-none" href="?module=pages&page=howtouse">read this</a></div>
				</div>

				<button type="submit" class="btn btn-primary">
					Login
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
						<path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
					</svg>
				</button>
			</form>
		</main>
	</div>
</div>
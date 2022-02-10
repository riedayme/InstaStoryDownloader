<?php defined('BASEPATH') OR exit('no direct script access allowed');?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<main>				
			<form method="POST" class="form-floating">
				<div class="form-floating mb-3">
					<input onclick="this.select()" value="fvrskyla" required="" type="text" class="form-control" id="username" placeholder="username" name="username">
					<label for="username">Insert Instagram Username</label>
				</div>
				<button type="submit" class="btn btn-primary">
					Find Story
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
					</svg>
				</button>
			</form>
		</main>
	</div>
</div>
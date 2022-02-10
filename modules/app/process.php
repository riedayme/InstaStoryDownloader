<?php defined('BASEPATH') OR exit('no direct script access allowed');

require "library/InstagramStory.php";

$ig = new InstagramStory([
	'cookie' => $_SESSION['login']['cookie']
	]);

$storys = $ig->FeedStory($_POST['username']);
?>

<div class="row justify-content-center">
	<div class="col-md-6">

		<?php if (!$storys['status']): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $storys['response'] ?>, <a href="./" class="alert-link">Try Other Username</a>.
			</div>	
		<?php endif ?>

		<?php if ($storys['status']): ?>
			<div class="table-responsive mt-3">
				<table class="table table-bordered align-middle text-center">
					<thead>
						<tr>
							<th class="text-center" colspan="4" scope="col">
								List Story from <a target="_blank" class="text-decoration-none" href="https://instagram.com/<?php echo $_POST['username']; ?>">@<?php echo $_POST['username']; ?></a>
							</th>
						</tr>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Preview</th>
							<th scope="col">Type</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach ($storys['response'] as $story) {
							?>
							<tr>
								<th scope="row"><?php echo $no ?></th>
								<td>
									<a target="_blank" href="<?php echo $story['media']; ?>"><img style="width:150px" class="img-thumbnail" src="<?php echo base_url()."?module=imageproxy&url=".urlencode($story['thumbnail']) ?>"/></a>
								</td>
								<td>
									<?php 
									echo $story['type'];
									?>
								</td>
								<td>
									<a target="_blank" href="<?php echo base_url()."?module=imageproxy&download=1&id=".$story['id']."&url=".urlencode($story['media'])?>" download="<?php echo $story['id'] ?>" class="btn btn-primary btn-full-wdith">
										Download
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
											<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
											<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
										</svg>
									</a>
								</td>
							</tr>
							<?php
							$no++;
						} ?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center" colspan="4">
								<a href="./" class="btn btn-warning">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
										<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
										<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
									</svg>
									Try Other
								</a>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>	
		<?php endif ?>

	</div>
</div>
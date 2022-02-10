<?php defined('BASEPATH') OR exit('no direct script access allowed');?>

<div class="row justify-content-center">
	<div class="col-md-6">

		<article>
			<h2>
				About App
			</h2>

			<p>
				I made this for download story someone who i follow and her account is private, i need login for download story...
			</p>

			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>Name</td>
						<td>
							<?php echo $appinfo['name']; ?>
						</td>
					</tr>
					<tr>
						<td>Version</td>
						<td>
							<?php echo $appinfo['version']; ?>
						</td>
					</tr>
					<tr>
						<td>Creator</td>
						<td>
							<?php echo $appinfo['creator']; ?>
						</td>
					</tr>
					<tr>
						<td class=" u-text-center" colspan="2">Build With</td>
					</tr>
					<tr>
						<td class="u-p-medium u-text-bold" colspan="2">
							<span class="badge mb-1 bg-info">Bootstrap 5</span>&nbsp;
							<span class="badge mb-1 bg-primary">PHP Native</span>
						</td>
					</tr>       
				</tbody>
			</table>
		</article>

	</div>
</div>
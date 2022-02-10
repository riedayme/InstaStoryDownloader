<?php defined('BASEPATH') OR exit('no direct script access allowed');?>

<ul class="nav justify-content-end">
	<li class="nav-item">
		<a class="nav-link nav-link text-decoration-none text-dark fw-bold px-2 py-0 " href="./">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-heart-fill" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.707L8 2.207l6.646 6.646a.5.5 0 0 0 .708-.707L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
				<path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Zm0 5.189c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.691 0-5.018Z"/>
			</svg>
			Home
		</a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link text-decoration-none text-dark fw-bold px-1 py-0 dropdown-toggle" data-bs-toggle="dropdown" href="javascript:;" role="button" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
				<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
				<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
			</svg>
			Navigation
		</a>
		<ul class="dropdown-menu">
			<li><a class="dropdown-item" href="?module=pages&page=privacy">Privacy Policy</a></li>
			<li><a class="dropdown-item" href="?module=pages&page=tos">Tems of Service</a></li>
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="?module=pages&page=about">
				About App
			</a></li>
			<li><a target="_blank" class="dropdown-item" href="<?php echo $appinfo['contact']; ?>">
				Contact Me
			</a></li>
		</ul>
	</li>									
</ul>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Google maps </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Le styles -->
		<link href="bootstrap.min.css" rel="stylesheet">
		<style type="text/css">		body {
				padding-top: 20px;
				padding-bottom: 40px;
				
			}
			/* Custom container */
			.container-narrow {
				margin: 0 auto;
				max-width: 700px;
			}
			.container-narrow > hr {
				margin: 30px 0;
			}
			/* Main marketing message and sign up button */
			.jumbotron {
				margin: 60px 0;
				text-align: center;
			}
			.jumbotron h1 {
				font-size: 72px;
				line-height: 1;
			}
			.jumbotron .btn {
				font-size: 21px;
				padding: 14px 24px;
			}
			/* Supporting marketing content */
			.marketing {
				margin: 60px 0;
			}
			.marketing p + h4 {
				margin-top: 28px;
			}
</style>
	</head>
	<body>
		<div class="container-narrow">
			<div class="masthead">
				<ul class="nav nav-pills pull-right">
					<!-------------start menu ------- -->
					<!-------------end of menu ------- -->
				</ul>
				<h2 class="muted">Pencari Tujuan </h2>
			</div>
			<hr>
		<form class="form-inline" action='index.php' method="POST">
  <input type="text" name='asal' class="input-large" placeholder="Alamat asal">
  <input type="text"  name='tujuan'class="input-large" placeholder="Alamat Yang dituju">
 
  <button type="submit" class="btn btn-warning">Rute</button>
</form>
		
	<p class='lead'>
	Rute  Google maps
	</p>

<div class='span8'>
							<?php
	if(isset($_POST)) {
	$saddr = $_POST['asal'];
	$daddr = $_POST['tujuan'];
	include ('direction.php');
			}?>
						</div>
							</div>
							</body>
							</html>

<?php
session_start();
require 'functions.php';
$id = $_COOKIE['idreg'];
if (isset($_POST["submit"])) {
	if (form($_POST) > 0) {
		$result = mysqli_query($conn, "SELECT * FROM login WHERE id=$id");
		$row = mysqli_fetch_assoc($result);
		setcookie('id', $row['id']);
		setcookie('key', hash('sha256', $row['username']));
		$_SESSION["login"] = true;
		setcookie('idreg', '', time() - 36000);
		echo "<script>
               alert('User berhasil ditambahkan');
               document.location.href = 'user.php';
			</script>";
	};
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Formulir</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="css.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg  navbar-light" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href="index.php">Penjualan</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" name="barang" aria-expanded="false">
						Jenis
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="makanan.php">Makanan</a>
						<a class="dropdown-item" href="barang.php">Barang</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="admin.php">Semua</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Hubungi Kami</a>
				</li>
			</ul>
		</div>
	</nav>

	<div style="margin-top: 5%; margin-left: 2.5%;">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-md-auto">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id" value="<?= $id ?>">
						<div class="form-group">
							<label for="gambar">Gambar</label>
							<input type="file" name="gambar" class="form-control-file" id="gambar" required="">
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap" required="">
						</div>
						<div class="form-group">
							<label for="noidentitas">No. Identitas</label>
							<input type="text" name="noidentitas" class="form-control" id="noidentitas" placeholder="KTP/KK/NISN" required="" onkeypress="return Angkasaja(event)">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required="">
						</div>
						<div class="form-group">
							<label for="nohp">Nomor HP</label>
							<input type="text" name="nohp" class="form-control" id="nohp" placeholder="Nomor HP" required="" onkeypress="return Angkasaja(event)">
						</div>
						<div class="form-group">
							<label for="jk">Jenis Kelamin</label>
							<select class="form-control" name="jk" id="jk">
								<option>Laki-Laki</option>
								<option>Perempuan</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<script src="bootstrap-4.3.1\dist\js\jquery-3.3.1.slim.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\popper.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\jquery.min.js" type="text/javascript"></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

$id = $_COOKIE['id'];
$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id'");
$query = mysqli_fetch_assoc($login);
$formulir = query("SELECT * FROM formulir WHERE id = '$id'")[0];
if (isset($_POST["submit"])) {
	if (profil($_POST) > 0) {

		echo "
				<script>
					alert('Data berhasil diubah');
					document.location.href = 'user.php';
				</script>
			";
	} else {
		echo "
				<script>
					alert('Data gagal diubah');
					document.location.href = 'user.php';
				</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Ubah Data</title>
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
		<a class="navbar-brand" href="user.php">Penjualan</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="user.php">Home <span class="sr-only">(current)</span></a>
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
					<a class="nav-link" href="keranjang.php">Keranjang</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Hubungi Kami</a>
				</li>
			</ul>
			<ul class="navbar-nav mr-3">
				<li class="nav-item">
					<p class="">Selamat Datang, <b><?= $query['nama']; ?></b></p>
				</li>
			</ul>


			<div class="navbar-nav mr-1">
				<a class=" btn btn-primary nav-link" href="profil.php" role="button" aria-haspopup="true" aria-expanded="false" style="color:white; ">
					Profil
				</a>
			</div>
			<div class="navbar-nav mr-1">
				<a class=" btn btn-primary nav-link" href="logout.php" role="button" aria-haspopup="true" aria-expanded="false" style="color:white; ">
					Log Out
				</a>
			</div>
		</div>
	</nav>

	<div style="margin-top: 0.75%">
		<div class="container">
			<a class="btn btn-primary" href="user.php" role="button">Kembali</a>
			<div class="row justify-content-md-center">
				<div class="col-md-auto">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?= $formulir['id']; ?>">
						<input type="hidden" name="gambarLama" value="<?= $formulir["gambar"]; ?>">
						<div class="form-group">
							<label for="gambar">Gambar</label><br>
							<img src="img/<?= $formulir['gambar']; ?>" alt="" width="100" height="100">
							<input type="file" name="gambar" class="form-control-file" id="gambar">
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" class="form-control" id="nama" required="" value="<?= $formulir["nama"] ?>">
						</div>
						<div class="form-group">
							<label for="noidentitas">No. Identitas</label>
							<input type="text" name="noidentitas" class="form-control" id="noidentitas" placeholder="KTP/KK/NISN" required="" onkeypress="return Angkasaja(event)" value="<?= $formulir["noidentitas"] ?>">
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required="" value="<?= $formulir["email"] ?>">
						</div>
						<div class="form-group">
							<label for="nohp">Nomor HP</label>
							<input type="text" name="nohp" class="form-control" id="nohp" placeholder="Nomor HP" required="" onkeypress="return Angkasaja(event)" value="<?= $formulir["nohp"] ?>">
						</div>
						<div class="form-group">
							<label for="jk">Jenis Kelamin</label>
							<?php $jk = $formulir["jk"]; ?>
							<select class="form-control" name="jk" id="jk" required="">
								<option <?= $jk == 'Laki-Laki' ? "selected" : "" ?>>Laki-Laki</option>
								<option <?= $jk == 'Perempuan' ? "selected" : "" ?>>Perempuan</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- <script src="bootstrap-4.3.1\dist\js\jquery-3.3.1.slim.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\popper.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\jquery.min.js" type="text/javascript"></script> -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
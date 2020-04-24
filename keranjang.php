<?php
session_start();
if (!isset($_SESSION["login"])) {
	echo "<script>
               alert('Harus login terlebih dahulu!');
               document.location.href = 'login.php';
			</script>";
}

require 'functions.php';

$id = $_COOKIE["id"];
$row = query("SELECT * FROM keranjang WHERE id = $id");

$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id'");
$query = mysqli_fetch_assoc($login);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Keranjang</title>
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
						<a class="dropdown-item" href="user.php">Semua</a>
					</div>
				</li>
				<li class="nav-item active">
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
						<input type="hidden" name="id" value="<?= $row["id"]; ?>">
						<input type="hidden" name="gambarLama" value="<?= $row["gambar"]; ?>">
						<table border="1" cellspacing="" cellpadding="10">
							<tr>
								<th id="th">No.</th>
								<th id="th">Gambar Barang</th>
								<th id="th">Nama Barang</th>
								<th id="th">Harga</th>
								<th id="th">Banyak Barang</th>
								<th id="th">Total</th>
								<th id="th">-</th>
							</tr>
							<?php $no = 1; ?>
							<?php foreach ($row as $rows) : ?>
								<tr>
									<td id="td"><?= $no; ?></td>
									<td id="td"><img src="img/<?= $rows['gambar']; ?>" alt="" width="100" height="100"></td>
									<td id="td"><?= $rows["nama"]; ?></td>
									<td id="td"><?= $rows["harga"]; ?></td>
									<td id="td"><?= $rows["banyak"]; ?></td>
									<td id="td"><?= $rows["total"]; ?></td>
									<td id="td">
										<a href="ubahkeranjang.php?no=<?= $rows["no"]; ?>" class="btn btn-danger" role="button"><b>Ubah</b></a>
										<a href="hapuskeranjang.php?no=<?= $rows['no']; ?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-danger" role="button"><b>Hapus</b></a></p>
									</td>
								</tr>
								<?php $no++; ?>
							<?php endforeach; ?>
						</table>
						<?php if ($no == 1) { ?>
							<center>
								<h1>Kosong</h1>
							</center>
						<?php } else { ?>
							<br>ㅤ<a href="print.php" target="_blank" class="btn btn-success" role="button"><b>Nota</b></a>
						<?php } ?>
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
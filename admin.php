<?php
require 'functions.php';
$barang = query("SELECT * FROM barang");
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

$id = $_COOKIE['id'];

$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id'");
$query = mysqli_fetch_assoc($login);

if (isset($_POST["submit"])) {
	if (tambah($_POST) > 0) {
		echo "
				<script>
					alert('Data berhasil ditambahkan');
					document.location.href = 'admin.php';
				</script>
			";
	} else {
		echo "
				<script>
					alert('Data gagal ditambahkan');
					document.location.href = 'admin.php';
				</script>";
	}
}

// $id1 = 6;
// $barangg = query("SELECT * FROM barang WHERE id = $id1")[0];

if (isset($_POST["submit1"])) {
	if (ubah($_POST) > 0) {
		echo "
				<script>
					alert('Data berhasil diubah');
					document.location.href = 'admin.php';
				</script>
			";
	} else {
		echo "
				<script>
					alert('Data gagal diubah');
					document.location.href = 'admin.php';
				</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Penjualan</title>
	<link rel="stylesheet" type="text/css" href="css.css">
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
		<a class="navbar-brand" href="admin.php">Penjualan</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="dafus.php">Daftar User</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Hubungi Kami</a>
				</li>
			</ul>
			<ul class="navbar-nav mr-3">
				<li class="nav-item">
					<p class="" style="color: blue;"><i><b>Selamat Datang, <?= $query['nama']; ?></b></i></p>
				</li>
			</ul>


			<div class="navbar-nav mr-1">
				<a class=" btn btn-primary nav-link" href="profiladmin.php" role="button" aria-haspopup="true" aria-expanded="false" style="color:white; ">
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
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">
				Tambah Data
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row justify-content-md-center">
								<div class="col-md-auto">
									<form action="" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="gambar">Gambar</label><br>
											<input type="file" name="gambar" class="form-control-file" id="gambar">
										</div>
										<div class="form-group">
											<label for="nama">Nama</label>
											<input type="text" name="nama" class="form-control" id="nama" required="" placeholder="Nama Barang">
										</div>
										<div class="form-group">
											<label for="harga">Harga</label>
											<input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required="" onkeypress="return Angkasaja(event)">
										</div>
										<div class="form-group">
											<label for="stok">Stok</label>
											<input type="text" name="stok" class="form-control" id="stok" placeholder="Stok Barang" required="" onkeypress="return Angkasaja(event)">
										</div>
										<div class="form-group">
											<label for="jenis">Jenis Barang</label>
											<select class="form-control" name="jenis" id="jenis">
												<option>Makanan</option>
												<option>Barang</option>
											</select>
										</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-danger" name="submit">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="margin-top: 0.5%; margin-left: 2.5%;">
		<?php foreach ($barang as $row) : ?>
			<table border="1" cellpadding="10" cellspacing="0" style="display: inline-table; margin-top: 0.5%;">

				<td><img src="img/<?= $row["gambar"]; ?>" width="150" height="150"></td>
				<tr>
					<td style="	padding:2;">
						<p>Nama : <?php echo $row["nama"]; ?></p>
						<p>Harga : <?php echo $row["harga"]; ?></p>
						<p>Stok : <?php echo $row["stok"]; ?></p>
					</td>
				</tr>
				<td>
					<!-- Button trigger modal -->
					<a href="admin.php?id=<?= $row["id"]; ?>" role="button" name="test" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong1<?= $row["id"]; ?>">
						<b>Ubah</b>
					</a>
					<?php
					$id1 = $row["id"];
					$barangg = query("SELECT * FROM barang WHERE id = $id1")[0];
					?>
					<!-- Modal -->
					<div class="modal fade" id="exampleModalLong1<?= $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Ubah Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row justify-content-md-center">
										<div class="col-md-auto">
											<div class="container">
												<div class="row justify-content-md-center">
													<div class="col-md-auto">
														<form action="" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?= $barangg["id"]; ?>">
															<input type="hidden" name="gambarLama" value="<?= $barangg["gambar"]; ?>">
															<div class="form-group">
																<label for="gambar">Gambar</label><br>
																<img src="img/<?= $barangg['gambar']; ?>" alt="" width="100" height="100">
																<input type="file" name="gambar" class="form-control-file" id="gambar">
															</div>
															<div class="form-group">
																<label for="nama">Nama</label>
																<input type="text" name="nama" class="form-control" id="nama" required="" placeholder="Nama Barang" value="<?= $barangg["nama"] ?>">
															</div>
															<div class="form-group">
																<label for="harga">Harga</label>
																<input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required="" onkeypress="return Angkasaja(event)" value="<?= $barangg["harga"] ?>">
															</div>
															<div class="form-group">
																<label for="stok">Stok</label>
																<input type="text" name="stok" class="form-control" id="stok" placeholder="Stok Barang" required="" onkeypress="return Angkasaja(event)" value="<?= $barangg["stok"] ?>">
															</div>
															<div class="form-group">
																<label for="jenis">Jenis Barang</label>
																<?php $jenis = $barangg["jenis"]; ?>
																<select class="form-control" name="jenis" id="jenis" required="">
																	<option <?= $jenis == 'Makanan' ? "selected" : "" ?>>Makanan</option>
																	<option <?= $jenis == 'Barang' ? "selected" : "" ?>>Barang</option>
																</select>
															</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-danger" name="submit1">Simpan</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Button trigger modal -->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
						<b>Hapus</b>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Apakah Anda yakin ?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
									<a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-danger" role="button">Iya</a>
								</div>
							</div>
						</div>
					</div>
				</td>
			</table>
		<?php endforeach; ?>
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
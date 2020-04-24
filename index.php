<?php
session_start();


require 'functions.php';
if (isset($_SESSION["login"])) {
	$id = $_COOKIE['id'];
	$resultt = mysqli_query($conn, "SELECT * FROM login WHERE id = '$id'");
	$row = mysqli_fetch_assoc($resultt);
	if ($row['status'] === '1') {
		header("Location: admin.php");
		exit;
	} else {
		header("Location: user.php");
		exit;
	}
}
$barang = query("SELECT * FROM barang");

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELECT username FROM login WHERE id=$id");
	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {

			if (isset($_POST['remember'])) {
				setcookie('id', $row['id'], time() + 120);
				setcookie('key', hash('sha256', $row['username']), time() + 120);
			}

			if ($row['status'] === '1') {
				$_SESSION["login"] = true;
				setcookie('id', $row['id']);
				setcookie('key', hash('sha256', $row['username']));
				header("Location:admin.php");
				exit;
			} else if ($row['status'] === '0') {
				$_SESSION["login"] = true;
				setcookie('id', $row['id']);
				setcookie('key', hash('sha256', $row['username']));
				header("Location:user.php");
				exit;
			}
		}
	}
	$error = true;
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
	<link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">

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
				<li class="nav-item active">
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


			<div class="navbar-nav mr-1">
				<li class="nav-item dropdown">
					<a class=" btn btn-primary nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white; ">
						Login
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<form action="" method="post" class="px-4 py-3">

							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" id="username" placeholder="username" autofocus="">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Password">
							</div>
							<div class="form-group">
								<?php if (isset($error)) : ?>
									<p style="color: red; font-style: italic;">Username / Password salah!</p>
								<?php endif; ?>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="remember" name="remember">
								<label class="form-check-label" for="remember">
									Remember me
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="login">Login</button>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="registrasi.php">Belum Punya Akun? Registrasi</a>
						</form>

					</div>
				</li>
			</div>
			<div class="navbar-nav mr-1">
				<a class=" btn btn-primary nav-link" href="registrasi.php" role="button" aria-haspopup="true" aria-expanded="false" style="color:white; ">
					Registrasi
				</a>
			</div>
		</div>
	</nav>



	<div style="margin-top: 5%; margin-left: 2.5%;">
		<?php foreach ($barang as $row) : ?>
			<table border="1" cellpadding="10" cellspacing="0" style="display: inline-table; margin-top: 0.5%;">

				<?php if ($row["stok"] > 0) { ?>
					<td><img src="img/<?= $row["gambar"]; ?>" width="150" height="150"></td>
				<?php } else if ($row["stok"] == 0) { ?>
					<td>
						<img src="img/<?= $row["gambar"]; ?>" width="150" height="150" style="position: absolute; opacity: 0.4; filter: alpha(opacity=40);">
						<img src="img/stok_habis.png" width="150" height="150" style="position: relative;">
					</td>
				<?php } ?>
				<tr>
					<td style="	padding:2;">
						<p>Nama : <?php echo $row["nama"]; ?></p>
						<p>Harga : <?php echo $row["harga"]; ?></p>
						<p>Stok : <?php echo $row["stok"]; ?></p>
					</td>
				</tr>
				<td>
					<?php if ($row["stok"] > 0) { ?>
						<p style="	text-align: center;"><a href="beli.php?id=<?= $row["id"]; ?>" class="btn btn-warning" role="button" disabled><b>Beli</b></a></p>
					<?php } else if ($row["stok"] == 0) { ?>
						<p style="  text-align: center;"><a href="beli.php?id=<?= $row["id"]; ?>" class="btn btn-warning disabled" role="button" disabled><b>Beli</b></a></p>
					<?php } ?>
			</table>
		<?php endforeach; ?>
	</div>

	<script src="bootstrap-4.3.1\dist\js\jquery-3.3.1.slim.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\popper.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\bootstrap.min.js"></script>
	<script src="bootstrap-4.3.1\dist\js\jquery.min.js" type="text/javascript"></script>
</body>

</html>
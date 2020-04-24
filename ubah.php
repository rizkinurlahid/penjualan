<?php
session_start();
	if(!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	} 
	require 'functions.php';

	$id= $_GET["id"];
	$barang = query("SELECT * FROM barang WHERE id = $id")[0];

	if(isset($_POST["submit"])){
		if(ubah($_POST) > 0){
			echo "
				<script>
					alert('Data berhasil diubah');
					document.location.href = 'admin.php';
				</script>
			";	
		}else {
			echo "
				<script>
					alert('Data gagal diubah');
					document.location.href = 'admin.php';
				</script>";
			}
	}

	$id1 = $_COOKIE['id'];

	$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id1'");
	$query = mysqli_fetch_assoc($login);
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
    <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">

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
        <p class="" style="color: blue;"><i><b>Selamat Datang, <?= $query['nama'];?></b></i></p>
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
		<a class="btn btn-primary" href="admin.php" role="button">Kembali</a>
	<div class="row justify-content-md-center">
		<div class="col-md-auto">
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?=$barang["id"];?>">
		<input type="hidden" name="gambarLama" value="<?=$barang["gambar"];?>">
	  <div class="form-group">
	    <label for="gambar">Gambar</label><br>
	    <img src="img/<?= $barang['gambar']; ?>" alt="" width="100" height="100">
    <input type="file" name="gambar" class="form-control-file" id="gambar">
	  </div>
	  <div class="form-group">
	    <label for="nama">Nama</label>
	    <input type="text" name="nama" class="form-control" id="nama" required="" placeholder="Nama Barang" value="<?= $barang["nama"] ?>">
	  </div>
	  <div class="form-group">
	  	<label for="harga">Harga</label>
	    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required="" onkeypress="return Angkasaja(event)" value="<?= $barang["harga"] ?>">
	  </div>
	  <div class="form-group">
	  	<label for="stok">Stok</label>
	    <input type="text" name="stok" class="form-control" id="stok" placeholder="Stok Barang" required="" onkeypress="return Angkasaja(event)" value="<?= $barang["stok"] ?>">
	  </div>
	  <div class="form-group">
	  	<label for="jenis">Jenis Barang</label>
	    	<?php $jenis = $barang["jenis"]; ?>
	    <select class="form-control" name="jenis" id="jenis" required="">
  		<option <?= $jenis == 'Makanan' ? "selected": "" ?>>Makanan</option>
  		<option <?= $jenis == 'Barang' ? "selected": "" ?>>Barang</option>
		</select>
	  </div>
	  <button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
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
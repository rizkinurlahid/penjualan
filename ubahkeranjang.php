<?php 
	session_start();
	if(!isset($_SESSION["login"])){
		echo "<script>
               alert('Harus login terlebih dahulu!');
               document.location.href = 'login.php';
			</script>";	
	}		
		
	require 'functions.php';
	$no = $_GET["no"];
	$row = query("SELECT * FROM keranjang WHERE no = $no")[0];

	$barang = query("SELECT * FROM barang WHERE id = $no")[0];


	$id = $_COOKIE["id"];
	$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id'");
	$query = mysqli_fetch_assoc($login);

	if(isset($_POST["submit"])){
		if(ubahkeranjang($_POST) > 0){
			echo "
				<script>
					alert('Data berhasil diubah');
					document.location.href = 'keranjang.php';
				</script>
			";	
		}else {
			echo "
				<script>
					alert('Data gagal diubah');
					
				</script>";
			}
	}
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
    <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css">

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
        <p class="">Selamat Datang, <b><?= $query['nama'];?></b></p>
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
		<a class="btn btn-primary" href="keranjang.php" role="button">Kembali</a>
	<div class="row justify-content-md-center">
		<div class="col-md-auto">
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="no" value="<?=$row["no"];?>">
		<input type="hidden" name="id" value="<?=$row["id"];?>">
		<input type="hidden" name="total" value="<?=$row["total"];?>">
		<input type="hidden" name="gambar" value="<?=$row["gambar"];?>">
		<input type="hidden" name="nama" value="<?=$row["nama"];?>">
		<input type="hidden" name="harga" value="<?=$row["harga"];?>">
		<input type="hidden" name="banyakLama" value="<?=$row["banyak"];?>">
		<input type="hidden" name="id1" value="<?=$barang["id"];?>">
		<input type="hidden" name="nama" value="<?=$barang["nama"];?>">
		<input type="hidden" name="harga" value="<?=$barang["harga"];?>">
		<input type="hidden" name="stok" value="<?=$barang["stok"];?>">
		<input type="hidden" name="jenis" value="<?=$barang["jenis"];?>">
	  <div class="form-group">
	    <label for="gambar">Gambar</label><br>
	    <img src="img/<?= $row['gambar']; ?>" alt="" width="100" height="100">
    <input type="file" name="gambar" class="form-control-file" id="gambar">
	  </div>
	  <div class="form-group">
	    <label for="nama">Nama</label>
	    <input type="text" name="nama" class="form-control" id="nama" required="" placeholder="Nama Barang" value="<?= $row["nama"] ?>" disabled>
	  </div>
	  <div class="form-group">
	  	<label for="harga">Harga</label>
	    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required="" onkeypress="return Angkasaja(event)" value="<?= $row["harga"] ?>" disabled>
	  </div>
	  <div class="form-group">
	  	<label for="banyak">Banyak Barang</label>
	    <input type="number" name="banyak" class="form-control" id="banyak" placeholder="Banyak Barang" required="" value="<?= $row["banyak"] ?>" autofocus>
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
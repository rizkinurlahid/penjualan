<?php
require 'functions.php';
$barang = query("SELECT * FROM barang WHERE jenis = 'barang'");
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$id = $_COOKIE['id'];
$login = mysqli_query($conn, "SELECT * FROM formulir WHERE id = '$id'");
$query = mysqli_fetch_assoc($login);

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
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" name="barang" aria-expanded="false">
            Jenis
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="makanan.php">Makanan</a>
            <a class="dropdown-item" href="barang.php">Barang</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="user.php">Semua</a>
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

  <div style="margin-top: 5%; margin-left: 2.5%;">
    <?php foreach ($barang as $row) : ?>
      <table border="1" cellpadding="10" cellspacing="0" style="display: inline-table; margin-top: 0.5%;">

        <td><img src="img/<?= $row["gambar"]; ?>" width="150" height="150"></td>
        <tr>
          <td style=" padding:2;">
            <p>Nama : <?php echo $row["nama"]; ?></p>
            <p>Harga : <?php echo $row["harga"]; ?></p>
            <p>Stok : <?php echo $row["stok"]; ?></p>
          </td>
        </tr>
        <td>
          <p style="  text-align: center;"><a href="beli.php?id=<?= $row["id"]; ?>" class="btn btn-warning" role="button"><b>Beli</b></a></p>
        </td>
      </table>
    <?php endforeach; ?>
  </div>

  <script src="bootstrap-4.3.1\dist\js\jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap-4.3.1\dist\js\popper.min.js"></script>
  <script src="bootstrap-4.3.1\dist\js\bootstrap.min.js"></script>
  <script src="bootstrap-4.3.1\dist\js\jquery.min.js" type="text/javascript"></script>
</body>

</html>
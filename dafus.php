<?php
require 'functions.php';
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$inner = mysqli_query($conn, "SELECT login.status,formulir.nama, login.username,login.id FROM login LEFT JOIN formulir ON login.id=formulir.id");

$id = $_COOKIE["id"];
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
    <a class="navbar-brand" href="admin.php">Penjualan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
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
      <a class="btn btn-primary" href="admin.php" role="button">Kembali</a>
      <div style="margin-top: 0.75%">
        <div class="row justify-content-md-center">
          <div class="col-md-auto">
            <form action="" method="post" enctype="multipart/form-data">
              <table border="1" cellspacing="" cellpadding="10">
                <tr>
                  <th>No.</th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th style="text-align: center;">-</th>
                </tr>
                <?php $no = 1; ?>
                <?php foreach ($inner as $row) : ?>
                  <?php if ($row['status'] == 0) : ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $row["nama"] ?></td>
                      <td><?= $row["username"] ?></td>
                      <td>
                        <a href="hapususer.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda yakin?');" class="btn btn-danger" role="button"><b>Hapus</b></a>
                      </td>
                    </tr>
                    <?php $no++; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </table>
              <?php if ($no == 1) : ?>
                <center>
                  <h1>Kosong</h1>
                </center>
              <?php endif; ?>
            </form>
          </div>
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
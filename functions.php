<?php
//$conn = mysqli_connect("sql310.epizy.com", "epiz_24132456", "FlCWAMYeea","epiz_24132456_penjualan" );
$conn = mysqli_connect("localhost", "root", "", "penjualan");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	global $conn;
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	$jenis = $data["jenis"];

	$query = "INSERT INTO barang
					values 
					('', '$gambar', '$nama', '$harga', '$stok', '$jenis' )";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if ($error === 4) {
		echo "<script>
					alert('Pilih gambar terlebih dahulu!');
				  </script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
					alert('Bukan gambar!');
				  </script>";
		return false;
	}

	if ($ukuranFile > 1000000) {
		echo "<script>
					alert('Ukuran file terlalu besar!');
				  </script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
	return mysqli_affected_rows($conn);
}

function hapuskeranjang($no)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM keranjang WHERE no=$no");
	return mysqli_affected_rows($conn);
}

function hapususer($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM login WHERE id=$id");
	mysqli_query($conn, "DELETE FROM formulir WHERE id=$id");
	mysqli_query($conn, "DELETE FROM keranjang WHERE id=$id");
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$jenis = $data["jenis"];

	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE barang SET 
					gambar = '$gambar',
					nama = '$nama',
					harga = '$harga',
					stok = '$stok',
					jenis = '$jenis' 
					WHERE id = $id
					";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function ubahkeranjang($data)
{
	global $conn;
	$no = $data["no"];
	$id = $data["id"];
	$id1 = $data["id1"];
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$banyakLama = $data["banyakLama"];
	$banyak = $data["banyak"];
	$stok = $data["stok"];
	$jenis = $data["jenis"];


	$gambar = $data["gambar"];

	if ($banyak > $banyakLama) {
		$banyakFIX = $banyak;
		$stokFIX = $stok - ($banyak - $banyakLama);
	} else if ($banyak < $banyakLama) {
		$banyakFIX = $banyak;
		$stokFIX = ($banyakLama - $banyak) + $stok;
	}
	$total = $harga * $banyakFIX;

	$query = "UPDATE keranjang SET
					banyak = '$banyakFIX',
					total = '$total'
					WHERE no = $no
					";
	mysqli_query($conn, $query);
	$query1 = "UPDATE barang SET 
					stok = '$stokFIX'					
					WHERE id = $id1
					";
	mysqli_query($conn, $query1);
	return mysqli_affected_rows($conn);
}

function register($data)
{
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$passwordd = mysqli_real_escape_string($conn, $data["passwordd"]);

	$result = mysqli_query($conn, "SELECT username FROM login WHERE username='$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
              alert('Username sudah terdaftar!');
			</script>";
		return false;
	}

	if ($password !== $passwordd) {
		echo "<script>
              alert('Konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);


	mysqli_query($conn, "INSERT INTO login VALUES ('', '$username', '$password' , '0')");
	return mysqli_affected_rows($conn);
}

function form($data)
{
	global $conn;
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$noidentitas = htmlspecialchars($data["noidentitas"]);
	$email = htmlspecialchars($data["email"]);
	$nohp = htmlspecialchars($data["nohp"]);
	$jk = htmlspecialchars($data["jk"]);
	$query = "INSERT INTO formulir
					VALUES 
					('$id', '$gambar', '$nama', '$noidentitas', '$email', '$nohp', '$jk' )";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function profil($data)
{
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$noidentitas = htmlspecialchars($data["noidentitas"]);
	$email = htmlspecialchars($data["email"]);
	$nohp = htmlspecialchars($data["nohp"]);
	$jk = htmlspecialchars($data["jk"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE formulir SET 
					gambar = '$gambar',
					nama = '$nama',
					noidentitas = '$noidentitas',
					email = '$email',
					nohp = '$nohp',
					jk = '$jk' 
					WHERE id = $id
					";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function keranjang($data)
{
	global $conn;

	$id = $data["id"];
	$id1 = $data["id1"];
	$gambar = $data["gambar"];
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);
	$banyak = $data["banyak"];
	$total = $harga * $banyak;
	$stok = $data["stok"];
	$jenis = $data["jenis"];
	if ($banyak < $stok) {
		$hasil = $stok - $banyak;
	} else if ($banyak == $stok) {
		$hasil = 0;
	} else if ($banyak > $stok) {
		$hasil = $stok;
		echo "<script>
			alert('Banyak barang terlalu besar');
			</script>";
		return false;
	}

	$query1 = "UPDATE barang SET 
					gambar = '$gambar',
					nama = '$nama',
					harga = '$harga',
					stok = '$hasil',
					jenis = '$jenis' 
					WHERE id = $id1
					";
	mysqli_query($conn, $query1);

	$ker = query("SELECT * FROM keranjang");
	foreach ($ker as $row) {
		if ($row['no'] == $id1) {
			if ($row['id'] == $id) {
				$banyakk = $row['banyak'] + $banyak;
				$totall = $harga * $banyakk;


				$query1 = "UPDATE keranjang SET 
					banyak = '$banyakk',
					total = '$totall' 
					WHERE no = $id1
					";
				mysqli_query($conn, $query1);
				echo "<script>
				alert('Pembelian sedang diproses!');
					document.location.href = 'user.php';
				</script>";


				// stop();
			}
		}
	}
	$checkIdProduct = query("SELECT * FROM keranjang WHERE no = $id1")[0];
	if ($checkIdProduct == true) {
		$query = "UPDATE keranjang SET 
					banyak = '$banyakk',
					total = '$totall' 
					WHERE no = $id1
					";
	} else {
		$query = "INSERT INTO keranjang
						values 
						('', '$id1', '$id',  '$gambar', '$nama', '$harga', '$banyak', '$total' )";
	}

	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}



?>
<html>
<script type="text/javascript">
	function Angkasaja(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>

</html>
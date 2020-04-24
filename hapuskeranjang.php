<?php 
	require 'functions.php';
	$no = $_GET["no"];
	$row = query("SELECT * FROM keranjang WHERE no = $no")[0];

	$barang = query("SELECT * FROM barang WHERE id = $no")[0];


	$id1 = $no;
		$gambar = $barang["gambar"];
		$nama = $barang["nama"];
		$harga = $barang["harga"];
		$stok = $barang["stok"];
		$jenis = $barang["jenis"];

		$banyak = $row["banyak"];
		
		$stokFIX = $stok+$banyak;

		$query1 = "UPDATE barang SET 
					gambar = '$gambar',
					nama = '$nama',
					harga = '$harga',
					stok = '$stokFIX',
					jenis = '$jenis' 
					WHERE id = $id1
					";
		mysqli_query($conn, $query1);

	if(hapuskeranjang($no) > 0){
						echo "
				<script>
					alert('Data berhasil dihapus');
					document.location.href = 'keranjang.php';
				</script>
			";			

	
	}else{
		echo "
				<script>
					alert('Data gagal dihapus');
					document.location.href = 'keranjang.php';
				</script>
			";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id1" value="<?=$barang["id"];?>">
	<input type="hidden" name="gambar" value="<?=$barang["gambar"];?>">
		<input type="hidden" name="nama" value="<?=$barang["nama"];?>">
		<input type="hidden" name="harga" value="<?=$barang["harga"];?>">
		<input type="hidden" name="stok" value="<?=$barang["stok"];?>">
		<input type="hidden" name="jenis" value="<?=$barang["jenis"];?>">
		<input type="hidden" name="banyak" value="<?=$row["banyak"];?>">
	</form>
</body>
</html>
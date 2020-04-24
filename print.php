<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nota Pembelian</title>
</head>
<body>
	<center><h2>Data Barang</h2></center>

	<?php require 'functions.php'; ?>
	<center>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Banyak Barang</th>
			<th>Total</th>
		</tr>
		<?php 
		$id = $_COOKIE["id"];
		$no=1;
		$sql=mysqli_query($conn,"SELECT * FROM keranjang WHERE id=$id");
		while($data=mysqli_fetch_array($sql)){
		?>
		<tr>
			<td style="text-align: center;"><?= $no++ ?></td>
			<td><?= $data['nama'] ?></td>
			<td style="text-align: center;"><?= $data['harga'] ?></td>
			<td style="text-align: center;"><?= $data['banyak'] ?></td>
			<td style="text-align: center;"><?= $data['total'] ?></td>
		</tr>
		<?php } ?>
		</table>

		<?php 
			$qry = mysqli_query($conn, "SELECT SUM(total) from keranjang WHERE id=$id");
			$data = mysqli_fetch_array($qry);
			$jumlah = $data[0];
		?>
		<p>Total Harga : <?= $jumlah ?></p>
		</center>
		<script>
			window.print();
		</script>
</body>
</html>
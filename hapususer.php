<?php 
	require 'functions.php';
	$id= $_GET["id"];

	if(hapususer($id) > 0){
						echo "
				<script>
					alert('Data berhasil dihapus');
					document.location.href = 'dafus.php';
				</script>
			";			

	
	}else{
		echo "
				<script>
					alert('Data berhasil dihapus');
					document.location.href = 'dafus.php';
				</script>
			";
	}
?>
<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM pembayaran WHERE id_pembayaran=".$_GET['id_pembayaran'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo $error;
		die();
	}

  	echo "<script>
			window.location.href='index.php?lihat=pembayaran/index';
	</script>";
?>
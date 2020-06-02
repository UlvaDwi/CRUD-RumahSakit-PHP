<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM pasien WHERE id_pasien=".$_GET['id_pasien'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo $error;
		die();
	}

  	echo "<script>
			window.location.href='index.php?lihat=pasien/index';
	</script>";
?>
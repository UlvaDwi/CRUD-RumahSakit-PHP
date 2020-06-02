<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM inap WHERE id_inap=".$_GET['id_inap'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo $error;
		die();
	}

  	echo "<script>
			window.location.href='index.php?lihat=inap/index';
	</script>";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form, table{
	border: 3px solid #f1f1f1;
	background-color: white;
	font-family: arial;
	width: 500px;
	margin: auto;
	padding: 20px;
}
	</style>
</head>
<body>

</body>
</html>
<div class="row">
	<div class="col-lg-6">
		<h3 class = "text-primary">Tambah Data Obat</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			
			<div class="form-group">
				<label>Nama Obat</label>
				<input type="text" class="form-control" name="nama_obat" placeholder="Masukan Nama Obat" required>
			</div>
			
			<div class="form-group">
				<label>Harga</label>
				<input type="text" class="form-control" name="harga" placeholder="Masukan Harga" required>
			</div>

        	<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-floppy-disk"></span> Simpan
        	</button>
        	
		</form>
	</div>
</div>

<?php
require_once('koneksi.php');

if($_POST){
	try {

		//Menuliskan query tambah
		$sql = "INSERT INTO obat (id_obat,nama_obat, harga) VALUES ('".$_POST['id_obat']."','".$_POST['nama_obat']."','".$_POST['harga']."')";

		//Cek jika query salah
		if(!$koneksi->query($sql)){
			echo $koneksi->error;
			die();
		}

	} 

	//Cek jika terjadi error
	catch (Exception $error) {
		echo $error;
		die();
	}
	 
	echo "<script>
			window.location.href='index.php?lihat=obat/index';
		  </script>";
}
?>
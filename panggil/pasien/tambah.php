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
</html><div class="row">
	<div class="col-lg-6">
		<h3 class = "text-primary">Tambah Data Pasien</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama_pasien" placeholder="Masukan Nama" required>
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label><br>
				<input name="jk" type="radio" value="Laki-laki" > Laki-laki
				<input name="jk" type="radio" value="Perempuan"> Perempuan
			</div>
			<div class="form-group">
				<label>No Telp</label>
				<input type="text" class="form-control" name="no_telp" placeholder="Masukan No Telp" required>
			</div>
			<div class="form-group">
          		<label>Alamat</label>
          		<textarea class="form-control" name="alamat" placeholder="Masukan Alamat" required></textarea>
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
		$sql = "INSERT INTO pasien (id_pasien,nama_pasien, jk, no_telp, alamat) VALUES ('".$_POST['id_pasien']."','".$_POST['nama_pasien']."','".$_POST['jk']."','".$_POST['no_telp']."','".$_POST['alamat']."')";

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
			window.location.href='index.php?lihat=pasien/index';
		  </script>";
}
?>
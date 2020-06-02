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
		<h3 class = "text-primary">Tambah Data Detail Obat</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<div class="form-group">
				<label>Id Inap</label>
				<select class="form-control" name="id_inap">
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM inap ORDER BY id_inap");
					echo "<option>--Pilih Id Inap--</option>";
					while($row = mysqli_fetch_assoc($result)){

						echo "<option value=$row[id_inap]>$row[id_inap]</option>";
					} 
					?>
					</select>
			</div>
			
			<div class="form-group">
				<label>Nama Obat</label>
				<select class="form-control" name="id_obat">
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM obat ORDER BY id_obat");
					echo "<option>--Pilih nama obat--</option>";
					while($row = mysqli_fetch_assoc($result)){

						echo "<option value=$row[id_obat]>$row[nama_obat]</option>";
					} 
					?>
					</select>
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
		$sql = "INSERT INTO detail_obat (id_detail,id_inap, id_obat) VALUES ('".$_POST['id_detail']."','".$_POST['id_inap']."','".$_POST['id_obat']."')";

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
			window.location.href='index.php?lihat=detail_obat/index';
		  </script>";
}
?>
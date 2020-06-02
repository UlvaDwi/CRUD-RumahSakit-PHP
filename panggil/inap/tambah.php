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
<?php
error_reporting(0);
	require_once('koneksi.php');
?>
<div class="row">
	<div class="col-lg-6">
		<h3 class = "text-primary">Tambah Data Rawat Inap</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<div class="form-group">
				<label>Nama pasien</label>
				<select class="form-control" name="id_pasien">
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM pasien ORDER BY id_pasien");
					echo "<option>--Pilih nama pasien--</option>";
					while($row = mysqli_fetch_assoc($result)){

						echo "<option value=$row[id_pasien]>$row[nama_pasien]</option>";
					} 
					?>
					</select>
				</div>
				
			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" class="form-control" id="combo_masuk" name="tgl_masuk" required>
			</div>
			<div class="form-group">
				<label>Tanggal Keluar</label>
				<input type="date" class="form-control" id="combo_keluar" name="tgl_keluar">
			</div>			
			<div class="form-group">
				<label>Nama kamar</label>
				<select class="form-control" name="id_kamar">
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM kamar ORDER BY id_kamar");
					echo "<option>--Pilih nama kamar--</option>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<option value=$row[id_kamar]>$row[nama_kamar]</option>";
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


if($_POST){
	try {

	   $date1 = $_POST['tgl_masuk'];
	   $date2 = $_POST['tgl_keluar'];
	   
	   $lama = ((abs(strtotime ($date2) - strtotime ($date1)))/(60*60*24));
		     
		//Menuliskan query tambah
		$sql = "INSERT INTO inap (id_inap, tgl_masuk, tgl_keluar, lama, id_pasien, id_kamar) VALUES ('".$_POST['id_inap']."','".$_POST['tgl_masuk']."','".$_POST['tgl_keluar']."','".$lama."','".$_POST['id_pasien']."','".$_POST['id_kamar']."')";

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
			window.location.href='index.php?lihat=inap/index';
		  </script>";
}
?>

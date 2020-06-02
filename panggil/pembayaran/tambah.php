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
		<h3 class = "text-primary">Tambah Data Pembayaran</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">	
			<div class="form-group">
				<label>Tanggal Pembayaran</label>
				<input type="date" class="form-control" name="tanggal" required>
			</div>
			<div class="form-group">
				<label>Id Inap</label>
				<select class="form-control" name="id_inap">
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM inap where status=0 ORDER BY id_inap ");
					echo "<option>--PILIH ID INAP--</option>";
					while($row = mysqli_fetch_assoc($result)){
						echo "<option>$row[id_inap]</option>";
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
		$pembayaran_kamar =  mysqli_fetch_array($koneksi->query("select bayarkamar from view_pembayarankamar where id_inap = ".$_POST['id_inap']));
		$pembayaran_obat = mysqli_fetch_array($koneksi->query("select totalObat from view_pembayaranobat where id_inap= ".$_POST['id_inap']));

		$total = $pembayaran_kamar['bayarkamar'] + $pembayaran_obat['totalObat'];
		$sql = "INSERT INTO pembayaran VALUES ('','".$_POST['tanggal']."','".$_POST['id_inap']."', $total)";
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
			window.location.href='index.php?lihat=pembayaran/index';
		  </script>";
}
?>
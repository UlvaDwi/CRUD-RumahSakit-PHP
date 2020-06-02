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
	require_once('koneksi.php');
	if($_POST){

		$sql = "UPDATE kamar SET nama_kamar='".$_POST['nama_kamar']."', kelas='".$_POST['kelas']."', kapasitas='".$_POST['kapasitas']."', harga='".$_POST['harga']."' WHERE id_kamar=".$_POST['id_kamar'];

		if ($koneksi->query($sql) === TRUE) {
		    echo "<script>
		window.location.href='index.php?lihat=kamar/index';
		</script>";
		} else {
		    echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	}

	else{
		$query = $koneksi->query("SELECT * FROM kamar WHERE id_kamar=".$_GET['id_kamar']);

		if($query->num_rows > 0){
			$data = mysqli_fetch_object($query);
		}else{
			echo "Data tidak tersedia";
			die();
		}
	}
?>

<div class="row">
	<div class="col-lg-6">
		<h3 class = "text-primary">Edit Data Kamar</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<input type="hidden" name="id_kamar" value="<?= $data->id_kamar?>">
			
			<div class="form-group">
				<label>Nama Kamar</label>
				<input type="text" value="<?= $data->nama_kamar ?>" class="form-control" name="nama_kamar">
			</div>
			
			<div class="form-group">
				<label>Kelas</label><br>
				<select value="<?= $data->kelas ?>" class="form-control" name="kelas">
          			<option>--pilih kelas</option><option>VIP</option>
          			<option>Ekonomi</option>
          		</select>
			</div>
			
			<div class="form-group">
				<label>Kapasitas</label>
				<input type="text" value="<?= $data->kapasitas ?>" class="form-control" name="kapasitas">
			</div>
			<div class="form-group">
				<label>Tarif</label>
				<input type="text" value="<?= $data->harga ?>" class="form-control" name="harga">
			</div>
			
			<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-pencil"></span> Ubah
        	</button>
		</form>
	</div>
</div>


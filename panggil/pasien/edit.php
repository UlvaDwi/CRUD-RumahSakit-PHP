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
</html><?php
	require_once('koneksi.php');
	if($_POST){

		$sql = "UPDATE pasien SET nama_pasien='".$_POST['nama_pasien']."', jk='".$_POST['jk']."', no_telp='".$_POST['no_telp']."', alamat='".$_POST['alamat']."' WHERE id_pasien=".$_POST['id_pasien'];

		if ($koneksi->query($sql) === TRUE) {
		    echo "<script>
		window.location.href='index.php?lihat=pasien/index';
		</script>";
		} else {
		    echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	}

	else{
		$query = $koneksi->query("SELECT * FROM pasien WHERE id_pasien=".$_GET['id_pasien']);

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
		<h3 class = "text-primary">Edit Data Pasien</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<input type="hidden" name="id_pasien" value="<?= $data->id_pasien ?>">
			<div class="form-group">
				<label>Nama Pasien</label>
				<input type="text" value="<?= $data->nama_pasien ?>" class="form-control" name="nama_pasien" required>
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label><br>
				<input name="jk" type="radio" value="Laki-laki"> Laki-laki
				<input name="jk" type="radio" value="Perempuan"> Perempuan
			</div>
			<div class="form-group">
				<label>No Telp</label>
				<input type="text" value="<?= $data->no_telp ?>" class="form-control" name="no_telp" required>
			</div>
			<div class="form-group">
            	<label>Alamat</label>
            	<textarea class="form-control" name="alamat" required><?php  echo $data->alamat; ?></textarea>
          	</div>
			
			<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-pencil"></span> Ubah
        	</button>
		</form>
	</div>
</div>


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

		$sql = "UPDATE obat SET nama_obat='".$_POST['nama_obat']."', harga='".$_POST['harga']."' WHERE id_obat=".$_POST['id_obat'];

		if ($koneksi->query($sql) === TRUE) {
		    echo "<script>
		window.location.href='index.php?lihat=obat/index';
		</script>";
		} else {
		    echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	}

	else{
		$query = $koneksi->query("SELECT * FROM obat WHERE id_obat=".$_GET['id_obat']);

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
		<h3 class = "text-primary">Edit Data Obat</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<input type="hidden" name="id_obat" value="<?= $data->id_obat ?>">
			<div class="form-group">
				<label>Nama Obat</label>
				<input type="text" value="<?= $data->nama_obat ?>" class="form-control" name="nama_obat" required>
			</div>
			
			<div class="form-group">
				<label>Harga</label>
				<input type="text" value="<?= $data->harga ?>" class="form-control" name="harga" required>
			</div>
			
			
			<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-pencil"></span> Ubah
        	</button>
		</form>
	</div>
</div>


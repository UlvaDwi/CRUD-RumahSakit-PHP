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
		$pembayaran_kamar =  mysqli_fetch_array($koneksi->query("select bayarkamar from view_pembayarankamar where id_inap = ".$_POST['id_inap']));
		$pembayaran_obat = mysqli_fetch_array($koneksi->query("select totalObat from view_pembayaranobat where id_inap= ".$_POST['id_inap']));
		$total = $pembayaran_kamar['bayarkamar'] + $pembayaran_obat['totalObat'];
		
		$sql = "UPDATE pembayaran SET tanggal='".$_POST['tanggal']."', id_inap='".$_POST['id_inap']."', total= $total WHERE id_pembayaran=".$_POST['id_pembayaran'];

		if ($koneksi->query($sql) === TRUE) {
		    echo "<script>
		window.location.href='index.php?lihat=pembayaran/index';
		</script>";
		} else {
		    echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
		
	}

	else{
		$query = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembayaran=".$_GET['id_pembayaran']);
		$result = mysqli_num_rows($query);
		if($result > 0){
			$data = mysqli_fetch_object($query);
		}else{
			echo "Data tidak tersedia";
			die();
		}
	}
?>

<div class="row">
	<div class="col-lg-6">
		<h3 class = "text-primary">Edit Data Pembayaran</h3>
		<hr style = "border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<input type="hidden" name="id_pembayaran" value="<?= $data->id_pembayaran ?>" >
			<div class="form-group">
				<label>Tanggal Pembayaran</label>
				<input type="date" value="<?= $data->tanggal?>" class="form-control" name="tanggal">
			</div>
			<div class="form-group">
				<label>Id Inap</label>
				
					<select class="form-control" name="id_inap" > 
					<?php
					$con = mysqli_connect("localhost","root","","rumah_sakit");
					$result = mysqli_query($con,"SELECT *FROM inap ORDER BY id_inap  ");
					echo "<option value='$data->id_inap?'>$data->id_inap</option>";
					while($row = mysqli_fetch_assoc($result)){

						echo "<option>$row[id_inap]</option>";
					} 
					?>
					</select>

			</div>
			
			
			<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-pencil"></span> Ubah
        	</button>
		</form>
	</div>
</div>


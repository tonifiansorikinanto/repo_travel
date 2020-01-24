<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php';

if(isset($_SESSION["user_access"])){

if(isset($_GET['nomer']) && isset($_GET['tb'])){
	$nomer = $_GET['nomer'];
	$table_name = $_GET['tb'];

	if($table_name == "tb1"){
		$data_perNomer = show_data_onNomer_tbSiluet($nomer);
	}else{
		$data_perNomer = show_data_onNomer_tbLiza($nomer);
	}

	while($data = mysqli_fetch_assoc($data_perNomer)){
		$nama = $data['nama'];
		$alamat = $data['alamat'];
		$tanggal = $data['tanggal'];
		$jam = $data['jam'];
		$tujuan = $data['tujuan'];
		$lunas = $data['lunas'];
		$harga_khusus = $data['harga_khusus'];
	}

}else{
	header('Location: admin.php');
}


if(isset($_POST['edit'])){
	$namaEdit 				= $_POST['nama'];
	$alamatEdit 			= $_POST['alamat'];
	$tglEdit 					= $_POST['tgl'];
	$jamEdit 					= $_POST['jam'];
	$tujuanEdit 			= $_POST['tujuan'];
	$lunasEdit 				= $_POST['lunas'];
	$harga_khususEdit = $_POST['harga_khusus'];

	if(!empty(trim($namaEdit)) && !empty(trim($alamatEdit)) && !empty(trim($tglEdit)) &&
	!empty(trim($jamEdit)) && !empty(trim($tujuanEdit)) && !empty(trim($lunasEdit)) && !empty(trim($harga_khususEdit))){

		if($table_name == "tb1"){
			if(edit_data_tbSiluet($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				header('Location: admin-siluet.php');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang.php?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}else{
			if(edit_data_tbLiza($nomer, $namaEdit, $alamatEdit, $tglEdit, $jamEdit, $tujuanEdit, $lunasEdit, $harga_khususEdit)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				header('Location: admin-liza.php');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang.php?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}

	}
}


?>

<div class="container">
	<div class="row justify-content-center mt-3">
		<div class="col-md-10">
			<h1 class="h1-responsive deep-purple-text">Edit</h1>
            
			<form method="post" action="">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?= $nama; ?>">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Alamat</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"><?= $alamat; ?></textarea>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Tanggal Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="date" aria-label="nomer" name="tgl" id="nomer" class="form-control z-depth-1"  value="<?= $tanggal; ?>">										
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Jam Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" placeholder="14:00" autocomplete="off"  value="<?= $jam; ?>">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Tujuan</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="tujuan" id="nama" class="form-control z-depth-1" autocomplete="off"  value="<?= $tujuan; ?>">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Lunas / BA</h4>
									</div>
									<div class="col-md-12">
										<select name="lunas" id="durasi1" class="form-control">
                      <option value="0">- Pilih Status Pembayaran -</option>
                      <option value="1" <?php if($lunas == "1") echo "selected='selected'"; ?>>Lunas</option>
                      <option value="2" <?php if($lunas == "2") echo "selected='selected'"; ?>>BA</option>					                      
                    </select>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive text-primary">Harga Khusus</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="harga_khusus" id="nomer" class="form-control z-depth-1" autocomplete="off"  value="<?= $harga_khusus; ?>">
									</div>
								</div>
							</div>		                  
						</div>
						<div align="right" class="my-4">
			  				<button type="submit" name="edit" class="btn btn-warning btn-md" style="width: 130px;" onclick="return confirm('Yakin ingin merubah data ?')">Edit Data</button>
			  			<?php if($table_name == "tb1"): ?>
			  				<a type="button" class="btn btn-info btn-md" href="admin-siluet.php" style="width: 130px;">Kembali</a>
			  			<?php else: ?>
			  				<a type="button" class="btn btn-info btn-md" href="admin-liza.php" style="width: 130px;">Kembali</a>
			  			<?php endif; ?>
			  			</div>
					</div>
				</div>				
			</form>

		</div>
	</div>
</div>

<?php 
require_once 'assets/templates/footer.php'; 

}else{
	header('Location: login-admin.php');
}

?>
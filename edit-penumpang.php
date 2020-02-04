<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php';

$table_name = $_GET['tb'];

if(isset($_SESSION["user_access"])){

if(isset($_SESSION["pass_supervisor"])){

if(isset($_GET['nomer']) && isset($_GET['tb'])){
	$nomer = $_GET['nomer'];

	if($table_name == "tb1"){
		$data_perNomer = show_data_onNomer_tbSiluet($nomer);
	}else{
		$data_perNomer = show_data_onNomer_tbLiza($nomer);
	}

	while($data = mysqli_fetch_assoc($data_perNomer)){
		$nomerOri = $data['nomer'];
		$nama = $data['nama'];
		$alamat = $data['alamat'];
		$jemput = $data['jemput'];
		$tanggal = $data['tanggal'];
		$jam = $data['jam'];
		$ket = $data['ket'];
		$tujuan = $data['tujuan'];
		$lunas = $data['lunas'];
		$penumpang = $data['penumpang'];
		$harga_khusus = $data['harga_khusus'];
	}

	$day 			= substr($tanggal, 0, 2);
	$month 		= substr($tanggal, 3, 2);
	$year 		= substr($tanggal, 6, 4);

	$tanggal 	= $year . "-" . $month . "-" . $day;

}else{
	if($table_name == "tb1"){
		header('Location: admin-siluet.php');
	}else{
		header('Location: admin-liza.php');
	}
}


if(isset($_POST['edit'])){
	$nomerEdit	 			= $_POST['nomer'];
	$namaEdit 				= $_POST['nama'];
	$alamatEdit 			= $_POST['alamat'];
	$jemputEdit				= $_POST['jemput'];
	$tglEdit 					= $_POST['tgl'];
	$jamEdit 					= $_POST['jam'];
	$tujuanEdit 			= $_POST['tujuan'];
	$penumpangEdit		= $_POST['penumpang'];
	$lunasEdit 				= $_POST['lunas'];
	$harga_khususEdit = $_POST['harga_khusus'];
	$ketEdit 					= $_POST['ket'];

	if(!empty(trim($nomerEdit)) && !empty(trim($namaEdit)) && !empty(trim($alamatEdit)) && !empty(trim($jemputEdit)) && !empty(trim($tglEdit)) &&
	!empty(trim($jamEdit)) && !empty(trim($tujuanEdit)) && !empty(trim($penumpangEdit)) && !empty(trim($lunasEdit)) && !empty(trim($harga_khususEdit)) && !empty(trim($ketEdit))){

		$day 			= substr($tglEdit, 8, 2);
  	$month 		= substr($tglEdit, 5, 2);
  	$year 		= substr($tglEdit, 0, 4);

  	$tglEdit 	= $day . "-" . $month . "-" . $year;

		if($table_name == "tb1"){
			if(edit_data_tbSiluet($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				unset($_SESSION["pass_supervisor"]);
				header('Location: admin-siluet.php');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang.php?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}else{
			if(edit_data_tbLiza($nomerEdit, $namaEdit, $alamatEdit, $jemputEdit, $tglEdit, $jamEdit, $tujuanEdit, $penumpangEdit, $lunasEdit, $harga_khususEdit, $ketEdit, $nomer)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Mengubah Data " . $namaEdit);
				unset($_SESSION["pass_supervisor"]);
				header('Location: admin-liza.php');
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Mengubah Data " . $namaEdit);
				header('Location: edit-penumpang.php?tb=' . $table_name . '&nomer=' . $nomer . '');
			}
		}

	}
}

?>

<?php

if(isset($_SESSION['report_message'])){
	echo $_SESSION['report_message'];
	unset($_SESSION['report_message']);
}

?>


<div class="container">
	<div class="row justify-content-center mt-3">
		<div class="col-md-10">
			<h1 class="h1-responsive deep-purple-text">Edit</h1>
            
			<form method="post" action="">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row text-primary">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Nomer</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="nomer" id="nomer" class="form-control z-depth-1" autocomplete="off" value="<?= $nomerOri; ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?= $nama; ?>">
									</div>

									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Alamat Tetap</h4>
									</div>
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Alamat Jemput</h4>
									</div>
									<div class="col-md-6">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"><?= $alamat; ?></textarea>
									</div>
									<div class="col-md-6">
										<textarea class="form-control z-depth-1" name="jemput" style="height: 100px;" id="exampleFormControlTextarea6"><?= $jemput; ?></textarea>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Tanggal Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="date" aria-label="nomer" name="tgl" id="nomer" class="form-control z-depth-1"  value="<?= $tanggal; ?>">
									</div>
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Keterangan</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="ket" style="height: 100px;" id="exampleFormControlTextarea6"><?= $ket; ?></textarea>
									</div>

								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Jam Berangkat</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" placeholder="14:00" autocomplete="off"  value="<?= $jam; ?>">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Tujuan</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="tujuan" id="nama" class="form-control z-depth-1" autocomplete="off"  value="<?= $tujuan; ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Jumlah Penumpang</h4>
									</div>
									<div class="col-md-12">
										<input type="number" aria-label="nama" name="penumpang" id="nama" class="form-control z-depth-1" autocomplete="off" value="<?= $penumpang; ?>">
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Lunas / BA</h4>
									</div>
									<div class="col-md-12">
										<select name="lunas" id="durasi1" class="form-control">
					                      <option value="0">- Pilih Status Pembayaran -</option>
					                      <option value="1" <?php if($lunas == "1") echo "selected='selected'"; ?>>Lunas</option>
					                      <option value="2" <?php if($lunas == "2") echo "selected='selected'"; ?>>BA</option>					                      
					                    </select>
									</div>

									<div class="col-md-12 mt-2">
										<h4 class="h4-responsive">Harga Khusus</h4>
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
	if($table_name == "tb1"){
		header('Location: admin-siluet.php');
	}else{
		header('Location: admin-liza.php');
	}
}

}else{
	header('Location: login-admin.php');
}

?>
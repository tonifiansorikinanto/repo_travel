<?php 
require_once 'core/system.php';
$currentPage = "tambah";
require_once 'assets/templates/header.php';



if(isset($_SESSION["user_access"])){

if(isset($_GET['tb'])){
	$table_name = $_GET['tb'];
}else{
	header('Location: admin-siluet');
}

$data_search_found = 0;

if(isset($_GET['cari-data'])){

	$status_tujuan = false;

	$cari_data = $_GET['cari-data'];

	if($table_name == "tb1"){
		$data_nomer = show_data_onNomer_tbSiluet($cari_data);
	}else if($table_name == "tb2"){
		$data_nomer = show_data_onNomer_tbLiza($cari_data);
	}

	if(mysqli_num_rows($data_nomer) > 0){
		$data_search_found = 1;

		echo report_message("success", "Data Ditemukan !");

		while($data = mysqli_fetch_assoc($data_nomer)):
			$nomerOri 				= $data['nomer'];
			$namaOri					= $data['nama'];
			$alamatOri				= $data['alamat'];
			$jemputOri				= $data['jemput'];
			$tglOri 					= $data['tanggal'];
			$jamOri 					= $data['jam'];
			$tujuanOri 				= $data['tujuan'];
			$penumpangOri			= $data['penumpang'];
			$lunasOri 				= $data['lunas'];
			$harga_khususOri 	= $data['harga_khusus'];
			$ketOri 					= $data['ket'];
		endwhile;

		$day 			= substr($tglOri, 0, 2);
		$month 		= substr($tglOri, 3, 2);
		$year 		= substr($tglOri, 6, 4);

		$tglOri 	= $year . "-" . $month . "-" . $day;

		if ($tujuanOri == "Malang" || $tujuanOri == "Juanda" || $tujuanOri == "Surabaya Kota" || $tujuanOri == "Carter") {
			$status_tujuan = true;
		} else {
			$status_tujuan = false;
		}


	}else{
		$data_search_found = 0;

		echo report_message("error", "Data Yang Dicari Tidak Ditemukan !");
	}

	
}

if (isset($_POST['submit_cari_mobil'])) {
	$jam_modal	= $_POST['jam'];
	$tgl_cari	= $_POST['tgl'];
	$day		= substr($tgl_cari, 0, 2);
	$month 		= substr($tgl_cari, 3, 2);
	$year 		= substr($tgl_cari, 6, 4);

	$tgl_modal 	= $year . "-" . $month . "-" . $day;
}


// pengaturan submit data

if(isset($_POST['submit_input'])){
	$nomer 				= $_POST['nomer'];
	$nama 				= $_POST['nama'];
	$alamat 			= $_POST['alamat'];
	$jemput 			= $_POST['jemput'];
	$tgl 					= $_POST['tgl'];
	$jam 					= $_POST['jam'];
	if ($_POST['tujuan_text'] != '') {
		$tujuan = $_POST['tujuan_text'];
	} else {
		$tujuan = $_POST['tujuan_select'];
	}
	$penumpang 		= $_POST['penumpang'];
	$lunas 				= $_POST['lunas'];
	$harga_khusus = $_POST['harga_khusus'];
	$ket 					= $_POST['ket'];

	if(!empty(trim($nomer)) && !empty(trim($nama)) && !empty(trim($alamat)) && !empty(trim($tgl)) && !empty(trim($jam)) && !empty(trim($tujuan)) && !empty(trim($penumpang)) && !empty(trim($lunas))){

  	$day 		= substr($tgl, 8, 2);
  	$month 		= substr($tgl, 5, 2);
  	$year 		= substr($tgl, 0, 4);

  	$tgl 	= $day . "-" . $month . "-" . $year;

		if($table_name == "tb1"){
			if(add_data_tbSiluet($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Menambahkan Data ke Tabel Siluet");
				header("Refresh:3.1; URL=tambah-penumpang?tb=tb1");
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Menambahkan Data !");
				header('Location: tambah-penumpang?tb=tb1');
			}
		}else{
			if(add_data_tbLiza($nomer, $nama, $alamat, $jemput, $tgl, $jam, $tujuan, $penumpang, $lunas, $harga_khusus, $ket)){
				$_SESSION['report_message'] = report_message("success", "Berhasil Menambahkan Data ke Tabel Liza");
				header("Refresh:3.1; URL=tambah-penumpang?tb=tb2");
			}else{
				$_SESSION['report_message'] = report_message("error", "Gagal Menambahkan Data !");
				header('Location: tambah-penumpang?tb=tb2');
			}
		}

	}else{
		$_SESSION['report_message'] = report_message("error", "Data selain alamat jemput harus diisi !");
	}
}


?>

<?php

if(isset($_SESSION['report_message'])){
	echo $_SESSION['report_message'];
	unset($_SESSION['report_message']);
}

?>



<div class="modal fade" id="modalKetersediaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cek Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="post" action="">
      	<div class="row align-items-center justify-content-center">
	        <div class="col-md-4">
				<h4 class="h4-responsive">Tanggal Berangkat</h4>
				<input type="date" value="<?=$tgl_cari;?>" aria-label="nomer" name="tgl" id="tgl" class="form-control z-depth-1">
			</div>
			<div class="col-md-3">
				<h4 class="h4-responsive">Jam Berangkat</h4>
				<input type="time" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" autocomplete="off" value="<?=$jam_modal;?>">
			</div>
			<div class="col-md-2">
				<button type="submit" name="submit_cari_mobil" class="btn btn-<?php if($table_name == "tb1"){
					  	echo('warning');
					  }else{
					  	echo('info');
					  }?>
				btn-md" style="width: 80px;">Cek</button>
			</div>
			</form>
			<?php if(isset($_POST['submit_cari_mobil'])){?>
				<div class="col-md-6 mt-4">
					<table class="table">
					  <thead class="<?php if($table_name == "tb1"){
					  	echo('warning-color');
					  }else{
					  	echo('info-color');
					  }?>
					  white-text">
					    <tr>
					      <th scope="col" style="vertical-align: middle;" width="10px">#</th>
					      <th scope="col" style="vertical-align: middle;">Mobil</th>
					      <th scope="col" style="vertical-align: middle;">Plat</th>
					      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Seat Tersedia</th>					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <th scope="row">1</th>
					      <td>Mark</td>
					      <td>Otto</td>
					      <td class="text-center">Otto</td>					      
					    </tr>					    
					  </tbody>
					</table>
				</div>
			<?php } ?>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Tutup</button>        
      </div>
    </div>
  </div>
</div>

<script>
	// window.onload = function(){
	// 	var modalKetersediaan =  document.getElementById('modalKetersediaan');

	// 	var bodys = document.getElementsByTagName('body')[0];
	// 	bodys.classList.add("modal-open");
	// 	modalKetersediaan.classList.add('show');
	// 	modalKetersediaan.style.display = "block";
	// }
</script>

<div class="container">
	<div class="row justify-content-center
	 <?php
		if ($table_name =='tb1') {
			echo "text-warning";
		} else {
			echo "text-info";
		}
	?>">
		<div class="col-md-11 mt-2">
			

			<div class="row align-items-center">
				<div class="col-md-7">
					<h1 class="h1-responsive"> Tambah Penumpang 
						<?php
							if ($table_name =='tb1') {
								echo "Siluet";
							} else {
								echo "Liza";							
							}
						?>					
					</h1>
				</div>
	  			<div align="center" class="offset-md-1 col-md-3">
					<h4 class="h4-responsive">Cari Nomer HP</h4>

					<input class="form-control z-depth-1 text-center" type="text" aria-label="" name="cari-data" autocomplete="off" spellcheck="false" placeholder="input nomer.." style="width: 100%;" maxlength="13" id="cari_nomer" value="<?php if(isset($cari_data)){ echo $cari_data; }?>" onkeypress="if(event.keyCode == 13){ setSearchParameter('<?= $table_name ?>'); }">					
	  			</div>	  			
		  	</div>			
            
			<form method="post" action="">
				<div class="row justify-content-center">
					<div class="col-md-12 mt-4">
						<div class="row justify-content-center">
							<div class="col-md-5">
								<h2 class="h2-responsive">Data Primer</h2>

								<div class="row">
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nomer HP</h4>
									</div>
									<div class="col-md-12">											
										<input type="text" aria-label="nomer" name="nomer" id="nomer" class="form-control z-depth-1" maxlength="13" value="<?php if(isset($cari_data) && isset($nomerOri)){ echo $nomerOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Nama</h4>
									</div>
									<div class="col-md-12">
										<input type="text" aria-label="nama" name="nama" id="nama" class="form-control z-depth-1" autocomplete="off"  value="<?php if(isset($cari_data) && isset($namaOri)){ echo $namaOri; } ?>">
									</div>

									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Alamat Tetap</h4>
									</div>
									<div class="col-md-12 mb-2">
										<textarea class="form-control z-depth-1" name="alamat" style="height: 100px;" id="exampleFormControlTextarea6"><?php if(isset($cari_data) && isset($alamatOri)){ echo $alamatOri; } ?></textarea>
									</div>			

									<hr class="mb-3" style="width: 95%;">

									<div class="col-md-12">
										<h4 class="h4-responsive">Alamat Jemput</h4>
									</div>									
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="jemput" style="height: 100px;" id="exampleFormControlTextarea6"></textarea>
										<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
								          Isi jika client meminta dijemput di tempat yang berbeda dengan alamat tetap, kosongi jika tidak.
								        </small>
									</div>								

								</div>
							</div>

							<div class="col-md-6">
								<h2 class="h2-responsive">Data Sekunder</h2>
								<div class="row">
									
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Tanggal Berangkat</h4>
										<input type="date" aria-label="nomer" name="tgl" id="tgl" class="form-control z-depth-1">
									</div>
									<div class="col-md-3 mt-1">
										<h6 class="h6-responsive">Jam Berangkat</h6>
										<input type="time" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" autocomplete="off">
									</div>
									<div class="col-md-3 mt-1">
										<h6 class="h6-responsive">Jumlah Penumpang</h6>
										<input type="number" aria-label="nama" name="penumpang" id="nama" class="form-control z-depth-1" autocomplete="off">
									</div>
									<div class="col-md-12 mt-2" align="right">
										<button class="btn btn-info btn-md" type="button" data-toggle="modal" data-target="#modalKetersediaan" style="width: 130px;">Cek Mobil</button>
									</div>			
									<div class="col-md-12 text-center mt-1">
										<h4 class="h4-responsive">Tujuan (Isi Salah Satu)</h4>
									</div>
									<div class="col-md-6 mt-1">
										<select name="tujuan_select" id="durasi1" class="form-control z-depth-1" >
                      <option value="0">- Pilih Tujuan -</option>
                      <option value="Malang">Malang</option>
                      <option value="Juanda">Juanda</option>
                      <option value="Surabaya Kota">Surabaya Kota</option>
                      <option value="Carter">Carter</option>
                  	</select>
										<!-- <input type="text" aria-label="nama" name="tujuan" id="nama" class="form-control z-depth-1" autocomplete="off" value="; } ?>"> -->
									</div>
									<div class="col-md-6 mt-1">
										<input type="text" aria-label="nama" name="tujuan_text" id="nama" class="form-control z-depth-1" autocomplete="off" placeholder="lainnya..">
										<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted">
								          Isi manual disini jika di pilihan sebelah tidak ada.
								        </small>
									</div>
									

									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Lunas / BA</h4>
										<select name="lunas" id="durasi1" class="form-control z-depth-1">
                      <option value="0">- Status Pembayaran -</option>
                      <option value="1">Lunas</option>
                      <option value="2">BA</option>
                  	</select>
									</div>
									<div class="col-md-6 mt-3">
										<h4 class="h4-responsive">Special Price</h4>
										<input type="number" aria-label="nomer" name="harga_khusus" id="nomer" class="form-control z-depth-1" autocomplete="off">
									</div>
									<div class="col-md-12 mt-3">
										<h4 class="h4-responsive">Keterangan</h4>
									</div>
									<div class="col-md-12">
										<textarea class="form-control z-depth-1" name="ket" style="height: 100px;" id="exampleFormControlTextarea6"></textarea>
									</div>
								</div>

								<div class="mt-3" align="right">
						  			<button type="submit" name="submit_input" class="btn btn-primary btn-md" style="width: 130px;" onclick="return confirm('Lanjut Tambah Data Penumpang ?')">Tambah Data</button>

						  			<?php if($table_name == "tb1"): ?>
						  				<a type="button" class="btn btn-info btn-md" href="admin-siluet" style="width: 130px;">Kembali</a>
						  			<?php else: ?>
						  				<a type="button" class="btn btn-info btn-md" href="admin-liza" style="width: 130px;">Kembali</a>
						  			<?php endif; ?>
					  			</div>
							</div>		                  
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
	header('Location: login-admin');
}

?>
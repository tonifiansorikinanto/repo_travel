<?php 
require_once 'core/system.php';
$currentPage = "admin-siluet";
require_once 'assets/templates/header.php';

$no1 = 1;

if(isset($_SESSION["user_access"])){

$show_data_tbSiluet = show_data_tbSiluet();

$show_mobil_available = show_mobil_available_siluet_order();
$show_mobil_idle 			= show_mobil_idle_siluet();

if(isset($_GET['id'])){
	$id_get = $_GET['id'];

	$id_get = explode("-", $id_get);
}

// editanku
	$query_id = $_SESSION['user_access'];
	$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)){
	    $nama = $row['nama'];   
	}
// end

if(isset($_GET['s'])){
	$s = $_GET['s'];
	$show_data_tbSiluet = search_data_tbSiluet($s);	
}

if(isset($_POST['submit'])){
	$password = $_POST["pass_sv"];
	$tb 		= $_GET['tb'];	
	$id 	= $_GET['id_edit'];

	if(!empty(trim($password))){

		if(cek_user_supervisor($password)){
			$_SESSION['pass_supervisor'] = true;
			header('Location: edit-penumpang?tb=' . $tb . '&id_edit=' . $id . '');
		}else{
			$_SESSION['pass_supervisor'] = false;
			$_SESSION['report_message'] = report_message("error", "Password Salah !");

			$error_modal = '<script>
		    $(document).ready(function(){
		      $("#modalKonfirmSupervisor").modal("show");

		      setTimeout(function(){
		        $("#pass_sv").focus();
		      }, 500);
		    });
		  </script>';
		}
	}else{
		$_SESSION['report_message'] = report_message("error", "Data Harus Terisi !");

		$error_modal = '<script>
	    $(document).ready(function(){
	      $("#modalKonfirmSupervisor").modal("show");

	      setTimeout(function(){
	        $("#pass_sv").focus();
	      }, 500);
	    });
	  </script>';
	}

}

if(isset($_POST['submit_cs'])){
	$password = $_POST["pass_cs"];

	if(!empty(trim($password))){

		if(cek_user_cs($password)){
			$_SESSION['pass_cs'] = true;
			header('Location: tambah-penumpang?tb=tb1');
		}else{
			$_SESSION['pass_cs'] = false;
			$_SESSION['report_message'] = report_message("error", "Password Salah !");

			$error_modal = '<script>
		    $(document).ready(function(){
		      $("#modalCS").modal("show");

		      setTimeout(function(){
		        $("#pass_cs").focus();
		      }, 500);
		    });
		  </script>';
		}
	}else{
		$_SESSION['report_message'] = report_message("error", "Data Harus Terisi !");

		$error_modal = '<script>
	    $(document).ready(function(){
	      $("#modalCS").modal("show");

	      setTimeout(function(){
	        $("#pass_cs").focus();
	      }, 500);
	    });
	  </script>';
	}

}


if(isset($_POST['submit_mobil'])){
	$text_mobil = $_POST["text_mobil"];
	$id_mobil = $_POST["id_mobil"];

	if(!isset($_GET['id'])){
		$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
	}else{

		$id_nomer = $_GET['id'];

		if($id_nomer != ""){
			 // && setIDJadwalSiluet($id_mobil)
			if(!empty(trim($text_mobil))){
				if(setKeteranganSiluet($text_mobil, $id_nomer)){
					$_SESSION['report_message'] = report_message("success", "Sukses Mengatur Data ! ");
					header("Location: admin-siluet?tb=" . $_GET['tb'] . "&id=" . $_GET['id']);
				}else{
					$_SESSION['report_message'] = report_message("error", "Error Saat Mengatur Data ! ");
				}
			}else{
				$_SESSION['report_message'] = report_message("error", "Data Tidak Boleh Kosong !");

				$error_modal = '<script>
			    $(document).ready(function(){
			      $("#modalSelect").modal("show");
			  </script>';
			}

		}else{
			$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
		}

	}

}

if(isset($_POST['delete_mobil'])){
	if(!isset($_GET['id'])){
		$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
	}else{
		$id_nomer = $_GET['id'];

		if($id_nomer != ""){
			
			$text_mobil = "";

			if(setKeteranganSiluet($text_mobil, $id_nomer)){
				$_SESSION['report_message'] = report_message("success", "Sukses Mengatur Data ! ");
				header("Location: admin-siluet?tb=" . $_GET['tb'] . "&id=" . $_GET['id']);
			}else{
				$_SESSION['report_message'] = report_message("error", "Error Saat Mengatur Data ! ");
			}

		}else{
			$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
		}

	}

}

if (isset($_POST['submit_cari_mobil'])) {
	$jam_modal	= $_POST['jam'];
	$tgl_cari	= $_POST['tgl'];

	$no = 1; $no1 = 1;

	$cek_mobil_siluet = cek_mobil_siluet($jam_modal, $tgl_cari);

	$cek_mobil_kosong_siluet = cek_mobil_kosong_siluet($jam_modal, $tgl_cari);

	$sum_seat_use_mobil_siluet = sum_seat_use_mobil_siluet($jam_modal, $tgl_cari);
	if($sum_seat_use_mobil_siluet == ''){
		$sum_seat_use_mobil_siluet = 0;
	}
	$sum_seat_mobil_siluet = sum_seat_mobil_siluet();
	if($sum_seat_mobil_siluet == ''){
		$sum_seat_mobil_siluet = 0;
	}

	$min_seat_total = $sum_seat_mobil_siluet - $sum_seat_use_mobil_siluet;
	
}

?>

<!-- modal -->
	<div class="modal fade" id="modalKetersediaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
	  <div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
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
		        <div class="col-md-2" align="center">
					<h4 class="h4-responsive">Tanggal Berangkat</h4>
					<input type="date" style="width: 90%;" value="<?php if(isset($_POST['submit_cari_mobil'])) { echo $tgl_cari; } ?>" aria-label="nomer" name="tgl" id="tgl" class="form-control z-depth-1">
				</div>
				<div class="col-md-2" align="center">
					<h4 class="h4-responsive">Jam Berangkat</h4>
					<input type="time" aria-label="nomer" name="jam" id="nomer" class="form-control z-depth-1" style="width: 55%;" autocomplete="off" value="<?php if(isset($_POST['submit_cari_mobil'])) { echo $jam_modal; } ?>">
				</div>
				<div class="col-md-1">
					<button type="submit" name="submit_cari_mobil" class="btn btn-warning btn-md" style="width: 80px;">Cek</button>
				</div>
				</form>
				<?php if(isset($_POST['submit_cari_mobil'])){?>
					<div class="col-md-12 mt-4" align="center">
						<h4 class="h4-responsive">Jumlah Seat Dipesan (<?= $sum_seat_use_mobil_siluet; ?>) • Total Seat Tersedia (<?= $min_seat_total; ?>)</h4>

						<div class="row mt-3 justify-content-center">

							<div class="col-md-5">
								<h5 class="h5-responsive">Tabel Mobil Berpenumpang</h5>
								<div class="box_table">
									<table class="table">
									  <thead class="warning-color white-text">
									    <tr>
									      <th scope="col" style="vertical-align: middle;" width="10px">#</th>
									      <th scope="col" style="vertical-align: middle;">Mobil</th>
									      <th scope="col" style="vertical-align: middle;">Plat</th>
									      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Seat Tersedia</th>
									    </tr>
									  </thead>
									  <tbody>
									  	<?php 
									  	if(mysqli_num_rows($cek_mobil_siluet) > 0){
									  	while($data = mysqli_fetch_assoc($cek_mobil_siluet)): 
									  	?>
									    <tr>
									      <th scope="row"><?= $no++;?></th>
									      <td><?= $data['mobil'] ?></td>
									      <td><?= $data['plat_nomor'] ?></td>
									      <td class="text-center"><?= $data['penumpang'] - $data['seat_use']; ?></td>					      
									    </tr>
										  <?php 
											endwhile; 
											}else{
											?>

											<tr><td colspan="4" class="text-center">Tidak ada data !</td></tr>
											<?php } ?>
									  </tbody>
									</table>
								</div>
							</div>

							<div class="col-md-5">
								<h5 class="h5-responsive">Tabel Mobil Tanpa Penumpang</h5>
								<div class="box_table">
									<table class="table">
									  <thead class="warning-color white-text">
									    <tr>
									      <th scope="col" style="vertical-align: middle;" width="10px">#</th>
									      <th scope="col" style="vertical-align: middle;">Mobil</th>
									      <th scope="col" style="vertical-align: middle;">Plat</th>
									      <th scope="col" style="vertical-align: middle; text-align: center;" width="10px">Seat Tersedia</th>
									    </tr>
									  </thead>
									  <tbody>
									  	<?php 
									  	if(mysqli_num_rows($cek_mobil_kosong_siluet) > 0){
									  	while($data = mysqli_fetch_assoc($cek_mobil_kosong_siluet)): 
									  	?>
									    <tr>
									      <th scope="row"><?= $no1++ ;?></th>
									      <td><?= $data['mobil'] ?></td>
									      <td><?= $data['plat_nomor'] ?></td>
									      <td class="text-center"><?= $data['penumpang'];?></td>					      
									    </tr>
										  <?php 
											endwhile; 
											}else{
											?>
											<tr><td colspan="4" class="text-center">Tidak ada data !</td></tr>
											<?php } ?>
									  </tbody>
									</table>
								</div>
							</div>

						</div>

						<h6 class="h6-responsive mt-4 text-right">*Data di tabel termasuk mobil yang belum di jadwalkan</h6>
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
	
	<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Anda yakin ingin keluar?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
	        <a href="logout.php" class="btn btn-sm btn-danger">Iya</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">		  
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Delete Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Anda yakin ingin menghapus data penumpang ini?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Tidak</button>
	        <a href="#x" class="btn btn-sm btn-danger" id="button_delete">Iya</a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Login Customer Service</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="resetUrlClear()">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="form_sv">
		      <div class="modal-body">
				    <input type="password" aria-label="pass_cs" name="pass_cs" class="form-control" placeholder="Masukkan password CS..." id="pass_cs">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrlClear()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="button_login" name="submit_cs">Login</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalKonfirmSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">		  
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Supervisor</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="resetUrlClear()">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="form_sv">
		      <div class="modal-body">
				    <input type="password" aria-label="pass_sv" name="pass_sv" class="form-control" placeholder="Masukkan password Supervisor..." id="pass_sv">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrlClear()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="button_edit" name="submit">Konfirmasi</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index:99999999;">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Masukan Keterangan Mobil</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="resetUrl()">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="">
		      <div class="modal-body">
				    <!-- <input type="text" aria-label="text_mobil" name="text_mobil" class="form-control" placeholder="Masukkan Keterangan Mobil..." id="text_mobil"> -->
			    	<select name="text_mobil" class="form-control">
			    		<?php while($data_mobil = mysqli_fetch_assoc($show_mobil_available)):
			    		$hasil = $data_mobil['penumpang'] - $data_mobil['seat_use'];
			    		?>
			    		<option value="<?= $data_mobil['id_mobil']; ?>"><?= $data_mobil['mobil']; ?> (<?= $data_mobil['plat_nomor']; ?> • <?= $hasil . " Penumpang"; ?>)</option>
			    		<?php endwhile; ?>

			    		<?php while($data_idle = mysqli_fetch_assoc($show_mobil_idle)): ?>
			    		<option value="<?= $data_idle['id_mobil']; ?>"><?= $data_idle['mobil']; ?> (<?= $data_idle['plat_nomor']; ?> • <?= $data_idle['penumpang'] . " Penumpang"; ?>)</option>
			    		<?php endwhile; ?>
			    		
			    	</select>

			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="resetUrl()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" name="delete_mobil">Hapus Mobil</button>
		        <button role="button" class="btn btn-sm btn-success" id="submit_mobil" name="submit_mobil">Submit</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
<!-- modal -->

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
	<nav class="navbar navbar-dark warning-color justify-content-between" style="position: sticky; top: 0; z-index: 10; padding-right: 25px;">
	  <h2 class="navbar-brand h2-responsive my-0" href="#">Database Travel</h2>
		<h6 class="h6-responsive my-0 ml-auto text-white" href="#">Selamat Datang, <?= $nama; ?>!</h6>
	  <button class="btn btn-danger btn-md ml-4 my-0" type="button" data-toggle="modal" data-target="#modalLogout">logout</button>
	  <a role="button" class="btn btn-primary btn-md my-0" href="data-mobil-siluet">Data Mobil Siluet</a>
	</nav>	

	<?php

	if(isset($_SESSION['report_message'])){
		echo $_SESSION['report_message'];
		unset($_SESSION['report_message']);
	}

	?>

	<div class="container-fluid" style="padding-left: 10px; padding-right: 20px;">
		<div class="row justify-content-center mt-2 mb-4">
			<div class="col-md-12">
				<div align="center" class="mt-2">
					<a class="btn waves-effect btn-outline-warning" href="admin-siluet" role="button" style="width: 190px;">Siluet</a>
					<a href="admin-liza" class="btn waves-effect btn-info" role="button" style="width: 190px;">Liza</a>
				</div>				
		  		<div class="row mt-4 align-items-center">
		  			<div class="col-md-3">
		  				<!-- Search form -->
						<form class="form-inline active-cyan-3 active-cyan-4" method="get" action="">
						  <i class="fas fa-search" aria-hidden="true"></i>
						  <input class="form-control form-control-sm ml-3" style="width: 240px;" type="search" placeholder="Cari berdasarkan Tgl Berangkat.." aria-label="Cari berdasarkan Tgl Berangkat.." name="s" autocomplete="off" spellcheck="false" <?php if(isset($_GET['s'])){ echo('value=' . $_GET['s'] .  ''); } ?>>
						  <a class="text-warning ml-3" href="admin-siluet" title="Refresh Tabel"><i class="fas fa-redo"></i></a>
						</form>
		  			</div>
		  			<div class="col-md-3" align="center">
		  				<a href="#x" class="h5-responsive text-warning" data-toggle="modal" data-target="#modalCS"  onclick="setInputParameter('tb1')"><i class="fas fa-user-plus"></i> Tambah Penumpang Siluet</a>
		  			</div>		  					  			
		  			<div class="col-md-2" align="right">
		  				<button class="btn btn-info btn-md" type="button" data-toggle="modal" data-target="#modalKetersediaan" style="width: 130px;">Cek Mobil</button>		  				
		  			</div>
		  			<div class="col-md-2" align="right">
		  				<a href="#x" role="button" class="h5-responsive text-primary button_select text-center" data-toggle="modal" data-target="#modalSelect"><i class="fas fa-car"></i> Pilih Mobil</a>
		  			</div>		  			
		  			<div class="col-md-2" align="right">
		  				<a class="h5-responsive text-success" id="print_button"><i class="fas fa-print"></i> Print Tabel</a>
		  			</div>		  					  			
		  		</div>

		  		<div class="table-responsive mt-3">
					<table class="table table-hover" id="table_pagination">
					  <thead class="warning-color text-white" align="center">
					    <tr>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" width="10px" scope="col"><i class="far fa-check-square"></i></th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" width="10px" scope="col">#</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col" width="10px">Nomer HP</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col">Nama</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col">Alamat Jemput</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col">Tgl Berangkat</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col" width="10px">Jam Berangkat</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col">Tujuan</th>		
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" width="10px" scope="col">Jumlah Penumpang</th>			      
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col" width="95px">Lunas / BA</th>
					      <th style="vertical-align: middle; padding-top: 10px; padding-bottom: 10px;" scope="col" width="120px">Special Price</th>					      			      
					    </tr>
					  </thead>
					  <tbody>
					  	<?php if(mysqli_num_rows($show_data_tbSiluet) > 0 ): ?>
						    <?php while($data = mysqli_fetch_assoc($show_data_tbSiluet)): ?>

						    <?php
						    if($data['mobil'] != ""){
						    	$data_mobil_set = true;
						    }else{
						    	$data_mobil_set = false;
						    }
						    ?>


						    <tr style="cursor:pointer;" class="row_show">
						      <td>
						      	<input type="checkbox" onclick="set_id('<?= $data['id']; ?>', 'checkid<?= $no1; ?>', 'tb1')" class="check_input" id="checkid<?= $no1; ?>"
						      		<?php
						      		if(isset($_GET['id']) AND !empty($_GET['id'])){
							      		for($y = 0; $y < count($id_get); $y++){
							      			if($data['id'] == $id_get[$y]){
							      				echo "checked";
							      			}
							      		}
						      		}
						      		
						      		?>
						      	>
						      </td>
						      <td scope="row" onclick="show_data(<?= $no1; ?>)"><?= $no1; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)"><?= $data['nomer']; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)"><?= $data['nama']; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)">
						      	<?php
						      		if ($data['jemput'] != ''){
						      			echo $data['jemput'];
						      		} else {
						      			echo $data['alamat'];
						      		}
						      	?>
						      </td>
						      <?php
						      $day_data 	= substr($data['tanggal'], 8, 2);
									$month_data = substr($data['tanggal'], 5, 2);
									$year_data 	= substr($data['tanggal'], 0, 4);

									$tglData 	= $day_data . "-" . $month_data . "-" . $year_data;
						      ?>
						      <td onclick="show_data(<?= $no1; ?>)" class="text-center"><?= $tglData; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)" class="text-center"><?= $data['jam']; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)"><?= $data['tujuan']; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)" class="text-center"><?= $data['penumpang']; ?></td>
						      <td onclick="show_data(<?= $no1; ?>)" class="text-center">
						      	<?php 
						      	if($data['lunas'] == 1){
						      		echo "Lunas";
						      	}else if($data['lunas'] == 2){
						      		echo "BA";
						      	}
						      	?>
						      </td>
						      <td class="text-center" onclick="show_data(<?= $no1; ?>)"><?= $data['harga_khusus']; ?></td>						      
						    </tr>					    
						    <tr class="align-items-center row_hidden" id="row<?= $no1++; ?>">
						    	<td colspan="2"></td>
						    	<td><b>Keterangan</b></td>
						    	<td colspan="5">
						    		<?= $data['ket']; ?>
						    		<?php if($data_mobil_set == true): ?>
						    			<?= ". Mobil = " . show_data_mobil($data['mobil']); ?>
						    		<?php endif; ?>
						    	</td>
						    	<td colspan="1" class="text-right"><b>Aksi</b></td>
						    	<td colspan="2">
						      	<a href="#x" role="button" class="text-warning" data-toggle="modal" data-target="#modalKonfirmSupervisor" onclick="setEditParameter('tb1', '<?=$data['id']; ?>')">Edit</i></a>
						      	| <a href="#x" role="button" class="text-danger" data-toggle="modal" data-target="#modalDelete" onclick="setDeleteParameter('tb1', '<?=$data['id']; ?>')">Hapus</a>
						      </td>
						    </tr>	
						    <?php endwhile; ?>	
						  <?php else: ?>	    
						  <tr>
						  	<td colspan="12" class="text-center"><b>Tidak ada data !</b></td>
						  </tr>
						  <?php endif; ?>			    
					  </tbody>				  
					</table>
				</div>

				<div class="row justify-content-end align-items-center mt-3 footer_table">
					<div class="col-md-4 mr-0 pr-0" align="right">
		  			<h6 class="h6-responsive">Menampilkan 10 data per halaman dari total <span id="data_total"></span> data</h6> 
		  		</div>
		  		<div class="col-md-1 pr-4 text-warning" align="right">
		  			<a id="prev_button"><i title="Data sebelumnya" class="far fa-caret-square-left fa-2x waves-effect mr-2"></i></a>
		  			<a id="next_button"><i title="Data selanjutnya" class="far fa-caret-square-right fa-2x waves-effect"></i></a>
		  		</div>
		  	</div>												
			</div>
		</div>
	</div>
</div>


<?php 
require_once 'assets/templates/footer.php'; 

if(isset($error_modal)){
	echo $error_modal;
}

if(isset($_POST['submit_cari_mobil'])){
	echo '<script>
    $(document).ready(function(){
        $("#modalKetersediaan").modal("show");
    });
  </script>';
}

}else{
	header('Location: login-admin');
}
?>
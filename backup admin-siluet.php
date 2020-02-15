<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php';

$no1 = 1;

if(isset($_SESSION["user_access"])){

$show_data_tbSiluet = show_data_tbSiluet();

// editanku
	$query_id = $_SESSION['user_access'];
	$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_assoc($result)){
	    $nama = $row['nama'];   
	}
// end

if(isset($_GET['caritb1'])){
	$caritb1 = $_GET['caritb1'];
	$show_data_tbSiluet = search_data_tbSiluet($caritb1);	
}

if(isset($_POST['submit'])){
	$password = $_POST["pass_sv"];
	$tb 		= $_GET['tb'];
	$nomer 	= $_GET['id'];

	if(!empty(trim($password))){

		if(cek_user_supervisor($password)){
			$_SESSION['pass_supervisor'] = true;
			header('Location: edit-penumpang.php?tb=' . $_GET['tb'] . '&id=' . $_GET['id'] . '');
		}else{
			$_SESSION['pass_supervisor'] = false;
			$_SESSION['report_message'] = report_message("error", "Password Salah !");
		}
	}else{
		$_SESSION['report_message'] = report_message("error", "Data Harus Terisi !");
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
		}
	}else{
		$_SESSION['report_message'] = report_message("error", "Data Harus Terisi !");
	}

}


if(isset($_POST['submit_mobil'])){
	$text_mobil = $_POST["text_mobil"];

	if(!isset($_GET['id'])){
		$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
	}else{

		$id_nomer = $_GET['id'];

		if($id_nomer != ""){
			
			if(!empty(trim($text_mobil))){
				if(setKeteranganSiluet($text_mobil, $id_nomer)){
					$_SESSION['report_message'] = report_message("success", "Error Saat Mengatur Data ! ");
					header("Location: admin-siluet");
				}else{
					$_SESSION['report_message'] = report_message("error", "Error Saat Mengatur Data ! ");
				}
			}else{
				$_SESSION['report_message'] = report_message("error", "Data Tidak Boleh Kosong !");
			}

		}else{
			$_SESSION['report_message'] = report_message("error", "Harus Memilih data !");
		}

	}

}

?>

<!-- modal -->
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
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="resetUrl()">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="form_sv">
		      <div class="modal-body">
				    <input type="password" aria-label="pass_cs" name="pass_cs" class="form-control" placeholder="Masukkan password CS..." id="pass_cs">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrl()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="button_edit" name="submit_cs">Login</button>
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
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"onclick="resetUrl()">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="" name="form_sv">
		      <div class="modal-body">
				    <input type="password" aria-label="pass_sv" name="pass_sv" class="form-control" placeholder="Masukkan password Supervisor..." id="pass_sv">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrl()">Batal</button>
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
				    <input type="text" aria-label="text_mobil" name="text_mobil" class="form-control" placeholder="Masukkan Keterangan Mobil..." id="text_mobil">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrl()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="submit_mobil" name="submit_mobil">Submit</button>
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
	  <button class="btn btn-danger btn-md ml-3 my-0" type="button" data-toggle="modal" data-target="#modalLogout">logout</button>
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
		  		<div class="row mt-4">
		  			<div class="col-md-4">
		  				<!-- Search form -->
						<form class="form-inline active-cyan-3 active-cyan-4" method="get" action="">
						  <i class="fas fa-search" aria-hidden="true"></i>
						  <input class="form-control form-control-sm ml-3" style="width: 240px;" type="search" placeholder="Cari berdasarkan Tgl Berangkat.." aria-label="Cari berdasarkan Tgl Berangkat.." name="caritb1" autocomplete="off" spellcheck="false" <?php if(isset($_GET['caritb1'])){ echo('value=' . $_GET['caritb1'] .  ''); } ?>>
						  <a class="text-warning ml-3" href="admin-siluet" title="Refresh Tabel"><i class="fas fa-redo"></i></a>
						</form>
		  			</div>
		  			<div class="col-md-4" align="center">
		  				<a href="#x" class="h5-responsive text-warning" data-toggle="modal" data-target="#modalCS"  onclick="setInputParameter('tb1')"><i class="fas fa-user-plus"></i> Tambah Penumpang Siluet</a>
		  			</div>
		  			<div class="col-md-4" align="right">
		  				<a href="print_file.php?tb=tb1<?php if(isset($_GET['caritb1'])){ echo '&caritb1=' . $_GET['caritb1']; }?>" class="h5-responsive text-success" target="_blank"><i class="fas fa-print"></i> Print Tabel</a>
		  			</div>
		  		</div>	  		
				
				<table class="table table-hover mt-4">
				  <thead class="warning-color text-white" align="center">
				    <tr>
				      <th style="width: 35px;" scope="col"><i class="far fa-check-square"></i></th>
				      <th style="width: 35px;" scope="col">#</th>
				      <th scope="col">Nomer HP</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Alamat Jemput</th>
				      <th scope="col">Tgl Berangkat</th>
				      <th scope="col">Jam Berangkat</th>
				      <th scope="col">Tujuan</th>		
				      <th scope="col">Jumlah Penumpang</th>			      
				      <th scope="col">Lunas / BA</th>
				      <th scope="col">Special Price</th>
				      <th scope="col">Mobil</th>				      
				    </tr>
				  </thead>
				  <tbody>
				  	<?php if(mysqli_num_rows($show_data_tbSiluet) > 0 ): ?>
					    <?php while($data = mysqli_fetch_assoc($show_data_tbSiluet)): ?>
					    <tr style="cursor:pointer;">
					      <td><input type="checkbox" onclick="set_id('<?= $data['id']; ?>', 'checkid<?= $no1; ?>')" id="checkid<?= $no1; ?>"></td>
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
					      <td onclick="show_data(<?= $no1; ?>)"><?= $data['tanggal']; ?></td>
					      <td onclick="show_data(<?= $no1; ?>)"><?= $data['jam']; ?></td>
					      <td onclick="show_data(<?= $no1; ?>)"><?= $data['tujuan']; ?></td>
					      <td onclick="show_data(<?= $no1; ?>)" class="text-center"><?= $data['penumpang']; ?></td>
					      <td onclick="show_data(<?= $no1; ?>)">
					      	<?php 
					      	if($data['lunas'] == 1){
					      		echo "Lunas";
					      	}else if($data['lunas'] == 2){
					      		echo "BA";
					      	}
					      	?>
					      </td>
					      <td onclick="show_data(<?= $no1; ?>)"><?= $data['harga_khusus']; ?></td>
					      <td><a href="#x" role="button" class="text-primary button_select" data-toggle="modal" data-target="#modalSelect">Pilih</a></td>
					    </tr>					    
					    <tr class="align-items-center row_hidden" id="row<?= $no1++; ?>">
					    	<td colspan="2"></td>
					    	<td><b>Keterangan</b></td>
					    	<td colspan="6"><?= $data['ket']; ?></td>
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
		</div>
	</div>
</div>


<?php 
require_once 'assets/templates/footer.php'; 

}else{
	header('Location: login-admin');
}
?>
<?php 
	require_once 'core/system.php';
	require_once 'assets/templates/header.php';

	$no2 = 1;

	if(isset($_SESSION["user_access"])){

	$show_data_tbLiza = show_data_tbLiza();

	// editanku
		$query_id = $_SESSION['user_access'];
		$query = "SELECT * FROM tb_admin WHERE username='$query_id'";
		$result = mysqli_query($connect, $query);
		while($row = mysqli_fetch_assoc($result)){
		    $nama = $row['nama'];   
		}
	// end

	if(isset($_GET['caritb2'])){
		$caritb2 = $_GET['caritb2'];
		$show_data_tbLiza = search_data_tbLiza($caritb2);	
	}

	if(isset($_POST['submit'])){
		$password = $_POST["pass_sv"];
		$tb 		= $_GET['tb'];
		$nomer 	= $_GET['nomer'];

		if(!empty(trim($password))){

			if(cek_user_supervisor($password)){
				$_SESSION['pass_supervisor'] = true;
				header('Location: edit-penumpang.php?tb=' . $_GET['tb'] . '&nomer=' . $_GET['nomer'] . '');
			}else{
				$_SESSION['pass_supervisor'] = false;
				echo("<script>alert('Error Saat Mengcek Password !')</script>");
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
				    <input type="password" aria-label="pass_sv" name="pass_sv" class="form-control" placeholder="Masukkan password Supervisor..." id="field_password">
			  	</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" onclick="resetUrl()">Batal</button>
		        <button role="button" class="btn btn-sm btn-danger" id="button_edit" name="submit">Konfirmasi</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>
<!-- modal -->

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
	<nav class="navbar navbar-dark info-color justify-content-between" style="position: sticky; top: 0; z-index: 10;">
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

	<div class="container-fluid">
		<div class="row justify-content-center mt-2 mb-4">
			<div class="col-md-12">
				<div align="center" class="mt-2">
					<a href="admin-siluet" class="btn waves-effect btn-warning" role="button" style="width: 190px;">Siluet</a>
					<a class="btn waves-effect btn-outline-info" role="button" style="width: 190px;">Liza</a>
				</div>
				
				<div class="row mt-4 justify-content-center">
		  			<div class="col-md-4">
		  				<!-- Search form -->
						<form class="form-inline active-cyan-3 active-cyan-4">
						  <i class="fas fa-search" aria-hidden="true"></i>
						  <input class="form-control form-control-sm ml-3" style="width: 220px;" type="text" placeholder="Cari berdasarkan Tgl Berangkat.." aria-label="Cari berdasarkan Tgl Berangkat.." name="caritb2" autocomplete="off" spellcheck="false">
						</form>
		  			</div>
		  			<div class="col-md-4" align="center">
		  				<a href="tambah-penumpang?tb=tb2" class="h5-responsive text-info"><i class="fas fa-user-plus"></i> Tambah Penumpang Liza</a>
		  			</div>
		  			<div class="col-md-4" align="right">
		  				<a href="print_file.php?tb=tb2<?php if(isset($_GET['caritb2'])){ echo '&caritb2=' . $_GET['caritb2']; }?>" class="h5-responsive text-success" target="_blank"><i class="fas fa-print"></i> Print Tabel</a>
		  			</div>
		  		</div>
		  		<div class="table-responsive-sm">
					<table class="table table-hover mt-4" id="example">
					  <thead class="info-color text-white" align="center">
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
					  	<?php if(mysqli_num_rows($show_data_tbLiza) > 0 ): ?>
						    <?php while($data = mysqli_fetch_assoc($show_data_tbLiza)): ?>
						    <tr style="cursor:pointer;">
						    	<?php
						    	// $datatanggal 	= $data['tanggal'];
						    	// $day 			= substr($datatanggal, 8, 2);
						    	// $month 		= substr($datatanggal, 5, 2);
						    	// $year 		= substr($datatanggal, 0, 4);

						    	// $datatanggal 	= $day . "-" . $month . "-" . $year;
						    	?>
						      <td>
						      	<input type="checkbox"></td>
						      </td>
						      <th scope="row" onclick="show_data(<?= $no2; ?>)"><?= $no2; ?></th>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['nomer']; ?></td>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['nama']; ?></td>
						      <td onclick="show_data(<?= $no2; ?>)">
						      	<?php
						      		if ($data['jemput'] != ''){
						      			echo $data['jemput'];
						      		} else {
						      			echo $data['alamat'];
						      		}
						      	?> Rahayu No. 3B</td>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['tanggal']; ?></td>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['jam']; ?></td>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['tujuan']; ?> Rahayu No. 3B</td>
						      <td onclick="show_data(<?= $no2; ?>)" class="text-center">5</td>
						      <td onclick="show_data(<?= $no2; ?>)">
						      	<?php 
						      	if($data['lunas'] == 1){
						      		echo "Lunas";
						      	}else if($data['lunas'] == 2){
						      		echo "BA";
						      	}
						      	?>
						      </td>
						      <td onclick="show_data(<?= $no2; ?>)"><?= $data['harga_khusus']; ?></td>
						      <td><a href="#x" role="button" class="text-primary" data-toggle="modal" data-target="#modalDelete" onclick="setDeleteParameter('tb1', '<?=$data['nomer']; ?>')">Pilih</a></td>
						    </tr>					    
						    <tr class="align-items-center row_hidden" id="row<?= $no2++; ?>">
						    	<td colspan="2"></td>
						    	<td><b>Keterangan</b></td>
						    	<td colspan="6">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita veritatis hic in unde assumenda.</td>
						    	<td colspan="1" class="text-right"><b>Aksi</b></td>
						    	<td colspan="2">
						      	<a href="#x" role="button" class="text-warning" data-toggle="modal" data-target="#modalKonfirmSupervisor" onclick="setEditParameter('tb1', '<?=$data['nomer']; ?>')">Edit</i></a>
						      	| <a href="#x" role="button" class="text-danger" data-toggle="modal" data-target="#modalDelete" onclick="setDeleteParameter('tb1', '<?=$data['nomer']; ?>')">Hapus</a>
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
</div>

<script>
$(document).ready(function () {
$('#example').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>

<?php 
require_once 'assets/templates/footer.php'; 

}else{
	header('Location: login-admin');
}
?>
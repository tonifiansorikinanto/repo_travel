<?php 
require_once 'core/system.php';
require_once 'assets/templates/header.php';

$no1 = 1;
$no2 = 1;

if(isset($_SESSION["user_access"])){

$show_data_tbSiluet = show_data_tbSiluet();
$show_data_tbLiza = show_data_tbLiza();

if(isset($_GET['caritb1'])){
	$caritb1 = $_GET['caritb1'];
	$show_data_tbSiluet = search_data_tbSiluet($caritb1);
}

if(isset($_GET['caritb2'])){
	$caritb2 = $_GET['caritb2'];
	$show_data_tbLiza = search_data_tbLiza($caritb2);
}

?>

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
	<nav class="navbar navbar-dark default-color justify-content-between" style="position: sticky; top: 0; z-index: 9999999;">
	  	<h2 class="navbar-brand h2-responsive my-0" href="#">Database Travel</h2>  
	    <a href="logout.php" class="btn btn-danger btn-md my-0" type="button">logout</a>
	</nav>

	<div class="container-fluid">
		<div class="row justify-content-center mt-2 mb-4">
			<div class="col-md-12">			
				<ul class="nav nav-tabs nav-justified mt-3" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
				      aria-selected="true">Data Penumpang Siluet</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
				      aria-selected="false">Data Penumpang Liza</a>
				  </li>
				  
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				  	<div class="table-responsive mt-4">
				  		<div class="row">
				  			<div class="col-md-4">
				  				<!-- Search form -->
								<form class="form-inline active-cyan-3 active-cyan-4" method="get" action="">
								  <i class="fas fa-search" aria-hidden="true"></i>
								  <input class="form-control form-control-sm ml-3" style="width: 220px;" type="text" placeholder="Cari berdasarkan nomer HP.." aria-label="Cari berdasarkan nomer HP.." name="caritb1">
								</form>
				  			</div>
				  			<div class="col-md-4" align="center">
				  				<a href="tambah-penumpang.php?tb=tb1" class="h5-responsive text-info"><i class="fas fa-user-plus"></i> Tambah Penumpang</a>
				  			</div>
				  			<div class="col-md-4" align="right">
				  				<h5 class="h5-responsive text-success"><i class="fas fa-print"></i> Print Tabel</h5>
				  			</div>
				  		</div>	  		
						
						<table class="table table-striped table-hover mt-2">
						  <thead>
						    <tr>
						      <th style="width: 35px;" scope="col">#</th>
						      <th scope="col">Nomer HP</th>
						      <th scope="col">Nama</th>
						      <th scope="col">Alamat</th>
						      <th scope="col">Tgl Berangkat</th>
						      <th scope="col">Jam Berangkat</th>
						      <th scope="col">Tujuan</th>					      
						      <th scope="col">Lunas / BA</th>
						      <th scope="col">Harga Khusus</th>
						      <th class="text-center" style="width: 75px;" scope="col">Aksi</th>					      
						    </tr>
						  </thead>
						  <tbody>
						  	<?php while($data = mysqli_fetch_assoc($show_data_tbSiluet)): ?>
						    <tr>
						      <th scope="row"><?= $no1++; ?></th>
						      <td><?= $data['nomer']; ?></td>
						      <td><?= $data['nama']; ?></td>
						      <td><?= $data['alamat']; ?></td>
						      <td><?= $data['tanggal']; ?></td>
						      <td><?= $data['jam']; ?></td>
						      <td><?= $data['tujuan']; ?></td>
						      <td>
						      	<?php 
						      	if($data['lunas'] == 1){
						      		echo "Lunas";
						      	}else if($data['lunas'] == 2){
						      		echo "BA";
						      	}
						      	?>
						      </td>
						      <td><?= $data['harga_khusus']; ?></td>
						      <td class="text-center">
						      	<a href="edit-penumpang.php?tb=tb1&nomer=<?=$data['nomer']; ?>" role="button"><i class="far fa-edit text-warning mr-1"></i></a>
						      	|<a href="delete_data.php?tb=tb1&nomer=<?=$data['nomer']; ?>" role="button" class="ml-2"><i class=" far fa-trash-alt red-text"></i></a>
						      </td>						      
						    </tr>	
						    <?php endwhile; ?>				    
						  </tbody>
						</table>
					</div>
				  </div>
				  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				  	<div class="table-responsive mt-4">
						<div class="row">
				  			<div class="col-md-4">
				  				<!-- Search form -->
								<form class="form-inline active-cyan-3 active-cyan-4">
								  <i class="fas fa-search" aria-hidden="true"></i>
								  <input class="form-control form-control-sm ml-3" style="width: 220px;" type="text" placeholder="Cari berdasarkan nomer HP.." aria-label="Cari berdasarkan nomer HP.." name="caritb2">
								</form>
				  			</div>
				  			<div class="col-md-4" align="center">
				  				<a href="tambah-penumpang.php?tb=tb2" class="h5-responsive text-info"><i class="fas fa-user-plus"></i> Tambah Penumpang</a>
				  			</div>
				  			<div class="col-md-4" align="right">
				  				<h5 class="h5-responsive text-success"><i class="fas fa-print"></i> Print Tabel</h5>
				  			</div>
				  		</div>
						<table class="table table-striped table-hover">
						  <thead>
						    <tr>
						      <th style="width: 35px;" scope="col">#</th>
						      <th scope="col">Nomer HP</th>
						      <th scope="col">Nama</th>
						      <th scope="col">Alamat</th>
						      <th scope="col">Tgl Berangkat</th>
						      <th scope="col">Jam Berangkat</th>
						      <th scope="col">Tujuan</th>					      
						      <th scope="col">Lunas / BA</th>
						      <th scope="col">Harga Khusus</th>
						      
						      <th class="text-center" style="width: 75px;" scope="col">Aksi</th>					      
						    </tr>
						  </thead>
						  <tbody>
						    <?php while($data = mysqli_fetch_assoc($show_data_tbLiza)): ?>
						    <tr>
						      <th scope="row"><?= $no2++; ?></th>
						      <td><?= $data['nomer']; ?></td>
						      <td><?= $data['nama']; ?></td>
						      <td><?= $data['alamat']; ?></td>
						      <td><?= $data['tanggal']; ?></td>
						      <td><?= $data['jam']; ?></td>
						      <td><?= $data['tujuan']; ?></td>
						      <td>
						      	<?php 
						      	if($data['lunas'] == 1){
						      		echo "Lunas";
						      	}else if($data['lunas'] == 2){
						      		echo "BA";
						      	}
						      	?>
						      </td>
						      <td><?= $data['harga_khusus']; ?></td>
						      <td class="text-center">
						      	<a href="edit-penumpang.php?tb=tb2&nomer=<?=$data['nomer']; ?>" role="button"><i class="far fa-edit text-warning mr-1"></i></a>
						      	|<a href="delete_data.php?tb=tb2&nomer=<?=$data['nomer']; ?>" role="button" class="ml-2"><i class=" far fa-trash-alt red-text"></i></a>
						      </td>						      
						    </tr>	
						    <?php endwhile; ?>				    
						  </tbody>
						</table>
					</div>
				  </div>
				  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				  	<div class="table-responsive mt-4">
						<table class="table table-striped table-hover">
						  <thead>
						    <tr>
						      <th style="width: 35px;" scope="col">#</th>
						      <th scope="col">Admin</th>
						      <th scope="col">Tema Web</th>
						      <th scope="col">Konten</th>
						      <th scope="col">Tema Warna</th>
						      <th scope="col">Jumlah Hal.</th>
						      <th scope="col">Durasi</th>
						      <th scope="col">Nomer WA</th>
						      <th style="width: 35px;" scope="col">Delete</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						      <td>@mdo</td>
						      <td>@mdo</td>
						      <td>@mdo</td>
						      <td>@mdo</td>
						      <td class="text-center"><a href="#" role="button"><i class="far fa-trash-alt red-text"></i></a></td>
						    </tr>
						    
						  </tbody>
						</table>
					</div>
				  </div>
				</div>			
			</div>
		</div>
	</div>
</div>


<?php 
require_once 'assets/templates/footer.php'; 

}else{
	header('Location: login-admin.php');
}
?>
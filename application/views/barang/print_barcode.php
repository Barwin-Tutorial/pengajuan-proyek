 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<?php $this->load->view('templates/header'); ?>
 	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
 </head>
 <body>
 	<section class="content">
 		<div class="container-fluid">
 			<div class="row">
 				<div class="col-12">
 					<div class="card">

 						<!-- /.card-header -->
 						<div class="card-body">
 							<div class="row">
 								<?php 
                                $jm = (isset($jumlah)) ? $jumlah : 1 ;
 								$jum=intval($jm);
 								for ($i=1; $i <= $jum ; $i++) { 
 									echo "<div class='col-2'>"
 									.$barcode."
 									<p>".$code."</p>
 									</div> ";
 								}

 								?>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 </body>
 </html>


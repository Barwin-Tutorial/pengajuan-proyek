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

 								$jum=intval($jumlah);
 								for ($i=1; $i <= $jum ; $i++) { 
 									echo "<div >"
 									.$barcode."
 									<p>".$code."</p>
 									</div> <span style='width:10px; text-align:center'>|</span>";
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


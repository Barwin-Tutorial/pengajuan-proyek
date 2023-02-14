<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $aplikasi->title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
    <meta  name="description" content="SMA Negeri Kaligondang" >
  <meta  name="keywords" content="inven smanka, kaligondang, smanka">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-5.5.0/css/all.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-4.3.0/css/all.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/fontastic.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/stylearyo.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.css" id="theme-stylesheet">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css"> -->

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/toastr/toastr.min.css">
</head>
<body >

 <div class="page login-page">
  <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
      <div class="row">

        <!-- Form Panel    -->
        <div class="col-lg-6 bg-white">
          <div class="form d-flex align-items-center">

            <div class="content">
              <div class="text-center">
                <img src="<?php echo base_url('assets/foto/logo/'.$aplikasi->logo);?>" height="100px" width="100px">
                <h4>Login</h4>
              </div>
              <form action="" role="form" id="quickForm" method="post" class="form-validate">
                <div class="form-group kosong">
                  <label for="login-username" class="label-material">User Name</label>
                  <input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="form-control" value="<?php echo set_value('username'); ?>">
                  <div class="input-group-append">
                   
                  </div>
                </div>
                <div class="form-group kosong">
                  <label for="login-password" class="label-material">Password</label>
                  <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="form-control" value="<?php echo set_value('password'); ?>">
                  <div class="input-group-append">
                    
                  </div>
                </div><a type="button" id="login" class="btn btn-primary">Login</a>
              </form>
            </div>
          </div>
        </div>
        <!-- Logo & Information Panel-->
        <div class="col-lg-6">
          <div class="info d-flex align-items-center">
            <div class="content">
              <!-- <div class="logo">
              </div> -->
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="https://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="https://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
</div>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script> -->
<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>  


<script>
  $("#login").on('click',function() {
    $.ajax({
      url : '<?php echo base_url('login/login') ?>',
      type : 'POST',
      data : $('#quickForm').serialize(),
      dataType : 'JSON',
      success : function(data) {
        if (data.status) {
            // alert(data.url)
          toastr.success('Login Berhasil!');
          var url = '<?php echo base_url() ?>'+data.url;
          window.location = url;
        }else if (data.error) {
          toastr.error(
            data.pesan
            );
        }else{
          for (var i = 0; i < data.inputerror.length; i++) 
          {
            $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
            $('[name="'+data.inputerror[i]+'"]').closest('.kosong').append('<span></span>');
            $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
          }
        }
      }
    });

  });

</script>
</body>
</html>

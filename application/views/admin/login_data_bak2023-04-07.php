<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $aplikasi->title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
    <meta  name="description" content="" >
  <meta  name="keywords" content="">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-5.5.0/css/all.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-4.3.0/css/all.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/fontastic.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/stylecopy.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/style.default.css" id="theme-stylesheet">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css"> -->

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
  html, body {
    height: 100%;
  }
  body {
    font-family: 'Roboto', sans-serif;
     background-color: #4158D0;
       background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
  }
  .btn-purple {
    background-color: #b434eb;
    color: white;
    font-weight: bold;
  }
  .demo-container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .btn-lg {
    padding: 12px 26px;
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    
  }
  ::placeholder {
  font-size:14px;
  letter-spacing:0.5px;
  }
  .form-control-lg {
    font-size: 16px;
    padding: 25px 20px;
  }
  .font-500{
  font-weight:500;  
  }
</style>
</head>
<body >
    <!-- <div class="login-box"> -->
        <div class="demo-container">
          <div class="container">
            <div class="row">
              <div class="col-lg-5 col-12 mx-auto">
                <div class="text-center pb-5"> <img width="150px" height="150px" class="img-circle" src="<?php echo base_url("assets/foto/logo/$aplikasi->logo");?>"> </div>
                <div class="p-5 bg-white rounded shadow-lg">
                  <h2 class="mb-2 text-center">Sign In</h2>
                  <p class="text-center lead">Sign In to manage all your devices</p>
                  <form action="" role="form" id="quickForm" method="post">
                    <label class="font-500 " >Username</label>
                    <input name="username" class="form-control form-control-lg mb-3 kosong input-sm" type="text" value="<?php echo set_value('username'); ?>" onkeypress="enter(event)">
                    <span ></span>
                    <label class="font-500 ">Password</label>
                    <input name="password" class="form-control form-control-lg kosong input-sm" type="password" onkeypress="enter(event)" value="<?php echo set_value('password'); ?>">
                    <span ></span>
                    <!-- <p class="m-0 py-4"><a href="" class="text-muted">Forget password?</a></p> -->
                    <p class="m-0 py-4"></p>
                    <button type="button" class="btn btn-purple btn-lg w-100 shadow-lg" onclick="masuk()">LOGIN</button>
                  </form>
                  <div class="text-center pt-4">
                    <!-- <p class="m-0">Do not have an account? <a href="" class="text-dark font-weight-bold">Sign Up</a></p> -->
                  </div>          
                </div>        
              </div>
            </div>
          </div>
        </div>
  <!-- </div> -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>  


<script>
$(document).ready(function () {
   $("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
    $(this).removeClass('is-invalid');
});
})

  function masuk() {
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
            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
          }
        }
      }
    });

  }

  function enter(event) {
    if (event.key === "Enter") {
    event.preventDefault();
    masuk();
  }
}

</script>
</body>
</html>

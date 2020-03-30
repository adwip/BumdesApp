<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title><?= $title?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>asset/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login" style="color:black;">
    <div class="container body">
      <div class="login_content">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h1><img src="<?php echo base_url(); ?>logo2.png"style="max-width:100px;max-height:100px;"> BUMDes Indrakila Jaya</h1>
        </div>
      </div>
      <div class="main_container">
        <form method="POST" action="<?= site_url('registrasi') ?>"  class="form-horizontal form-label-left tex-center">
            <div class="form-group text-center">
                <h2>Ubah email</h2>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="">Nama</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="text" required readonly class="form-control" name="nama" autocomplete="off">
                </div>
            </div> <br>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" required class="form-control" name="email" onkeypress="return (event.charCode !=32)" autocomplete="off" id="username">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" readonly required class="form-control" name="email" onkeypress="return (event.charCode !=32)" autocomplete="off" id="username">
                </div>
            </div> <br>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-3">Kata sandi</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" required class="form-control" name="email" onkeypress="return (event.charCode !=32)" autocomplete="off" id="username">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <input type="text" required class="form-control" name="email" onkeypress="return (event.charCode !=32)" autocomplete="off" id="username">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3" id="warning">
                    <small class="label label-danger">Kata sandi tidak sama</small>
                </div>
            </div> <br>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <button type="submit" class="btn btn-md btn-primary">Kirim</button>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Penjualan Barang</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= css_url('fontawesome.min');?>">
  <link rel="stylesheet" href="<?= css_url('sweetalert2.min');?>">
  <link rel="stylesheet" href="<?= css_url('adminlte.min');?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="<?= site_url('login');?>" class="h1"><b>Radhit</b>DesU</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Penjualan Barang Berbasis Web</p>

      <form action="<?= site_url('login');?>" class="form-ajax" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= js_url('jquery.min');?>"></script>
<script src="<?= js_url('bootstrap.bundle.min');?>"></script>
<script src="<?= js_url('sweetalert2.min');?>"></script>
<script src="<?= js_url('adminlte.min');?>"></script>
<script src="<?= js_url('javascript.min');?>"></script>
</body>
</html>

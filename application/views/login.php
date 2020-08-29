<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LOGIN</title>
  <link href="<?= base_url('assets/favicon.ico') ?>" rel="icon" />
  <link href="<?= base_url('assets/css/default-bootstrap.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/css/general.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/css/signin.css') ?>" rel="stylesheet" />
  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</head>

<body class="hold-transition login-page">
  <div class="container">
    <img src="<?= base_url('assets/image/logo.png'); ?>" width="100px" height="100px" style="display: block; margin-left: auto; margin-right: auto;" alt="">
    <h2 class="text-center" style="color: black">SELAMAT DATANG DI SISTEM INFORMASI PERAMALAN <br>YAMAHA SIP PAHLAWAN</h2>
    <form class="form-signin" method="post">
      <?= print_error() ?>

      <label for="inputEmail" class="sr-only">Usernames</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" autofocus />
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" />
      <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>4
      <a href="<?= site_url('user/forgotPassword'); ?>" class="text-primary text-center mt-3">Lupa Password</a>
    </form>
  </div>
</body>

</html>
<!-- <!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>LOGIN</title>
      <link href="<?=base_url('assets/favicon.ico')?>" rel="icon" />  
      <link href="<?=base_url('assets/css/default-bootstrap.min.css')?>" rel="stylesheet"/>
      <link href="<?=base_url('assets/css/general.css')?>" rel="stylesheet"/>
      <link href="<?=base_url('assets/css/signin.css')?>" rel="stylesheet"/>
      <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
      <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>  
  </head>
  <body class="hold-transition login-page">
    <div class="container">
    <h2 align="center" style="color: black">SELAMAT DATANG DI SISTEM INFORMASI <br>YAMAHA SIP PAHLAWAN</h2>
          <form class="form-signin" method="post">   
            <?=print_error()?>     
                      
            <label for="inputEmail" class="sr-only">Usernames</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" autofocus />
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" />        
            <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>        
          </form>      
        </div>
  </body>
</html>
 -->
<?php
if (!$this->session->userdata('login'))
  redirect('user/login');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" />

  <title>Yamaha SIP Pahlawan Forecasting</title>
  <link href="<?= base_url('assets/css/default-bootstrap.min.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/css/general.css') ?>" rel="stylesheet" />
  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/highcharts.js') ?>"></script>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <div class="navbar-brand">
        <img src="<?= base_url('assets/image/logo.png');?>" align="middle-align" height="25" width="25" >
      </div>    
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= site_url() ?>">Yamaha SIP Pahlawan</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php if ($this->session->userdata('login')) : ?>
            <?php if ($this->session->userdata('level') == 'super') : ?>
              <li><a href="<?= site_url('user') ?>"><span class="glyphicon glyphicon-user"></span> Admin</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'gudang') : ?>
              <li><a href="<?= site_url('atribut') ?>"><span class="glyphicon glyphicon-th"></span> Barang</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'super') : ?>
              <li><a href="<?= site_url('atribut') ?>"><span class="glyphicon glyphicon-th"></span> Barang</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'gudang') : ?>
              <li><a href="<?= site_url('dataset') ?>"><span class="glyphicon glyphicon-th"></span> Periode</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'super') : ?>
              <li><a href="<?= site_url('dataset') ?>"><span class="glyphicon glyphicon-th"></span> Periode</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'pimpinan') : ?>
              <li><a href="<?= site_url('hitung') ?>"><span class="glyphicon glyphicon-stats"></span> Peramalan</a></li>
            <?php endif ?>
            <?php if ($this->session->userdata('level') == 'super') : ?>
              <li><a href="<?= site_url('hitung') ?>"><span class="glyphicon glyphicon-stats"></span> Peramalan</a></li>
            <?php endif ?>
            <li><a href="<?= site_url('user/password') ?>"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="<?= site_url('user/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php else : ?>
            <li><a href="<?= site_url('hitung') ?>"><span class="glyphicon glyphicon-calendar"></span> Hiturng</a></li>
            <li><a href="<?= site_url('user/login') ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="page-header">
      <h1><?= $title ?></h1>
    </div>
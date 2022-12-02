<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>LaPokeparada</title>

   
    <?= $this->renderSection('style') ?>

    <!--  estilos de codeigniter  -->
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/starter-template.css'); ?>">
</head>

<body class="bg-light">
    <!-- navbar -->
    <?= view('App\Views\auth\components\navbar') ?>

    <main role="main" class="container">
      <!-- notifications -->
      <?= view('App\Views\auth\components\notifications') ?>

      <!-- vistas -->
      <?= $this->renderSection('main') ?>
    </main>
  <!-- scripts -->
    <script src="<?= base_url("vendor/jquery/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
    
    <?= $this->renderSection('script') ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>LaPokeparada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/starter-template.css'); ?>">
</head>

<body>

    <!-- main navigation -->
    <?= view('App\Views\auth\components\navbar') ?>

     
    
    <main role="main" class="">
      <div class="jumbotron bg-light">
          <div class="container heroe">
              <h1 class="font-weight-normal">Bienvenido <span class="text-capitalize"><?= $userData['name'] ?></span>!</h1>
              <h2 class="mt-4 font-weight-light">Has iniciado sesion.</h2>
          </div>
      </div>
    </main>
    <div class="row">
        <div class="col-6 ms-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calcular IVA</h5>
                    <form action="calcular">
                        <input type="text" name="calcular" autocomplete="off">
                        <button type="submit" class="btn btn-primary">Calcular</button>
                        <?php if (isset($calcular)): ?>
                            <p class="mt-4">El IVA es: <?= $calcular ?></p>
                        <?php endif; ?>  
                    </form>
                </div>
            </div>
        </div>    
    </div>
    
    <!-- footer -->
    <?= view('App\Views\auth\components\footer') ?>


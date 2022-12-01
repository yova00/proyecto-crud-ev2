<?= $this->extend('auth/layouts/auth') ?>
<?= $this->section('main') ?>

<?= view('App\Views\auth\components\notifications') ?>

<div class="card">
    <div class="card-body text-center">
        <div class="mb-4">
            <img class="brand" height="90" src="https://img.pokemondb.net/sprites/sword-shield/normal/charizard.png" style="width: 250px;height:200px" alt="logo">
        </div>

        <h6 class="mb-4 text-muted">Iniciar sesion</h6>

        <form action="<?= site_url('login'); ?>" method="POST" accept-charset="UTF-8">
            <?= csrf_field() ?>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Ingresar mail" value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Ingresar contraseña">
            </div>

            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Recordar cuenta</label>
                </div>
            </div>

            <button class="btn btn-primary shadow-2 mb-4">Entrar</button>
        </form>

        <p class="mb-2 text-muted"><a href="<?= site_url('forgot-password'); ?>">Olvidaste la contraseña?</a></p>
        <p class="mb-0 text-muted">Registrarse<a href="<?= site_url('register'); ?>"> Registro</a></p>
    </div>
</div>

<?= $this->endSection() ?>
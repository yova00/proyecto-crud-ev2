<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>

  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-info rounded shadow-sm">
    <svg width="48" height="48" viewBox="0 0 16 16" class="mr-3 bi bi-person-square text-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
      <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
    </svg>

    <div class="lh-100">
      <h6 class="mb-0 text-white lh-100">Cuenta</h6>
      <small>Activo desde 2022</small>
    </div>
  </div>

  <div class="card p-3 my-3">
    <form action="<?= site_url('update-profile'); ?>" method="POST" accept-charset="UTF-8" onsubmit="updateProfile.disabled = true; return true;">
      <?= csrf_field() ?>
      <h6 class="pb-2 mb-0 mt-4">Nombre</h6>

      <div class="form-group row mt-3">
        <label class="col-sm-2 col-form-label">Nombres</label>
        <div class="col-sm-10">
          <input type="text" name="firstname" class="form-control col-md-6 text-capitalize" value="<?= $userData["firstname"] ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Apellidos</label>
        <div class="col-sm-10">
          <input type="text" name="lastname" class="form-control col-md-6 text-capitalize" value="<?= $userData["lastname"] ?>">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nombre de usuario</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control col-md-6 text-capitalize" value="<?= $userData["name"] ?>">
        </div>
      </div>

      <h6 class="pb-2 mb-0 mt-4">Contacto</h6>

      <div class="form-group row mt-3">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" name="email" class="form-control col-md-6 text-lowercase" value="<?= $userData["email"] ?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <button name="updateProfile" type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card p-3 my-3">
    <form action="<?= site_url('change-password'); ?>" method="POST" accept-charset="UTF-8" onsubmit="changePassword.disabled = true; return true;">
      <?= csrf_field() ?>
      <h6 class="pb-2 mb-0 mt-4">Cambiar contrase??a</h6>

      <div class="form-group row mt-3">
        <label class="col-sm-2 col-form-label">Contrase??a actual</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control col-md-6" value="" minlength="5" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nueva contrase??a</label>
        <div class="col-sm-10">
          <input type="password" name="new_password" class="form-control col-md-6" value="" minlength="5" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Repita nueva contrase??a</label>
        <div class="col-sm-10">
          <input type="password" name="new_password_confirm" class="form-control col-md-6" value="" minlength="5" required>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <button name="changePassword" type="submit" class="btn btn-primary">Guardar contrase??a</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card p-3">
    <form action="<?= site_url('delete-account') ?>" method="POST" accept-charset="UTF-8" onsubmit="deleteAccount.disabled = true; return true;">
      <?= csrf_field() ?>
      <h6 class="pb-2 mb-0 mt-4">Borrar cuenta</h6>
      <p><?= lang('Auth.deleteAccountInfo') ?></p>

      <div class="form-group row mt-3">
        <label class="col-sm-2 col-form-label">Contrase??a actual</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control col-md-6" value="" minlength="5" required>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <button name="deleteAccount" type="submit" class="btn btn-danger" onclick="return confirm('<?= lang('Auth.areYouSure') ?>')"> <?= lang('Auth.deleteAccount') ?></button>
        </div>
      </div>
    </form>
  </div>

<?= $this->endSection() ?>
<div class="modal fade" id="createuserformmodal" tabindex="-1" role="dialog" aria-labelledby="createuserformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createuserformmodaltitle">Agregar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('users/create-user'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group row">
                <div class="col">
                    <label for="firstname">Folio</label>
                    <input class="form-control" required type="text" name="firstname" value="<?= old('firstname') ?>" placeholder="Ingresa nombres"/>
                </div>
                <div class="col">
                    <label for="lastname">Total</label>
                    <input class="form-control" required type="text" name="lastname" value="<?= old('lastname') ?>" placeholder="Ingresa apellidos"/>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Cliente</label>
                <input class="form-control" required type="text" name="text" value="<?= old('name') ?>" placeholder="Ingresa nombre de usuario"/>
            </div>
            <div class="form-group">
                <label for="forma_pago">Forma de pago</label>
                <input class="form-control" required type="text" name="text" value="<?= old('email') ?>" placeholder="Ingresa correo electronico"/>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary" name="registerButton"><i class="fas fa-plus-circle"></i> Agregar usuario</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
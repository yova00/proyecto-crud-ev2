<div class="modal fade" id="createuserformmodal" tabindex="-1" role="dialog" aria-labelledby="createuserformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createuserformmodaltitle">Agregar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?= site_url('categorias/create-categoria'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group row">
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" required type="text" name="nombre" value="<?= old('nombre') ?>" placeholder="Ingresa nombre  "/>
                </div>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-plus-circle"></i> Agregar categoria</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
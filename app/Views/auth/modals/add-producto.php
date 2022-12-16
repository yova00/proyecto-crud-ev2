<div class="modal fade" id="createuserformmodal" tabindex="-1" role="dialog" aria-labelledby="createuserformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createuserformmodaltitle">Agregar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



        <form action="<?= site_url('productos/create-producto'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group row">
                <div class="col">
                    <label for="codigo">Codigo</label>
                    <input class="form-control" required type="text" name="codigo" value="<?= old('codigo') ?>" placeholder="Ingresa codigo producto"/>
                </div>
                <div class="col">
                    <label for="nombre">Nombre</label>
                    <input class="form-control" required type="text" name="nombre" value="<?= old('nombre') ?>" placeholder="Ingresa nombre producto"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="precio_venta">Precio venta</label>
                    <input class="form-control" required type="text" name="precio_venta" value="<?= old('precio_venta') ?>" placeholder="Ingresa precio venta"/>
                </div>
                <div class="col">
                    <label for="precio_compra">Precio compra</label>
                    <input class="form-control" required type="text" name="precio_compra" value="<?= old('precio_compra') ?>" placeholder="Ingresa precio compra"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="existencias">Existencias</label>
                    <input class="form-control" required type="text" name="existencias" value="<?= old('existencias') ?>" placeholder="Ingresa existencias"/>
                </div>
                <div class="col">
                    <label for="stock_minimo">Stock minimo</label>
                    <input class="form-control" required type="text" name="stock_minimo" value="<?= old('stock_minimo') ?>" placeholder="Ingresa stock minimo"/>
                </div>

            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="inventariable">Inventariable</label>
                    <input class="form-control" required type="text" name="inventariable" value="<?= old('inventariable') ?>" placeholder="Ingresa inventariable"/>
                </div>
                <select class="form-control" name="categoria" id="categoria">
                    <option value="">Selecciona una categoria</option>
                    <?php foreach ($data as $categoria): ?>
                        <option value="<?= $categoria->id ?>"><?= $categoria->nombre ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-control" name="unidades" id="unidades">
                    <option value="">Selecciona un proveedor</option>
                    <?php foreach ($data as $unidades): ?>
                        <option value="<?= $unidades->id ?>"><?= $unidades->nombre ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-plus-circle"></i> Agregar producto</button>
                </div>
            </div>  
        </form>
      </div>
    </div>
  </div>
</div>
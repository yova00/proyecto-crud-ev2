<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Editar usuario</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('productos') ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="card p-3">
        <form action="<?= site_url('productos/update-producto'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nombre">Nombres</label>
                <input class="form-control" required type="text" name="nombre" value="<?= $producto['nombre'] ?>" />
            </div>
            <div class="form-group">
                <label for="categoria">categoria</label>
                <input class="form-control" required type="text" name="categoria" value="<?= $producto['categoria'] ?>" />
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input class="form-control" required type="int" name="stock" value="<?= $producto['stock'] ?>" />
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input class="form-control" required type="int" name="precio" value="<?= $producto['precio'] ?>" />
            </div>
            <div class="form-group">
                <label for="active">Estado</label>
                <select class="form-control" name="active" required>
                    <?php if ($producto['active'] === 1) : ?>
                        <option value="1" selected>Habilitado</option>
                    <?php else : ?>
                        <option value="1">Habilitado</option>
                    <?php endif ?>

                    <?php if ($producto['active'] === 0) : ?>
                        <option value="0" selected>Deshabilitado</option>
                    <?php else : ?>
                        <option value="0">Deshabilitado</option>
                    <?php endif ?>
                </select>
              </div>
            <div class="text-right">
                <input name="id_p" type="hidden" value="<?= $producto['id_p'] ?>" readonly/>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Guardar</button>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>
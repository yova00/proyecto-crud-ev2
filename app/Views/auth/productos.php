<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create producto modal form -->
    <?= view('App\Views\auth\modals\add-producto') ?>

<?= $this->endSection() ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3 border-info">
          <div class="card-body border-info">
            <h5 class="card-title text-info">Total Productos</h5>
            <h3 class="card-text text-info"><?= $productocount ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-success">
          <div class="card-body border-success">
            <h5 class="card-title text-success">Nuevos Productos</h5>
            <h3 class="card-text text-success"><?= $newproductos ?> <span class="text-small text-muted"></span></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-secondary">
          <div class="card-body border-secondary">
            <h5 class="card-title text-secondary">Productos Disponibles</h5>
            <h3 class="card-text text-secondary"><?= $percentofactiveproductos ?>%</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Listado de productos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createuserformmodal"><i class="fas fa-producto-plus"></i> Crear producto</button>
        </div>
    </div>

    <div class="card p-3 border-primary">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                      <th>id</th>
                      <th>codigo</th>
                      <th>nombre</th>
                      <th>precio_venta</th>
                      <th>precio_compra</th>
                      <th>existencias</th>
                      <th>stock_minimo</th>
                      <th>inventariable</th>
                      <th>id_unidades</th>
                      <th>id_categoria</th>
                      <th>Activo</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $item):?>
                    <tr>
   
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['codigo'] ?></td>
                        <td><?= $item['nombre'] ?></td>
                        <td><?= $item['precio_venta'] ?></td>
                        <td><?= $item['precio_compra'] ?></td> 
                        <td><?= $item['existencias'] ?></td>
                        <td><?= $item['stock_minimo'] ?></td>
                        <td><?= $item['inventariable'] ?></td>
                        <td><?= $item['id_unidades'] ?></td>
                        <td><?= $item['id_categoria'] ?></td>
                        <td>
                            <?php if ($item['activo'] == 1) : ?>
                                Habilitado
                            <?php else : ?>
                                Deshabilitado
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            <?php if ($item['activo'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('productos/enable/').$item['id'] ?>"><i class="fas fa-user-check"></i> Habilitar</a>
                            <?php endif ?>

                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('productos/edit/').$item['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('productos/delete/').$item['id'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>
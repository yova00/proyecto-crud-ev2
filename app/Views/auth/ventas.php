<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create venta modal form -->
    <?= view('App\Views\auth\modals\add-venta') ?>

<?= $this->endSection() ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4 ">
        <div class="card mt-3 border-info">
          <div class="card-body border-info">
            <h5 class="card-title text-info">Ventas totales</h5>
            <h3 class="card-text text-info"><?= $ventacount ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-success">
          <div class="card-body border-success">
            <h5 class="card-title text-success">Nuevas Ventas</h5>
            <h3 class="card-text text-success"><?= $newventas ?> <span class="text-small text-muted"></span></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-secondary">
          <div class="card-body border-secondary">
            <h5 class="card-title text-secondary">Ventas activas</h5>
            <h3 class="card-text text-secondary"><?= $percentofactiveventas ?>%</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Ventas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createuserformmodal"><i class="fas fa-circle"></i> Agregar una venta</button>
        </div>
    </div>

    <div class="card p-3 border-primary">
        <div class="table-responsive">
            <table width="100%; opacity=30%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>+iva</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id_v'] ?></td>
                        <td><?= $item['n_cliente'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= $item['producto'] ?></td>
                        <td><?= $item['cantidad'] ?></td>
                        <td><?= $item['total'] ?></td>
                        <td><?= $item['totaliva'] ?></td>
                        <td>
                            <?php if ($item['active'] == 1) : ?>
                                Habilitado
                            <?php else : ?>
                                Deshabilitado
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            <?php if ($item['active'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('ventas/enable/').$item['id_v'] ?>"><i class="fas fa-venta-check"></i> Habilitar</a>
                            <?php endif ?>

                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('ventas/edit/').$item['id_v'] ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('ventas/delete/').$item['id_v'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>
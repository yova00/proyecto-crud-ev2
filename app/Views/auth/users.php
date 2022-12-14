<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-user') ?>

<?= $this->endSection() ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4 ">
        <div class="card mt-3 border-info">
          <div class="card-body border-info">
            <h5 class="card-title text-info">Usuarios totales</h5>
            <h3 class="card-text text-info"><?= $usercount ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-success">
          <div class="card-body border-success">
            <h5 class="card-title text-success">Nuevos usuarios</h5>
            <h3 class="card-text text-success"><?= $newusers ?> <span class="text-small text-muted"></span></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3 border-secondary">
          <div class="card-body border-secondary">
            <h5 class="card-title text-secondary">Cuentas activas</h5>
            <h3 class="card-text text-secondary"><?= $percentofactiveusers ?>%</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Usuarios</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createuserformmodal"><i class="fas fa-user-plus"></i> Crear un usuario</button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td>
                            <?php if ($item['active'] == 1) : ?>
                                Habilitado
                            <?php else : ?>
                                Deshabilitado
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            <?php if ($item['active'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('users/enable/').$item['id'] ?>"><i class="fas fa-user-check"></i> Habilitar</a>
                            <?php endif ?>

                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('users/edit/').$item['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('users/delete/').$item['id'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>
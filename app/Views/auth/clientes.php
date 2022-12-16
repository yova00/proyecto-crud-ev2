<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>






<!-- load modals -->
<?= $this->section('modals') ?>



    <!-- create producto modal form -->
    <?= view('App\Views\auth\modals\add-clientes') ?>




<?= $this->endSection() ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Listado de Clientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createuserformmodal"><i class="fas fa-producto-plus"></i> Crear cliente</button>
        </div>
    </div>

    <div class="card p-3 border-primary">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Activo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['nombre'] ?></td>
                        <td><?= $item['direccion'] ?></td>
                        <td><?= $item['telefono'] ?></td>
                        <td><?= $item['correo'] ?></td>
                        <td>
                            <?php if ($item['activo'] == 1) : ?>
                                Habilitado
                            <?php else : ?>
                                Deshabilitado
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            <?php if ($item['activo'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clientes/enable/').$item['id'] ?>"><i class="fas fa-user-check"></i> Habilitar</a>
                            <?php endif ?>

                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clientes/edit/').$item['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clientes/delete/').$item['id'] ?>"><i class="fas fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2"><?php echo $titulo;?></h1>
    </div>

    <div>
        <p>
            <a href="<?php echo site_url();?>/unidades/nuevo" class="btn btn-primary">Agregar</a>
        </p>
    </div>

   <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Nombre corto</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato):?>
                    <tr>
                        <td><?php echo $dato['id'];?></td>
                        <td><?php echo $dato['nombre'];?></td>
                        <td><?php echo $dato['nombre_corto'];?></td>
                        <td><a href="<?php echo site_url().'/unidades/editar/'.$dato['id'];?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a href="<?php echo site_url().'/unidades/eliminar/'.$dato['id'];?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

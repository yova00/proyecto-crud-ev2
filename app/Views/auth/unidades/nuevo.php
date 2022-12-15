<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2"><?php echo $titulo;?></h1>
</div>


<form method="POST" action="<?php echo site_url('/insertar');?>" autocomplete="off">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
    </div>
    <div class="form-group">
        <label for="nombre_corto">Nombre corto</label>
        <input type="text" class="form-control" id="nombre_corto" name="nombre_corto" placeholder="Nombre corto" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?php echo base_url();?>/unidades" class="btn btn-primary">Regresar</a>
</form>

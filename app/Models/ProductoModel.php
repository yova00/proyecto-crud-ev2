<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
	protected $table      = 'productos';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'codigo', 'nombre', 'precio_venta','precio:compra', 'existencias','stock_minimo', 'inventariable','id_unidades','id_categoria', 'activo', 'fecha_creada','fecha_edit',
	];

	protected $useTimestamps = true;
	protected $createdField  = 'fecha_creada';
	protected $updatedField  = 'fecha_edit';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
	];

	protected $validationMessages = [];

	protected $skipValidation = false;




    //--------------------------------------------------------------------

    /**
     * Retrieves validation rule
	 * 
     */
	

    //--------------------------------------------------------------------

}

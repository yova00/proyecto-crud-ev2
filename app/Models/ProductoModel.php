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
		'registration' => [
			'codigo' 		=> 'required|alpha_space|min_length[2]',
			'nombre' 			=> 'required|alpha_space|min_length[2]',
			'precio_venta' 			=> 'required|alpha_space|min_length[2]',
			'precio_compra' 			=> 'required|alpha_space|min_length[2]',
			'existencias' 			=> 'required|alpha_space|min_length[2]',
			'stock_minimo' 			=> 'required|alpha_space|min_length[2]',
			'inventariable' 			=> 'required|alpha_space|min_length[2]',
			'id_unidades' 			=> 'required|alpha_space|min_length[2]',
			'id_categoria' 			=> 'required|alpha_space|min_length[2]',
		],
		'updateAccount' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]'
		],
		'updateProfile' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'precio_venta'	=> 'required|alpha_space|min_length[2]',
			'precio_compra'	=> 'required|alpha_space|min_length[2]',
			'existencias'	=> 'required|alpha_space|min_length[2]',
			'stock_minimo'	=> 'required|alpha_space|min_length[2]',
			'inventariable'	=> 'required|alpha_space|min_length[2]',
			'id_unidades'	=> 'required|alpha_space|min_length[2]',
			'id_categoria'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
		],
		'enableproducto' => [
			'id_p'	=> 'required|is_natural',
			'activo'	=> 'required|integer'
		]
	];

	protected $validationMessages = [];

	protected $skipValidation = false;




    //--------------------------------------------------------------------

    /**
     * Retrieves validation rule
     */
	public function getRule(string $rule)
	{
		return $this->dynamicRules[$rule];
	}

    //--------------------------------------------------------------------

}

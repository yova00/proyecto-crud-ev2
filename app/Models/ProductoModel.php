<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
	protected $table      = 'productos';
	protected $primaryKey = 'id_p';
	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nombre', 'stock', 'categoria','precio', 'fecha_creada', 'activo', 'fecha_edit', 'deleted_at'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'fecha_creada';
	protected $updatedField  = 'fecha_edit';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'registration' => [
			'nombre' 		=> 'required|alpha_space|min_length[2]',
			'stock' 			=> 'required|alpha_space|min_length[2]',
			'categoria' 				=> 'required|alpha_space|min_length[2]',
            'precio' 				=> 'required|int',
			
		],
		'updateAccount' => [
			'id_p'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]'
		],
		'updateProfile' => [
			'id_p'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'stock'	=> 'required|integer',
			'categoria'	=> 'required|alpha_space|min_length[2]',
            'precio'	=> 'required|integer',
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

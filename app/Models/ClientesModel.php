<?php namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
	protected $table      = 'unidades';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nombre', 'direccion', 'telefono','correo','activo', 'fecha_creada', 'fecha_edit',
	];

	protected $useTimestamps = true;
	protected $createdField  = 'fecha_creada';
	protected $updatedField  = 'fecha_edit';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'registration' => [
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'direccion'	=> 'required|alpha_space|min_length[2]',
			'telefono'	=> 'required|alpha_space|min_length[2]',
			'correo'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
			
		],
		'updateAccount' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'direccion'	=> 'required|alpha_space|min_length[2]',
			'telefono'	=> 'required|alpha_space|min_length[2]',
			'correo'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
		],
		'updateProfile' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'direccion'	=> 'required|alpha_space|min_length[2]',
			'telefono'	=> 'required|alpha_space|min_length[2]',
			'correo'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
		],
		'enableproducto' => [
			'id'	=> 'required|is_natural',
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

<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
	protected $table      = 'categorias';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'nombre', 'activo', 'fecha_creada', 'fecha_edit', 'deleted_at'
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
		],
		'updateAccount' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			
		],
		'updateProfile' => [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
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

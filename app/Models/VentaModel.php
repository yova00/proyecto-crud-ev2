<?php namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
	protected $table      = 'ventas';
	protected $primaryKey = 'id_v';

	protected $returnType = 'array';
	protected $useSoftDeletes = false;

	// this happens first, model removes all other fields from input data
	protected $allowedFields = [
		'n_cliente', 'email', 'producto', 'cantidad', 'total', 'totaliva', 'active'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $dateFormat  	 = 'datetime';

	protected $validationRules = [];

	// we need different rules for registration, account update, etc
	protected $dynamicRules = [
		'registration' => [
			'n_cliente' 		=> 'required|alpha_space|min_length[2]',
			'producto' 			=> 'required|alpha_space|min_length[2]',
			'cantidad' 				=> 'required|integer',
			'email' 			=> 'required|valid_email|is_unique[ventas.email,id_v,{id_v}]',
			'totaliva'			=> 'required|integer',
            'total'			=> 'required|double',
		],
		'updateAccount' => [
			'id_v'	=> 'required|is_natural',
			'n_cliente'	=> 'required|alpha_space|min_length[2]'
		],
		'updateProfile' => [
			'id_v'	=> 'required|is_natural',
			'n_cliente'	=> 'required|alpha_space|min_length[2]',
			'producto'	=> 'required|alpha_space|min_length[2]',
			'cantidad'	=> 'required|integer',
			'email'	=> 'required|valid_email|is_unique[ventas.email,id_v,{id_v}]',
			'active'	=> 'required|integer',
		],
		'enableventa' => [
			'id'	=> 'required|is_natural',
			'active'	=> 'required|integer'
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

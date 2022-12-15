<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\UnidadesModel;
use App\Models\LogsModel;

class UnidadesController extends Controller
{

	/**
	 * Access to current session.
	 *
	 * @var \CodeIgniter\Session\Session
	 */
	protected $session;

	/**
	 * Authentication settings.
	 */
	protected $config;


    //--------------------------------------------------------------------

	public function __construct()
	{
		// start session
		$this->session = Services::session();
	}

    //--------------------------------------------------------------------

	/**
	 * Displays unidadess page.
	 */
	public function unidades()
	{
		// check if unidade is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load unidade model
		$unidades = new UnidadesModel();

		// getall unidades
		$allunidades = $unidades->findAll(); 

		// count all rows in unidades table
		$countunidades = $unidades->countAll(); 

		// count all active unidade in the last 30 days
		$newunidades = $unidades->like("fecha_creada", $ym)->countAllResults(); 

		// count all active unidades
		$activeunidades = $unidades->where('activo', 1)->countAllResults(); 

		// calculate active unidades in how many percents
		$percentofactiveunidades = ($activeunidades / $countunidades) * 100;
		
		// load the view with session data
		return view('auth/unidades', [
				'unidadeData' => $this->session->unidadeData, 
				'data' => $allunidades, 
				'unidadecount' => $countunidades, 
				'newunidades' => $newunidades,
				'percentofactiveunidades' => $percentofactiveunidades
			]);
	}

	public function enable()
	{
		// get the unidade id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$unidades = new UnidadesModel();

		$unidade = [
			'id'  	=> $id,
			'activo'  	=> 1,
		];

		if (! $unidades->save($unidade)) {
			return redirect()->back()->withInput()->with('errors', $unidades->errors());
        }

        return redirect()->back()->with('success', 'Volvio a estar disponible el unidade');
	}

	public function edit()
	{
		// get the unidade id
		$id = $this->request->uri->getSegment(3);

		// load unidade model
		$unidades = new UnidadesModel();

		// get unidade data using the id
		$unidade = $unidades->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-unidade', [
				'unidadeData' => $this->session->unidadeData, 
				'unidade' => $unidade, 
			]);
	}

	public function update()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'nombre_corto'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$unidades = new UnidadesModel();

		$unidade = [
			'id'  	=> $this->request->getPost('id'),
			'nombre' 	=> $this->request->getPost('nombre'),
			'nombre_corto' 	=> $this->request->getPost('nombre_corto'),
			'activo' 	=> $this->request->getPost('activo')
		];

		if (! $unidades->save($unidade)) {
			return redirect()->back()->withInput()->with('errors', $unidades->errors());
        }

        return redirect()->back()->with('success', 'unidade actualizado y guardado correctamente en BDD, presione Volver para ir al listado unidades'); 
	}

	public function delete()
	{
		// get the unidade id
		$id = $this->request->uri->getSegment(3);

		// load unidade model
		$unidades = new UnidadesModel();

		// delete unidade using the id
		$unidades->delete($id);

        return redirect()->back()->with('success', 'unidade eliminado correctamente de BDD');
	}

	public function createunidad()
	{
		helper('text');

		// save new unidade, validation happens in the model
		$unidades = new UnidadesModel();
		$getRule = $unidades->getRule('registration');
		$unidades->setValidationRules($getRule);
		
        $unidade = [
            'nombre'          	=> $this->request->getPost('nombre'),
            'nombre_corto'          	=> $this->request->getPost('nombre_corto'),
        ];

        if (! $unidades->save($unidade)) {
			return redirect()->back()->withInput()->with('errors', $unidades->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un unidade nuevo.');
	}

	

}

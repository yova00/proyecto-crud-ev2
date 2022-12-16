<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\ClientesModel;
use App\Models\LogsModel;

class ClientesController extends Controller
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
	 * Displays clientess page.
	 */
	public function clientes()
	{
		// check if cliente is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load cliente model
		$clientes = new ClientesModel();

		// getall clientes
		$allclientes = $clientes->findAll(); 

		// count all rows in clientes table
		$countclientes = $clientes->countAll(); 

		// count all active cliente in the last 30 days
		$newclientes = $clientes->like("fecha_creada", $ym)->countAllResults(); 

		// count all active clientes
		$activeclientes = $clientes->where('activo', 1)->countAllResults(); 

		// calculate active clientes in how many percents
		$percentofactiveclientes = ($activeclientes / $countclientes) * 100;
		
		// load the view with session data
		return view('auth/clientes', [
				'clienteData' => $this->session->clienteData, 
				'data' => $allclientes, 
				'clientecount' => $countclientes, 
				'newclientes' => $newclientes,
				'percentofactiveclientes' => $percentofactiveclientes
			]);
	}

	public function enable()
	{
		// get the cliente id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$clientes = new ClientesModel();

		$cliente = [
			'id'  	=> $id,
			'activo'  	=> 1,
		];

		if (! $clientes->save($cliente)) {
			return redirect()->back()->withInput()->with('errors', $clientes->errors());
        }

        return redirect()->back()->with('success', 'Volvio a estar disponible el cliente');
	}

	public function edit()
	{
		// get the cliente id
		$id = $this->request->uri->getSegment(3);

		// load cliente model
		$clientes = new ClientesModel();

		// get cliente data using the id
		$cliente = $clientes->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-cliente', [
				'clienteData' => $this->session->clienteData, 
				'cliente' => $cliente, 
			]);
	}

	public function update()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'direccion'	=> 'required|min_length[2]',
			'telefono'	=> 'required|min_length[2]',
			'correo'	=> 'required|min_length[2]',
			
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$clientes = new ClientesModel();

		$cliente = [
			'id'  	=> $this->request->getPost('id'),
			'nombre' 	=> $this->request->getPost('nombre'),
			'direccion'          	=> $this->request->getPost('direccion'),
			'telefono'          	=> $this->request->getPost('telefono'),
			'correo'          	=> $this->request->getPost('correo'),
			
		];

		if (! $clientes->save($cliente)) {
			return redirect()->back()->withInput()->with('errors', $clientes->errors());
        }

        return redirect()->back()->with('success', 'cliente actualizado y guardado correctamente en BDD, presione Volver para ir al listado clientes'); 
	}

	public function delete()
	{
		// get the cliente id
		$id = $this->request->uri->getSegment(3);

		// load cliente model
		$clientes = new ClientesModel();

		// delete cliente using the id
		$clientes->delete($id);

        return redirect()->back()->with('success', 'cliente eliminado correctamente de BDD');
	}

	public function createcliente()
	{
		helper('text');

		// save new cliente, validation happens in the model
		$clientes = new ClientesModel();
		$getRule = $clientes->getRule('registration');
		$clientes->setValidationRules($getRule);
		
        $cliente = [
            'nombre'          	=> $this->request->getPost('nombre'),
            'direccion'          	=> $this->request->getPost('direccion'),
			'telefono'          	=> $this->request->getPost('telefono'),
			'correo'          	=> $this->request->getPost('correo'),
        ];

        if (! $clientes->save($cliente)) {
			return redirect()->back()->withInput()->with('errors', $clientes->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un cliente nuevo.');
	}

	

}

<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\VentaModel;
use App\Models\LogsModel;

class VentaController extends Controller
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
	 * Displays ventas page.
	 */
	public function ventas()
	{
		// check if venta is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load venta model
		$ventas = new VentaModel();

		// getall ventas
		$allventas = $ventas->findAll(); 

		// count all rows in ventas table
		$countventas = $ventas->countAll(); 

		// count all active venta in the last 30 days
		$newventas = $ventas->like("created_at", $ym)->countAllResults(); 

		// count all active ventas
		$activeventas = $ventas->where('active', 1)->countAllResults(); 

		// calculate active ventas in how many percents
		$percentofactiveventas = ($activeventas / $countventas) * 100;
		
		// load the view with session data
		return view('auth/ventas', [
				'ventaData' => $this->session->ventaData, 
				'data' => $allventas, 
				'ventacount' => $countventas, 
				'newventas' => $newventas,
				'percentofactiveventas' => $percentofactiveventas
			]);
	}

	public function enable()
	{
		// get the venta id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$ventas = new VentaModel();

		$venta = [
			'id_p'  	=> $id,
			'active'  	=> 1,
		];

		if (! $ventas->save($venta)) {
			return redirect()->back()->withInput()->with('errors', $ventas->errors());
        }

        return redirect()->back()->with('success', 'Volvio a estar disponible el venta');
	}

	public function edit()
	{
		// get the venta id
		$id = $this->request->uri->getSegment(3);

		// load venta model
		$ventas = new ventaModel();

		// get venta data using the id
		$venta = $ventas->where('id_p', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-venta', [
				'ventaData' => $this->session->ventaData, 
				'venta' => $venta, 
			]);
	}

	public function update()
	{
		$rules = [
			'id_p'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'stock'	=> 'required|integer',
			'categoria'	=> 'required|alpha_space|min_length[2]',
            'precio'	=> 'required|integer',
			'active'	=> 'required|integer',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$ventas = new VentaModel();

		$venta = [
			'id_v'  	=> $this->request->getPost('id_v'),
			'n_cliente' 	=> $this->request->getPost('n_cliente'),
			'producto' 	=> $this->request->getPost('producto'),
			'cantidad' 	=> $this->request->getPost('cantidad'),
            'total' 	=> $this->request->getPost('total'),
			'totaliva' 	=> $this->request->getPost('totaliva'),
			'email' 	=> $this->request->getPost('email'),
			'active' 	=> $this->request->getPost('active')
		];

		if (! $ventas->save($venta)) {
			return redirect()->back()->withInput()->with('errors', $ventas->errors());
        }

        return redirect()->back()->with('success', 'venta actualizado y guardado correctamente en BDD, presione Volver para ir al listado ventas'); 
	}

	public function delete()
	{
		// get the venta id
		$id = $this->request->uri->getSegment(3);

		// load venta model
		$ventas = new VentaModel();

		// delete venta using the id
		$ventas->delete($id);

        return redirect()->back()->with('success', 'venta eliminado correctamente de BDD');
	}

	public function createventa()
	{
		helper('text');

		// save new venta, validation happens in the model
		$ventas = new VentaModel();
		$getRule = $ventas->getRule('registration');
		$ventas->setValidationRules($getRule);
		
        $venta = [
            'id_v'  	=> $this->request->getPost('id_v'),
			'n_cliente' 	=> $this->request->getPost('n_cliente'),
			'producto' 	=> $this->request->getPost('producto'),
			'cantidad' 	=> $this->request->getPost('cantidad'),
            'total' 	=> $this->request->getPost('total'),
			'totaliva' 	=> $this->request->getPost('totaliva'),
			'email' 	=> $this->request->getPost('email'),
			'active' 	=> $this->request->getPost('active')
        ];

        if (! $ventas->save($venta)) {
			return redirect()->back()->withInput()->with('errors', $ventas->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un producto nuevo.');
	}

	

}



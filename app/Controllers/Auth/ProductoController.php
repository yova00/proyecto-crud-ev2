<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\ProductoModel;
use App\Models\LogsModel;

class ProductoController extends Controller
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
	 * Displays productos page.
	 */
	public function productos()
	{
		// check if producto is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load producto model
		$productos = new ProductoModel();

		// getall productos
		$allproductos = $productos->findAll(); 

		// count all rows in productos table
		$countproductos = $productos->countAll(); 

		// count all active producto in the last 30 days
		$newproductos = $productos->like("created_at", $ym)->countAllResults(); 

		// count all active productos
		$activeproductos = $productos->where('active', 1)->countAllResults(); 

		// calculate active productos in how many percents
		$percentofactiveproductos = ($activeproductos / $countproductos) * 100;
		
		// load the view with session data
		return view('auth/productos', [
				'productoData' => $this->session->productoData, 
				'data' => $allproductos, 
				'productocount' => $countproductos, 
				'newproductos' => $newproductos,
				'percentofactiveproductos' => $percentofactiveproductos
			]);
	}

	public function enable()
	{
		// get the producto id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$productos = new ProductoModel();

		$producto = [
			'id_p'  	=> $id,
			'active'  	=> 1,
		];

		if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('success', lang('Auth.enableproducto'));
	}

	public function edit()
	{
		// get the producto id
		$id = $this->request->uri->getSegment(3);

		// load producto model
		$productos = new ProductoModel();

		// get producto data using the id
		$producto = $productos->where('id_p', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-producto', [
				'productoData' => $this->session->productoData, 
				'producto' => $producto, 
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

		$productos = new ProductoModel();

		$producto = [
			'id_p'  	=> $this->request->getPost('id_p'),
			'nombre' 	=> $this->request->getPost('nombre'),
			'stock' 	=> $this->request->getPost('stock'),
			'categoria' 	=> $this->request->getPost('categoria'),
            'precio' 	=> $this->request->getPost('precio'),
			'active' 	=> $this->request->getPost('active')
		];

		if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('success', lang('Auth.updateSuccess'));
	}

	public function delete()
	{
		// get the producto id
		$id = $this->request->uri->getSegment(3);

		// load producto model
		$productos = new ProductoModel();

		// delete producto using the id
		$productos->delete($id);

        return redirect()->back()->with('success', lang('Auth.accountDeleted'));
	}

	public function createproducto()
	{
		helper('text');

		// save new producto, validation happens in the model
		$productos = new ProductoModel();
		$getRule = $productos->getRule('registration');
		$productos->setValidationRules($getRule);
		
        $producto = [
            'nombre'          	=> $this->request->getPost('nombre'),
            'stock'          	=> $this->request->getPost('stock'),
            'categoria'          	=> $this->request->getPost('categoria'),
            'precio'          	=> $this->request->getPost('precio'),
        ];

        if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un producto nuevo.');
	}

	public function productoLogs() 
	{
		// load logs model
		$logs = new LogsModel();
		// get all producto logs
		$productologs = $logs->findAll();

		return view('auth/producto-logs', ['productoData' => $this->session->productoData, 'data' => $productologs]);
	}

}

<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\CategoriaModel;
use App\Models\LogsModel;

class CategoriasController extends Controller
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
	 * Displays categoriass page.
	 */
	public function categorias()
	{
		// check if categoria is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->to('login');
		}

		// current year and month variable 
		$ym = date("Y-m");

		// load categoria model
		$categorias = new CategoriaModel();

		// getall categorias
		$allcategorias = $categorias->findAll(); 

		// count all rows in categorias table
		$countcategorias = $categorias->countAll(); 

		// count all active categoria in the last 30 days
		$newcategorias = $categorias->like("fecha_creada", $ym)->countAllResults(); 

		// count all active categorias
		$activecategorias = $categorias->where('activo', 1)->countAllResults(); 

		// calculate active categorias in how many percents
		$percentofactivecategorias = ($activecategorias / $countcategorias) * 100;
		
		// load the view with session data
		return view('auth/categorias', [
				'categoriaData' => $this->session->categoriaData, 
				'data' => $allcategorias, 
				'categoriacount' => $countcategorias, 
				'newcategorias' => $newcategorias,
				'percentofactivecategorias' => $percentofactivecategorias
			]);
	}

	public function enable()
	{
		// get the categoria id
		$id = $this->request->uri->getSegment(3);

		// validation does not work when data is not submitted via post form
		// $rules = [
		// 	'id'	=> 'required|integer',
		// ];

		// if (! $this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		$categorias = new CategoriaModel();

		$categoria = [
			'id'  	=> $id,
			'activo'  	=> 1,
		];

		if (! $categorias->save($categoria)) {
			return redirect()->back()->withInput()->with('errors', $categorias->errors());
        }

        return redirect()->back()->with('success', 'Volvio a estar disponible el categoria');
	}

	public function edit()
	{
		// get the categoria id
		$id = $this->request->uri->getSegment(3);

		// load categoria model
		$categorias = new CategoriaModel();

		// get categoria data using the id
		$categoria = $categorias->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-categoria', [
				'categoriaData' => $this->session->categoriaData, 
				'categoria' => $categoria, 
			]);
	}

	public function update()
	{
		$rules = [
			'id'	=> 'required|is_natural',
			'nombre'	=> 'required|alpha_space|min_length[2]',
			'activo'	=> 'required|integer',
		];

		if (! $this->validate($rules)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$categorias = new CategoriaModel();

		$categoria = [
			'id'  	=> $this->request->getPost('id'),
			'nombre' 	=> $this->request->getPost('nombre'),
			'activo' 	=> $this->request->getPost('activo')
		];

		if (! $categorias->save($categoria)) {
			return redirect()->back()->withInput()->with('errors', $categorias->errors());
        }

        return redirect()->back()->with('success', 'categoria actualizado y guardado correctamente en BDD, presione Volver para ir al listado categorias'); 
	}

	public function delete()
	{
		// get the categoria id
		$id = $this->request->uri->getSegment(3);

		// load categoria model
		$categorias = new CategoriaModel();

		// delete categoria using the id
		$categorias->delete($id);

        return redirect()->back()->with('success', 'categoria eliminado correctamente de BDD');
	}

	public function createcategoria()
	{
		helper('text');

		// save new categoria, validation happens in the model
		$categorias = new CategoriaModel();
		$getRule = $categorias->getRule('registration');
		$categorias->setValidationRules($getRule);
		
        $categoria = [
            'nombre'          	=> $this->request->getPost('nombre'),
        ];

        if (! $categorias->save($categoria)) {
			return redirect()->back()->withInput()->with('errors', $categorias->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un categoria nuevo.');
	}

	

}

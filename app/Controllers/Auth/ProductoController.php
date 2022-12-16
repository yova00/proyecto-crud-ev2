<?php
namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use Config\Email;
use Config\Services;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use App\Models\UnidadesModel;
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

		//categorias
		$categoria = new CategoriaModel();
		$allcategoria = $categoria->findAll();

		//unidades
		$unidades = new UnidadesModel();
		$allunidades = $unidades->findAll();

		// count all rows in productos table
		$countproductos = $productos->countAll(); 

		// count all active producto in the last 30 days
		$newproductos = $productos->like("fecha_creada", $ym)->countAllResults(); 

		// count all active productos
		$activeproductos = $productos->where('activo', 1)->countAllResults(); 

		// calculate active productos in how many percents
		$percentofactiveproductos = ($activeproductos / $countproductos) * 100;

		$cat = new CategoriaModel();
		$uni = new UnidadesModel();

		$categorias = $cat->findAll();
		$unidades = $uni->findAll();
		
		// load the view with session data
		return view('auth/productos', [
				'productoData' => $this->session->productoData, 
				'categorias' => $allcategoria, 
				'productos' => $allproductos,
				'unidades' => $allunidades,
				'productocount' => $countproductos, 
				'newproductos' => $newproductos,
				'categorias' => $categorias,
				'unidades' => $unidades,
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
			'id'  	=> $id,
			'activo'  	=> 1,
		];

		if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('success', 'Volvio a estar disponible el producto');
	}

	public function edit()
	{
		// get the producto id
		$id = $this->request->uri->getSegment(3);

		// load producto model
		$productos = new ProductoModel();
		$categorias = new CategoriaModel();
		$unidades = new UnidadesModel();
		// get producto data using the id
		$producto = $productos->where('id', $id)->first(); 
		$unidade = $productos->where('id', $id)->first(); 

		// load the view with session data
		return view('auth/edits/edit-producto', [
				'productoData' => $this->session->productoData, 
				'producto' => $producto, 
			]);
	}

	public function update()
	{
		

		$productos = new ProductoModel();

		$producto = [
			'id'  	=> $this->request->getPost('id'),
			'codigo'  	=> $this->request->getPost('codigo'),
			'nombre'  	=> $this->request->getPost('nombre'),
			'precio_venta'  	=> $this->request->getPost('precio_venta'),
			'precio_compra'  	=> $this->request->getPost('precio_compra'),
			'existencias'  	=> $this->request->getPost('existencias'),
			'stock_minimo'  	=> $this->request->getPost('stock_minimo'),
			'inventariable'  	=> $this->request->getPost('inventariable'),
			'id_unidades'  	=> $this->request->getPost('id_unidades'),
			'id_categoria'  	=> $this->request->getPost('id_categoria'),
		];

		if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('success', 'Producto actualizado y guardado correctamente en BDD, presione Volver para ir al listado productos'); 
	}

	public function delete()
	{
		// get the producto id
		$id = $this->request->uri->getSegment(3);

		// load producto model
		$productos = new ProductoModel();

		// delete producto using the id
		$productos->delete($id);

        return redirect()->back()->with('success', 'Producto eliminado correctamente de BDD');
	}

	public function nuevo()
	{
		// load producto model
		$productos = new ProductoModel();
		$categorias = new CategoriaModel();
		$unidades = new UnidadesModel();

		//obtener las categorias
		$categorias = $categorias->findAll();

		//obtener las unidades
		$unidades = $unidades->findAll();

		//Definir la data
		$this->data = [
			'titulo' => 'Nuevo Producto',
			'categorias' => $categorias,
			'unidades' => $unidades
		];

		//enviar los datos
		echo view('auth/modals/add-producto', $data);

		// load the view with session dat

		// load the view with session dat
		//$data = ['titulo' => 'Nuevo Producto', 'productos' => $productos->findAll(), 'categorias' => $categorias->findAll(), 'unidades' => $unidades->findAll()];
		

		
		//Enviar datos al modal
		//$this->load->view('auth/nuevo/nuevo-producto', $this->data);
	}

	public function createproducto()
	{
		helper('text');

		// save new producto, validation happens in the model
		$productos = new ProductoModel();
		$unidade = new UnidadesModel();
		$categorias = new CategoriaModel();


		$unidade = [
			'id'  	=> $this->request->getPost('id'),
        ];
		
        $producto = [
            'codigo'  	=> $this->request->getPost('codigo'),
			'nombre'  	=> $this->request->getPost('nombre'),
			'precio_venta'  	=> $this->request->getPost('precio_venta'),
			'precio_compra'  	=> $this->request->getPost('precio_compra'),
			'existencias'  	=> $this->request->getPost('existencias'),
			'stock_minimo'  	=> $this->request->getPost('stock_minimo'),
			'inventariable'  	=> $this->request->getPost('inventariable'),
			'id_unidades'  	=> $this->request->getPost('id_unidades'),
			'id_categoria'  	=> $this->request->getPost('id_categoria'),
        ];

        if (! $productos->save($producto)) {
			return redirect()->back()->withInput()->with('errors', $productos->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un producto nuevo.');
	}

	

}

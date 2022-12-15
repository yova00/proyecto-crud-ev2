<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UnidadesModel;

class Unidades extends BaseController
{
    protected $unidades;

    public function __construct()
    {
        $this->unidades = new UnidadesModel();
    }

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo',$activo)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $unidades];

        echo view('auth/components/header');
        echo view('auth/unidades/unidades',$data);
        echo view('auth/components/footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar unidad'];

        echo view('auth/components/header');
        echo view('auth/unidades/nuevo',$data);
        echo view('auth/components/footer');
    }

    public function insertar()
    {

        $unidades = new UnidadesModel();
        $unidades->setValidationRules($getRule);

        $this->unidades->save(['nombre' => $this->request->getPost('nombre'),
                                'nombre_corto' => $this->request->getPost('nombre_corto')]);
        if (! $unidades->save($unidades)) {
			return redirect()->back()->withInput()->with('errors', $unidades->errors());
        }

        return redirect()->back()->with('Aceptado', 'Se ha ingresado un producto nuevo.');
    }

}

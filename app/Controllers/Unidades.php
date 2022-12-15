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
        $this->unidades->save(['nombre' => $this->request->getPost('nombre'),
                                'nombre_corto' => $this->request->getPost('nombre_corto')]);
        return redirect()->to(site_url().'/unidades');
    }

}

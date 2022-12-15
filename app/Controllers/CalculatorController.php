<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CalculatorController extends BaseController
{
    public function index($activo = 1)
    {

        echo view('auth/components/header');
        echo view('auth/calculator');
        echo view('auth/components/footer');
    }
}
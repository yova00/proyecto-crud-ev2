<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class CalculatorController extends BaseController
{
    public function calcular()
    {
        $calcular = $this->request->getVar('calcular');
        $calcular = $calcular * 0.19;
        
        echo $calcular;
        
    }
}
<?php

namespace App\Http\Controllers\AreaEmpresa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
  public function index(){
  	return view('areaEmpresa.empresa.index');
  }  //
}

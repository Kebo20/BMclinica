<?php

namespace App\Http\Controllers;

use App\DocElectronico;
use Greenter\Report\HtmlReport;

class DocumentosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        $documentos = DocElectronico::orderby('fecha_emision','desc')
            ->orderBy('hora_emision','desc')->get();
        return $documentos;
    }


    //
}

<?php

namespace App\Http\Controllers;

use App\Log;
use App\Migrant;
use App\Utils\Api;
use App\Utils\ApiConst;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    	$data = [
    		'title' => ""
    	];

    	return view("index", $data);
    }

    public function new_migrant(){
        $data = [
            'title' => "Enregistrement d'un migrant | ",
        ];

        return view("new_migrant", $data);
    }

    public function test()
    {

    	$data = [
    		'title' => "PDF | ",
    	];

    	// Send data to the view using loadView function of PDF facade
        $pdf = \PDF::loadFile(public_path()."../resources/views/index.blade.php", $data);
        $pdf->save(public_path()."file.pdf");
        $pdf->stream('download.pdf');
        dd('qsdqsd');

    	// If you want to store the generated pdf to the server then you can use the store function
    	// dd(public_path().'\fichier.pdf');
    	$pdf->save(public_path()."/fichier.pdf");

    	// Finally, you can download the file using download function
    	return $pdf->download('customers.pdf');
    }
}

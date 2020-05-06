<?php

namespace App\Http\Controllers;

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
    		'title' => "Enregistrement d'un nouveau migrant | ",
    	];

    	return view("new", $data);
    }

    public function add_migrant(Request $request){
    	$this->validate($request, [
    		'nom' => "required",
    		'prenom' => "required",
    		'cni' => "required|unique:migrants",
    		'email' => "required|email",
    		'telephone' => "required",
    		'adresse' => "required",
    	]);

    	extract($request->all());
    	Migrant::create([
    		'nom' => $nom,
    		'prenom' => $prenom,
    		'cni' => $cni,
    		'email' => $email,
    		'telephone' => $telephone,
    		'adresse' => $adresse,
    		'nbre_retraits' => ApiConst::NBRE_RETRAITS,
            'solvability' => 0,
    		'date_creation' => time(),
    	]);

    	// générer le pdf contenant le QR code du migrant ...

    	return redirect()->route('home.show_code', ['code' => $cni]);
    }

    public function show_qr_code($code){
    	$data = [
    		'title' => "Visualisation du QR Code d'un migrant | ",
    		'url' => ApiConst::URL.$code,
    		'url2' => Api::requestApi(null,ApiConst::URL.$code,true),
    	];

    	return view("qr", $data);
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

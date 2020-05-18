<?php

namespace App\Http\Controllers;

use App\Log;
use App\Migrant;
use App\Utils\Api;
use App\Utils\ApiConst;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
    	$data = [
    		'title' => "Admin Side | ",
            'migrants' => Migrant::all(),
    	];

    	return view("dashboard.index", $data);
    }

    public function new_migrant(){
        $data = [
            'title' => "Enregistrement d'un nouveau migrant | ",
        ];

        return view("dashboard.new", $data);
    }

    public function add_migrant(Request $request){
        $this->validate($request, [
            'nom' => "required",
            'prenom' => "required",
            // 'cni' => "unique:migrants",
            // 'email' => "required|email",
            // 'telephone' => "required",
            'adresse' => "required",
        ]);

        if(!is_null($request->cni)){
            $this->validate($request, ['cni' => "unique:migrants"]);
        }

        extract($request->all());

        $unique_code = Api::generate_random_value(15);
        $user = Migrant::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'cni' => $cni,
            'email' => $email,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'qr_code' => $unique_code,
            'nbre_retraits' => ApiConst::NBRE_RETRAITS,
            'solvability' => 0,
            'date_creation' => time(),
        ]);


        Log::create([
            'user_id' => $user->id,
            'action' => "Nouveau migrant.",
            'details' => json_encode($user),
            'date_action' => time()
        ]);

        // générer le pdf contenant le QR code du migrant ...

        return redirect()->route('migrants.show_code', ['code' => $unique_code]);
    }

    // public function generate_random_value($length = 60){
    //     do {
    //         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //         $charactersLength = strlen($characters);
    //         $randomString = '';
    //         for ($i = 0; $i < $length; $i++) {
    //             $randomString .= $characters[rand(0, $charactersLength - 1)];
    //         }

    //         $code = Migrant::where('qr_code', $randomString)->first();
    //     } while (! is_null($code));

    //     return $randomString;
    // }

    public function show_qr_code($code){
        if(is_null($code)){
            return redirect()->route('migrants.new');
        }

        $data = [
            'title' => "Visualisation du QR Code d'un migrant | ",
            'code' => $code,
        ];

        return view("dashboard.qr", $data);
    }
}

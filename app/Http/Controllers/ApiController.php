<?php

namespace App\Http\Controllers;

use App\Log;
use App\Migrant;
use App\Utils\Api;
use App\Utils\ApiConst;
use App\Utils\ApiStatus;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function get_all_migrants(){
        return json_encode(Migrant::all());
    }
	/**
	 * Vérifie la validité du code et renvoie les infos et un token valide 
	 */
    public function check_migrant_code($code){
    	$migrant = Migrant::where('qr_code', $code)->get()[0];
         // Bon je quitte anydesk ... tu rebuild ton apk et tu testes ... ok a

    	if(is_null($migrant)){
            $data = [
                'statut' => "ok",
                'message' => "Migrant not found",
            ];
            return json_encode($data);
    		// return Api::respond(ApiStatus::err("Migrant not found"));
            // essaye de diviser la data quitte a envoyer juste le migrant en question voir...
            // hallo.....
    		exit();
    	}

    	$token = Api::generate_random_value();
        // $token = $this->generate_random_value();
    	// $token = time()+ApiConst::TOKEN_VALIDATION_TIME; // Je crée un token valide 5 minutes pour qu'il récupère son repas 

    	$migrant->update([
    		'token' => $token,
    	]);
    	$migrant->save();

    	$data = [
            'status' => "ok",
    		'token' => $token,
    		'migrant' => $migrant,
    		'food' => ($migrant->nbre_retraits > 0) ? true : false,
    	];

        return json_encode($migrant);
    	// return Api::respond(ApiStatus::ok("Well Done"), $data);
    }

    public function give_food($token){
    	$migrant = Migrant::where('token', $token)->first();

    	if(is_null($migrant)){
            $data = [
                'statut' => "ok",
                'message' => "Migrant not found",
            ];

            return json_encode($data);
    		// return Api::respond(ApiStatus::err("Migrant not found"));
    		exit();
    	}

    	$migrant->update([
    		'nbre_retraits' => $migrant->nbre_retraits - 1,
    		'token' => null,
    	]);

    	Log::create([
    		'user_id' => $migrant->id,
    		'action' => "Retrait repas",
    		'details' => json_encode($migrant),
    		'date_action' => time()
    	]);

    	$data = [
            'statut' => "ok",
    		'date_retrait' => date("H:i d M Y", time()),
    		'nbre_retraits_restant' => $migrant->nbre_retraits,
    	];

        return json_encode($data);
    	// return Api::respond(ApiStatus::ok("Retrait effectué avec succès. Bon appétit !"), $data);
    }


    
}

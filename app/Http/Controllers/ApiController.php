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
	/**
	 * Vérifie la validité du code et renvoie les infos et un token valide 
	 */
    public function check_migrant_code($code){
    	$migrant = Migrant::where('cni', $code)->get()[0];

    	if(is_null($migrant)){
    		return Api::respond(ApiStatus::err("Migrant not found"));
    		exit();
    	}

    	$token = $this->generate_random_value();
    	// $token = time()+ApiConst::TOKEN_VALIDATION_TIME; // Je crée un token valide 5 minutes pour qu'il récupère son repas 

    	$migrant->update([
    		'token' => $token,
    	]);
    	$migrant->save();

    	$data = [
    		'token' => $token,
    		'migrant' => $migrant,
    		'food' => ($migrant->nbre_retraits > 0) ? true : false,
    	];

    	return Api::respond(ApiStatus::ok("Well Done"), $data);
    }

    public function give_food($token){
    	$migrant = Migrant::where('token', $token)->first();

    	if(is_null($migrant)){
    		return Api::respond(ApiStatus::err("Migrant not found"));
    		exit();
    	}

    	// if(is_null($migrant->token)){
    	// 	return Api::respond(ApiStatus::err("Missing token"));
    	// 	exit();
    	// }
    	// if($migrant->token < time()){
    	// 	return Api::respond(ApiStatus::err("Token expired."));
    	// 	exit();
    	// }

    	$migrant->update([
    		'nbre_retraits' => $migrant->nbre_retraits - 1,
    	]);

    	Log::create([
    		'user_id' => $migrant->id,
    		'action' => "Retrait repas",
    		'details' => json_encode($migrant),
    		'date_action' => time()
    	]);

    	$data = [
    		'date_retrait' => date("H:i d M Y", time()),
    		'nbre_retraits_restant' => $migrant->nbre_retraits,
    	];

    	return Api::respond(ApiStatus::ok("Retrait effectué avec succès. Bon appétit !"), $data);
    }


    public function generate_random_value($length = 60){
	    do {
	    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    	$charactersLength = strlen($characters);
	    	$randomString = '';
	    	for ($i = 0; $i < $length; $i++) {
	    		$randomString .= $characters[rand(0, $charactersLength - 1)];
	    	}

	    	$code = Migrant::where('token', $randomString)->first();
	    } while (! is_null($code));

    	return $randomString;
    }
}

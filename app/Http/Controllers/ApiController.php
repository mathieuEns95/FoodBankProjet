<?php

namespace App\Http\Controllers;

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
    	$migrant = Migrant::where('cni', $code)->first();

    	if(is_null($migrant)){
    		return Api::respond(ApiStatus::err("Migrant not found"));
    		exit();
    	}

    	$token = time()+ApiConst::TOKEN_VALIDATION_TIME; // Je crée un token valide 5 minutes pour qu'il récupère son repas 

    	$migrant->update([
    		'token' => $token,
    	]);

    	$data = [
    		'token' => $token,
    		'migrant' => $migrant,
    		'food' => ($migrant->nbre_retraits > 0) ? true : false,
    	];

    	return Api::respond(ApiStatus::ok("Well Done"), $data);
    }

    public function give_food($code){
    	$migrant = Migrant::where('cni', $code)->first();

    	if(is_null($migrant)){
    		return Api::respond(ApiStatus::err("Migrant not found"));
    		exit();
    	}

    	if(is_null($migrant->token)){
    		return Api::respond(ApiStatus::err("Missing token"));
    		exit();
    	}
    	if($migrant->token < time()){
    		return Api::respond(ApiStatus::err("Token expired."));
    		exit();
    	}

    	$migrant->update([
    		'nbre_retraits' => $migrant->nbre_retraits - 1,
    	]);

    	Log::create([
    		'user_id' => $migrant->id,
    		'action' => "Retrait repas",
    		'details' => json_encode($migrant),
    		'date_action' => time()
    	]);

    	return Api::respond(ApiStatus:ok("Retrait effectué avec succès. Bon appétit !"));

    }
}

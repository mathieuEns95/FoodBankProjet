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
    	}

    	$data = [
    		'token' => bcrypt(time()+ApiConst::TOKEN_VALIDATION_TIME),
    		'migrant' => $migrant,
    	];

    	return Api::respond(ApiStatus::ok("Well Done"), $data);
    }
}

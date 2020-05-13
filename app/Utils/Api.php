<?php


namespace App\Utils;


use App\Migrant;
use Illuminate\Http\JsonResponse;

class Api
{
    public static function generate_random_value($length = 60){
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

    public static function respond(ApiStatus $apiStatus,array $payload = [], int $httpStatus=200){
        return response()->json([
            "status" => $apiStatus->getCode(),
            "message" => $apiStatus->getMessage(),
            "data"=>$payload
        ],$httpStatus);
    }

    public static function respondUnauthorized(string $message="Unauthorized"){
        return self::respond(ApiStatus::err("unauthorized"),["errors"=>["authorization"=>$message]],401);
    }

    public static function respondSuccess($data = [],string $message="ok"){
        return self::respond(ApiStatus::ok($message),$data);
    }

    public static function respondWithValidationErr(array $errors){
        return self::respond(
            ApiStatus::err(__("validation.error")),
            ["errors"=>$errors],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public static function respondWithToken(string $token,$data = []){
        return Api::respond(ApiStatus::ok(__("auth.login.successful")),array_merge([
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ],$data));
    }

    /**
     * Fonction qui se charge de faire les requêtes vers l'extérieur
     * @param [Array] $data : Paramètres
     * @param [String] $url : Route à laquelle les données seront postées
     * @param [boolean] $raw : Permettant de savoir si on doit renvoyer les données brutes ou pas ...
     * 
     * @return ..... baaaaah les données !
     */
    public static function requestApi($data,$url, $raw=false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if($raw){
            return $data;
            exit();
        }

        $response = json_decode($data, true);

        if ($err) {
            $response = (array)$response;
            return $response['error']=$err;
        }else {
            return (array)$response;
        }
    }

    /**
     * Pour ne pas avoir à ajouter les 2 things ci à chaque fois ...
     */
    public static function addApiAccess($data){
        $data['api_id'] = ApiConst::api_id;
        $data['api_key'] = ApiConst::api_key;

        return $data;
    }

    public static function GETRequestApi($data,$url, $raw=false){

        $curl = curl_init();
        $url = sprintf("%s?%s", $url, http_build_query($data));        
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    
}
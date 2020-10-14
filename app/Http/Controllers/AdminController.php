<?php

namespace App\Http\Controllers;

use DB;
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
            'migrants' => Migrant::all()
    	];

    	return view("dashboard.index", $data);
    }

    public function new_migrant(){
        $data = [
            'title' => "Enregistrement d'un nouveau migrant | ",
        ];

        return view("dashboard.new", $data);
    }

    public static function get_qrcode($id){
        $supplements = [ "0000", "000", "00", "0", "" ];

        return "TSF". @$supplements[strlen($id)]."$id";
    }

    public function add_migrant(Request $request){

        $this->validate($request, [
            'nom' => "required",
            'prenom' => "required",
            'pays' => "required",
            'date_of_birth' => "required",
            'passeport' => "required",
            'email' => "required",
            'profession' => "required",
            'adresse' => "required",
            'nbre_coloc' => "required",
            'telephone' => "required"
        ]);

        if(!is_null($request->cni)){
            $this->validate($request, ['passeport' => "unique:migrants"]);
        }

        extract($request->all());

        $user = Migrant::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'pays' => $pays,
            'date_naissance' => $date_of_birth,
            'passeport' => $passeport,
            'email' => $email,
            'profession' => $profession,
            'adresse' => $adresse,
            'nbre_coloc' => $nbre_coloc,
            'nbre_enfants' => $nbre_enfants,
            'telephone' => $telephone,
            'nbre_retraits' => ApiConst::NBRE_RETRAITS,
            'solvability' => 0,
            'date_creation' => time(),
        ]);


        $unique_code = self::get_qrcode($user->id);
        
        $user->qr_code = $unique_code;
        $user->save();


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

    public function delete_migrant(Request $request){
        $this->validate($request, [
            'migrant_id' => "required|integer",
        ]);

        $migrant = Migrant::find($request->migrant_id);

        $migrant_to_delete = $migrant;

        $migrant->delete();

        Log::create([
            'user_id' => auth()->user()->id,
            'action' => "Suppression d'un migrant",
            'details' => json_encode($migrant_to_delete),
            'date_action' => time()
        ]);

        return redirect()->back();
    }

    public function edit_migrant($id){
        $migrant = Migrant::find($id);

        if(is_null($migrant)){
            return redirect()->route('admin.index');
        }

        $data = [
            'title' => "Modifier les infos d'un migrant | ",
            'migrant' => $migrant,
        ];

        return view("dashboard.edit", $data);
    }

    public function update_migrant(Request $request, $id){
        $this->validate($request, [
            'nom' => "required",
            'prenom' => "required",
            'cni' => "required",
            'email' => "required|email",
            'telephone' => "required",
            'adresse' => "required",
        ]);

        $migrant = Migrant::find($id);

        if(!is_null($migrant)){
            extract($request->all());

            $migrant->update([
                'nom' => $nom,
                'prenom' => $prenom,
                'passeport' => $cni,
                'email' => $email,
                'telephone' => $telephone,
                'adresse' => $adresse,
                'solvability' => $solvability,
                'date_creation' => time(),
            ]);

            Log::create([
                'user_id' => auth()->user()->id,
                'action' => "M.A.J d'un migrant",
                'details' => json_encode($migrant),
                'date_action' => time()
            ]);
        }


        return redirect()->route('admin.index');
    }

    public function statistiques(){
        $stats_per_age = DB::table("migrants")
                    ->select(DB::raw("count(*) as nbre, date_format(date_naissance, '%Y%') as annee"))
                    ->groupBy("annee")
                    ->orderBy("annee", "DESC")
                    ->get();

        $stats_per_country = DB::table("migrants")
                    ->select(DB::raw("count(*) as nbre, pays"))
                    ->groupBy("pays")
                    ->orderBy("pays", "DESC")
                    ->get();

        $stats_per_profession = DB::table("migrants")
                    ->select(DB::raw("count(*) as nbre, profession"))
                    ->groupBy("profession")
                    ->orderBy("profession", "DESC")
                    ->get();

        $stats_per_adresse = DB::table("migrants")
                    ->select(DB::raw("count(*) as nbre, adresse"))
                    ->groupBy("adresse")
                    ->orderBy("adresse", "DESC")
                    ->get();

        $data = [
            'title' => "statistiques | ",
            'stats_per_age' => $stats_per_age,
            'stats_per_country' => $stats_per_country,
            'stats_per_profession' => $stats_per_profession,
            'stats_per_adresse' => $stats_per_adresse,
        ];

        return view("dashboard.statistiques", $data);
    }
}

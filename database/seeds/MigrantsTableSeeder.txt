<?php

use App\Migrant;
use App\Utils\ApiConst;
use Illuminate\Database\Seeder;

class MigrantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Migrant::create([
        	'nom' =>"Nom 1",
    		'prenom' => "Prenom 1",
    		'cni' => "010203",
    		'email' => "email@domain.com",
    		'telephone' => "601020304",
    		'adresse' => "Mon domicile",
    		'nbre_retraits' => ApiConst::NBRE_RETRAITS,
            'solvability' => 0,
    		'date_creation' => time(),
        ]);
        Migrant::create([
        	'nom' =>"Nom 2",
    		'prenom' => "Prenom 2",
    		'cni' => "01020304",
    		'email' => "email2@domain.com",
    		'telephone' => "601020304",
    		'adresse' => "Mon domicile 2",
    		'nbre_retraits' => ApiConst::NBRE_RETRAITS,
            'solvability' => 0,
    		'date_creation' => time(),
        ]);
    }
}

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
    	for($cpt=1; $cpt<15; $cpt++){

    		Migrant::create([
    			'nom' => "Nom $cpt",
    			'prenom' => "Prenom $cpt",
    			'pays' => "Cameroun",
    			'date_naissance' => rand(1980,2002)."-".rand(1,12)."-".rand(1,26),
    			'passeport' => "fakePasseport $cpt",
    			'profession' => "Malade $cpt",
    			'adresse' => "Adresse $cpt",
    			'nbre_coloc' => rand(0,2),
    			'nbre_enfants' => rand(0,3),
    			'telephone' => "+237 9876548765$cpt",
    			'solvability' => 0,
    			'email' =>"email".$cpt."@domain.com",
    			'date_creation' => time()
    		]);
    	}

    }
}

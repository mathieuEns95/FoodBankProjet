<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migrant extends Model
{
    protected $fillable = [
    	'nom', 'prenom', 'pays', 'date_naissance', 'passeport', 'profession', 'adresse', 'nbre_coloc', 'nbre_enfants', 'telephone', 'email', 'password', 'qr_code', 'solvability', 'date_creation', 'token'
    ];

    protected $hidden = [
    	'id', 'created_at', 'updated_at', 'date_creation',
    ];
}

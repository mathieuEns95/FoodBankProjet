<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migrant extends Model
{
    protected $fillable = [
        'cni', 'nom','email', 'prenom', 'telephone', 'adresse', 'qr_code', 'nbre_retraits', 'solvability', 'date_creation', 'token',
    ];

    protected $hidden = [
    	'id', 'created_at', 'updated_at', 'date_creation',
    ];
}

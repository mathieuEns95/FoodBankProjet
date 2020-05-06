<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migrant extends Model
{
    protected $fillable = [
        'cni', 'nom', 'prenom', 'telephone', 'adresse', 'nbre_retraits', 'solvability', 'date_creation',
    ];
}

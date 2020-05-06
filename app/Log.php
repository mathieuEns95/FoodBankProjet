<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id', 'action', 'details', 'date_action',
    ];

    protected $hidden = [
    	'created_at', 'updated_at',
    ];
}

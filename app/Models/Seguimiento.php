<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;
    protected $table = 'seguimientos';
    protected $guarded = ['id','created_at','updated_at'];

    public function pAccion(){
        // return $this->hasOne('App\Profile', 'clave_foranea', 'clave_local_a_relacionar');
        return $this->belongsTo(PAcciom::class,'pAccionId');

    }
}

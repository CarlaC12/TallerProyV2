<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PAccion extends Model
{
    use HasFactory;
    protected $table = 'p_accions';
    protected $guarded = ['id','created_at','updated_at'];

    public function resultadoDenver(){
        // return $this->hasOne('App\Profile', 'clave_foranea', 'clave_local_a_relacionar');
        return $this->belongsTo('App\Models\ResultadoDenver' ,'evaluacionId');

    }

    public function seguimiento() {
        return $this->hasOne(seguimiento::class);
    }
}

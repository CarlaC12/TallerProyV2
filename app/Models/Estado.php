<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    
    use HasFactory;

    protected $table = 'estado';
    protected $fillable = [
        'name',
        'description',
    ];

    public function evaluaciones()
    {
        return $this->belongsToMany(EvaluacionDenver::class, 'evaluacion_estado');
    }
}

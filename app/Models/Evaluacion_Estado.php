<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion_Estado extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_estado';
    protected $fillable = [
        'evaluacion_id',
        'estado_id',
        'precision'
    ];
    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionDenver::class, 'evaluacion_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    use HasFactory;

    // Tabla asociada (opcional si sigue la convención pluralizada)
    protected $table = 'hours';

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'titulo',
        'ambito',
        'archivo',
        'cantidad',
        'user_id',
    ];

}

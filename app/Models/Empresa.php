<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    
    use HasFactory;

    protected $guarded = [];

    //Relacion del modelo de empresa con el modelo de categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //Relacion del modelo de empresa con el modelo de usuarios (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

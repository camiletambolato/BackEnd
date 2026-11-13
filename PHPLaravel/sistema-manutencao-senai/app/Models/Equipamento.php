<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory; // uma Biblioteca para habilitar a fábrica de modelos

    protected $table = "Equipamento"; //nome da tabela no banco de dados

    //atributos da tabela ativos(counas) ()
    protected $fillable = [
        "tag",
        "nome",
        "setor",
        "criticidade",
        "status",
        
    ];
}

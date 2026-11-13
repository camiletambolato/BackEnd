<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory; // uma Biblioteca para habilitar a fábrica de modelos

    protected $table = "OrdemServico"; //nome da tabela no banco de dados

    //atributos da tabela ativos(counas) ()
    protected $fillable = [
        "codigo",
        "titulo",
        "equipamento_id",
        "tipo",
        "prioridade",
        "status",
        "tecnico",
        "data_abertura",
        "prazo_limite",
        
    ];
}

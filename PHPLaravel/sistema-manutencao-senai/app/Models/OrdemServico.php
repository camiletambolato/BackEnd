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


    //Retornar o catalogo de ordens de serviços
    public static function todas(): array {
        return self::query()->get()->all();
    }

    //localizar uma ordem de serviço pelo código único
    public static function buscarPorCodigo(string $codigo): ?self {
        return self::query()->where("codigo", $codigo)->first();
    }

}

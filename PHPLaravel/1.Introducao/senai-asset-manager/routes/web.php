<?php
declare(strict_types=1);

use App\Http\Controllers\AtivoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

// Rota Principal da Minha aplicação : Dashboard de Ativos Fabris
Route::get("/", [AtivoController::class, "index"])->name("ativos.index");

// Rota de Infraestrutura Json
Route::get("/status", [AtivoController::class, "status"])->name("ativos.status");

// --- ROTAS DE CLIENTES ---

// Rota para filtro por setor de clientes
Route::get("/clientes/setor/{setor?}", [ClienteController::class, "filtrarPorSetor"])
    ->name("clientes.setor")
    ->whereAlphaNumeric("setor");

// Rota RESTful (GET, POST, PUT/PATCH, DELETE) para Clientes
Route::resource("clientes", ClienteController::class)->whereNumber("cliente");


// --- ROTAS DE PRODUTOS ---

// Rota para filtro por fabricante de produtos
Route::get("/produtos/fabricante/{fabricante?}", [ProdutoController::class, "filtrarPorFabricante"])
    ->name("produtos.fabricante")
    ->whereAlphaNumeric("fabricante");

// Rota RESTful (GET, POST, PUT/PATCH, DELETE) para Produtos
Route::resource("produtos", ProdutoController::class)->whereNumber("produto");
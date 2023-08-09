<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;

// Route::get('enderecos', [EnderecoController::class, 'index'])->name('enderecos.index');
Route::get('/enderecos/buscar/{cep}', [EnderecoController::class, 'buscarEnderecoViaApi'])->name('EnderecoController.buscarEnderecoViaApi');
Route::get('/enderecos/listarTudo', [EnderecoController::class, 'listarTudo'])->name('EnderecoController.listarTudo');
Route::get('/enderecos/save', [EnderecoController::class, 'save'])->name('EnderecoController.save');

Route::get('/', function () {
    return view('welcome');
});


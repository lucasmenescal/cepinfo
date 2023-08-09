<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnderecoController;

// Route::get('enderecos', [EnderecoController::class, 'index'])->name('enderecos.index');
Route::get('/enderecos/buscar/{cep}', [EnderecoController::class, 'buscar'])->name('EnderecoController.buscar');
Route::get('/enderecos/listarTudo', [EnderecoController::class, 'listarTudo'])->name('EnderecoController.listarTudo');
Route::get('/enderecos/save', [EnderecoController::class, 'save'])->name('EnderecoController.save');
Route::get('/enderecos/delete/{cep}', [EnderecoController::class, 'delete'])->name('EnderecoController.delete');
Route::get('/enderecos/update/{cep}', [EnderecoController::class, 'update'])->name('EnderecoController.update');

Route::get('/', function () {
    return view('welcome');
});


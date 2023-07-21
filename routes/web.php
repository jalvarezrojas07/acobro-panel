<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;

Route::get('/{campanaId?}', [PanelController::class, 'index'])->name('panel_inicio');
Route::post('/filtrar_campana', [PanelController::class, 'filtrar_campana'])->name('panel_filtrar_campana');


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatrizController;

Route::post('rotar', [MatrizController::class, 'postRotar']);

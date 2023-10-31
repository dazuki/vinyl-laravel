<?php

use App\Livewire\ArtistShow;
use App\Livewire\VinylTable;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', VinylTable::class);

Route::get('/artist/{art_id}', ArtistShow::class);

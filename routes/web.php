<?php

use App\Livewire\Login;
use App\Livewire\ArtistEdit;
use App\Livewire\ArtistShow;
use App\Livewire\VinylTable;
use Illuminate\Http\Request;
use App\Livewire\CreateVinyl;
use App\Livewire\CreateArtist;
use App\Livewire\VinylHistory;
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

Route::get('/', VinylTable::class)->name('home');

Route::get('/history', VinylHistory::class);

Route::get('/artist/{art_id}', ArtistShow::class)->name('artistshow');

Route::get('/export/artist', [VinylTable::class, 'export']);

Route::get('/export/view', [VinylTable::class, 'view']);

Route::get('/edit/artist/{art_id}', ArtistEdit::class);

Route::get('/create/vinyl', CreateVinyl::class)->middleware('auth.basic');

Route::get('/create/artist', CreateArtist::class)->middleware('auth.basic');

Route::get('/login', Login::class)->middleware('auth.basic');

Route::get('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth.basic');

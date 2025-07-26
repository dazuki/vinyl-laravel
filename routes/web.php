<?php

use App\Livewire\Login;
use App\Livewire\ArtistShow;
use App\Livewire\VinylTable;
use Illuminate\Http\Request;
use App\Livewire\CreateVinyl;
use App\Livewire\CreateArtist;
use App\Livewire\VinylHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', VinylTable::class)->name('home');

Route::get('/history', VinylHistory::class);

Route::get('/artist/{artist}', ArtistShow::class)->name('artistshow');

Route::get('/export/artist', [VinylTable::class, 'export'])->middleware('auth.basic');
Route::get('/export/view', [VinylTable::class, 'view'])->middleware('auth.basic');

Route::get('/create/vinyl', CreateVinyl::class)->middleware('auth.basic');
Route::get('/create/artist', CreateArtist::class)->middleware('auth.basic');

Route::get('/login', Login::class)->name('login')->middleware('auth.basic');
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return to_route('home');
})->name('logout')->middleware('auth.basic');

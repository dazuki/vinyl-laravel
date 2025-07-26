<?php

use App\Livewire\Login;
use App\Livewire\ArtistShow;
use App\Livewire\VinylTable;
use Illuminate\Http\Request;
use App\Livewire\CreateVinyl;
use App\Livewire\CreateArtist;
use App\Livewire\AdminPanel;
use App\Livewire\VinylHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', VinylTable::class)->name('home');

Route::get('/history', VinylHistory::class)->name('history');

Route::get('/artist/{artist}', ArtistShow::class)->name('artist');

Route::get('/export/artist', [VinylTable::class, 'export'])->name('export.artist')->middleware('auth.basic');
Route::get('/export/view', [VinylTable::class, 'view'])->name('export.view')->middleware('auth.basic');

Route::get('/admin', AdminPanel::class)->name('admin')->middleware('auth.basic');

Route::get('/create/vinyl', CreateVinyl::class)->name('create.vinyl')->middleware('auth.basic');
Route::get('/create/artist', CreateArtist::class)->name('create.artist')->middleware('auth.basic');

Route::get('/login', Login::class)->name('login')->middleware('auth.basic');
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return to_route('home');
})->name('logout')->middleware('auth.basic');

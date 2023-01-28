<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::name('client.')->prefix('client')->group(function (){
    Route::get('/', function () {
        return view('client.register');
    } )->name('index');

    Route::get('/login', function () {
        return view('client.login');
    } )->name('login');

    Route::get('/register', function () {
        return view('client.register');
    } )->name('register');

    Route::get('/ticket/{phone}', function ($phone) {
        return view('client.dashboard',['phone'=>$phone]);
    } )->name('ticket');
});

Route::name('vet.')->prefix('vet')->group(function (){
    Route::get('/', function () {
        dd('vet');
    } )->name('index');

    Route::get('/login', function () {
        return view('vet.login');
    } )->name('login');

    Route::get('/register', function () {
        return view('vet.register');
    } )->name('register');

    Route::get('/dashboard', function () {
        dd('vet');
    } )->name('ticket');
});



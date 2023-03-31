<?php

use Illuminate\Support\Facades\DB;
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
    return view('client.register');
    return view('welcome');
})->name('index');

Route::get('/admin', function () {
    return view('welcome');
})->name('admin');


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
    
    Route::get('/email/{id?}', function ($id=null) {
        return view('mails.email',['phone'=>'0809166690','pet_name'=>'มอมแมม','vet_name'=>'โรงพยาบาลสัตว์สักที่']);
    } )->name('email');
    
    Route::get('/delete/{id?}', function ($id=null) {
        if($id==='all'){
            DB::table('clients')->delete();
            return view('welcome');
        }else if($id){
            DB::table('clients')->where('phone', $id)->delete();
            return view('welcome');
        }
        return redirect(route('index')) ;
    } )->name('delete');
    

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



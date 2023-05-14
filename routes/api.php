<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/vets',function(){

    foreach (DB::table('vets')->get() as $index => $vet) {
        // dd($vet->user_id);
        $vet_list[$index]['id']=$vet->id;
        $vet_list[$index]['name']=$vet->user_id.' '.$vet->vet_name;
        $vet_list[$index]['description']=$vet->vet_area.' '.$vet->vet_city.' '.$vet->vet_province;
    }
    // dd($vet_list);
    return $vet_list;
})->name('vets');

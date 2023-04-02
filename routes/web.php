<?php

use App\Models\Client;
use App\Models\Vet;
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

Route::get('/download',function(){

    $fileName = 'client.csv';
    $Clients = Client::all();
    
    $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    $columns = array('code', 'name', 'email', 'phone', 'status', 'activate date', 'vet name' ,'Pet name', 'Pet bread', 'Pet Weight', 'Pet Age','basic offer','extra offer');

    $callback = function() use($Clients, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($Clients as $Client) {
            $row['code']  = $Client->client_code;
            $row['name']    = $Client->name;
            $row['email']    = $Client->email;
            $row['phone']  = $Client->phone;
            $row['status']  = $Client->active_status;
            $row['activate_date']  = $Client->active_date??"-";
            $row['vet']  = Vet::find($Client->vet_id)->vet_name??$Client->vet_id;
            
            $option = explode("-", $Client->phoneIsVerified);
            // dd(str_contains($option[1],'standard'),str_contains($option[1],'extra'));
            if( is_array($option) ){
                $row['offerBasic'] = count($option)>1?str_contains($option[1],'standard'):"";
                $row['offerExtra'] = count($option)>1?str_contains($option[1],'extra'):"";
            }

            $row['petName']  = $Client->pet_name;
            $row['petBreed']  = $Client->pet_breed;
            $row['petWeight']  = $Client->pet_weight;
            $row['petAge']  = $Client->pet_age_month.' Year '.$Client->pet_age_month.' Month';

            fputcsv($file, array($row['code'], $row['name'], $row['email'], $row['phone'], $row['status'], $row['activate_date'], $row['vet'], $row['petName'],$row['petBreed'],$row['petWeight'],$row['petAge'],$row['offerBasic'],$row['offerExtra']));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
    
})->name('dl');



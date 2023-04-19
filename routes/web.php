<?php

use App\Models\Client;
use App\Models\ClientInfo;
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
Route::middleware('auth')->name('admin.')->prefix('admin')->group(function (){
    // Route::get('/', function () {
    //     // dd('dashboard');
    //     return view('admin.dashboard');
    // } )->name('index');

    Route::get('/dashboard', function () {
        // dd('dashboard');
        return view('admin.dashboard');
    } )->name('dashboard');
    
    Route::get('/vet', function () {
        // dd('vets');
        return view('admin.vets');
    } )->name('vets');

    Route::get('/vet/{id}', function ($id) {
        // dd('vet single',$id);
        return view('admin.vet_single',['id'=>$id]);
    } )->name('vetSingle');

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

Route::get('/test',function(){
    $cs = Client::all();
    $cc =  array();
    // foreach($cs as $c){
    //     $ref =$c->phoneIsVerified;
    //     $arr = explode("-",$ref);
    //     // $arr = count($arr) > 1?explode(",",$arr[1]):null; 
    //     $cc[$c->id]['id'] = $c->id;
    //     $cc[$c->id]['select'] = $arr;

    //     $offerBasic = count($arr)>1?str_contains($arr[1],'standard'):null;
    //     $offerExtra = count($arr)>1?str_contains($arr[1],'extra'):null;
    //     // dd($cc,$offerBasic,$offerExtra);

    //     if($offerBasic){
    //         $b = new ClientInfo();
    //         $b->client_id = $c->id;
    //         $b->meta_name = 'selected_standard_option';
    //         $b->meta_type = 'boolean';
    //         $b->meta_value = true;
    //         $b->save();
    //     }
    //     if($offerExtra){
    //         $be = new ClientInfo();
    //         $be->client_id = $c->id;
    //         $be->meta_name = 'selected_extra_option';
    //         $be->meta_type = 'boolean';
    //         $be->meta_value = true;
    //         $be->save();
    //     }
    //     // dd($cc,$b,$be);
    // }
    // dd($cc);
    // foreach($cc as $c){
    //     $cl = Client::find($c['id']);
    //     // $cli = ClientInfo::where('client_id',$c['id'])->get()??new ClientInfo();
    //     $cli = new ClientInfo();
    //     $cli->client_id = $c['id'];


    //     // $cli->cilent_id = $c['id'];
    //     dd($cl,$cli);
    // }
    // $info = new ClientInfo();
    // $info->client_id = 49;
    // $info->meta_name = 'selected_standard_option';
    // $info->meta_type = 'boolean';
    // $info->meta_value = true;
    // $info->save();
    // dd($info);
});
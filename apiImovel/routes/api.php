<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImovelController;
use App\Models\Imovel;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    
Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function(){
    Route::name('imovel')->group(function(){

       Route::resource('imovel', 'ImovelController'); #index
     

    });

  

});


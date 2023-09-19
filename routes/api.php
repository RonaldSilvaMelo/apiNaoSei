<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\NaoSeiController;

Route::get('/', function(){
    return response()->json([
        'Success' => true
    ]);
});

Route::get('/naosei',[NaoSeiController::class,'index']);
Route::get('/naosei/{id}',[NaoSeiController::class,'show']);
Route::post('/naosei',[NaoSeiController::class,'store']);
Route::delete('/naosei/{id}',[NaoSeiController::class,'destroy']);
Route::put('/naosei/{id}',[NaoSeiController::class,'update']);
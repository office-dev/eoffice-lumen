<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

Route::get('/', function(){
   return new JsonResponse(["message" => "hello world"]);
});

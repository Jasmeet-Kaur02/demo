<?php

use App\Http\Controllers\DemoFieldController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post("demo-fields", [DemoFieldController::class, "create"])
->middleware("measure.execution.time");

Route::get("export-demo-fields", [DemoFieldController::class, 'get']);

Route::get("names", function () {
  $response = Http::get("https://microsoftedge.github.io/Demos/json-dummy-data/64KB.json");

  $responseData = array_map(function ($item) {
   return $item['name'];
  }, $response->json());

  return response()->json([
    "data" => $responseData,
    "messages" => "Names has been fetched",
    "status" => true
  ], 200);
});

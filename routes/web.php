<?php

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
Route::get('/maps', function () {
    return view('maps');
});
Route::get('/navigation', function () {
    return view('navigation');
});
Route::get('/tesazezaeazezaet', function (\Illuminate\Http\Request $request) {
    $addresses = \App\Models\Map::all();
    foreach($addresses as $address) {

        $z = \App\Models\Quartier::where('nom', $address['properties']['quartier'])->first();
        $properties = $address->properties;
        $properties['quartier_id'] = $z['_id'];
        $address->properties = $properties;
        $address->save();
    }
    return response()->json($addresses);
});

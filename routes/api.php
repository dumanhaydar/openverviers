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


Route::get('/adresses', function (\Illuminate\Http\Request $request) {
    $recherche = $request->input('recherche', false);
    if($recherche) {
        $addresses = \App\Models\Adresse::where('nom', 'regexp', '/.*'.$recherche.'/i')->with(['section', 'servicesIntradelZone','quartier'])->get();
    } else {
        $addresses = \App\Models\Adresse::with(['section', 'servicesIntradelZone','quartier'])->get();
    }
    return response()->json($addresses);
});
Route::get('/sections', function (\Illuminate\Http\Request $request) {
    $recherche = $request->input('section', false);
    if($recherche) {
        $addresses = \App\Models\Section::where('nom', 'regexp', '/.*'.$recherche.'/i')->with(['adresses'])->get();
    } else {
        $addresses = \App\Models\Section::with(['adresses'])->get();
    }
    return response()->json($addresses);
});
Route::get('/quartiers', function (\Illuminate\Http\Request $request) {
    $recherche = $request->input('quartier', false);
    if($recherche) {
        $addresses = \App\Models\Quartier::where('nom', 'regexp', '/.*'.$recherche.'/i')->with(['adresses'])->get();
    } else {
        $addresses = \App\Models\Quartier::with(['adresses'])->get();
    }
});
Route::get('/services/intradel/zones', function (\Illuminate\Http\Request $request) {
    $recherche = $request->input('zone', false);
    if($recherche) {
        $addresses = \App\Models\Services\Intradel\Zone::where('zone', (int)$recherche)->with(['adresses'])->get();
    } else {
        $addresses = \App\Models\Services\Intradel\Zone::with(['adresses'])->get();
    }
    return response()->json($addresses);
});

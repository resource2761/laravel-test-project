<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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


// category controller
Route::get('/category/all',[CategoryController::class,'AllCat'])->name('all.category'); // route alias name

Route::post('/category/add',[CategoryController::class,'AddCat'])->name('store.category'); // route alias name

Route::get('/category/edit/{id}',[CategoryController::class,'Edit']); 
Route::post('/category/update/{id}',[CategoryController::class,'Update']); 



Route::get('/category/delete/{id}',[CategoryController::class,'TempDelete']); 

Route::get('/category/restore/{id}',[CategoryController::class,'TempDelete_Restore']); 

Route::get('/category/Confirm_Delete/{id}',[CategoryController::class,'Category_Confirm_Delete']); 

// for brand Route
Route::get('/brand/all',[BrandController::class,'AllBrand'])->name('all.brand'); // route alias name
Route::post('/brand/add',[BrandController::class,'AddBrand'])->name('store.brand'); // route alias name
Route::get('/brand/edit/{id}',[BrandController::class,'Edit']); 
Route::post('/brand/update/{id}',[BrandController::class,'Update']); 
Route::get('/brand/delete/{id}',[BrandController::class,'Brand_Confirm_Delete']); 


// for upload multiple images route
Route::get('/multi/image',[BrandController::class,'Multipic'])->name('multi.images'); // route alias name
Route::post('/multipleimage/add',[BrandController::class,'AddMultipleImage'])->name('store.multipleimage'); // route alias name


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    // for use Eloquoent Model
    //$users=User::all(); // load data from User model

    // for Use Query builder
    $users=DB::table('users')->get();
    
    // send data to 'dashboard' view using compact('users') object
    return view('dashboard',compact('users')); 
})->name('dashboard');

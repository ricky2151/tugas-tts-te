<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ViewController@goHome');
Route::get('/readArticle', 'ViewController@goViewArticle');
Route::get('/readCategory', 'ViewController@goViewCategory');
Route::get('/addArticle/', 'ViewController@goAddArticle');
Route::get('/editArticle/{id}', 'ViewController@goEditArticle');
Route::get('/addCategory/', 'ViewController@goAddCategory');
Route::get('/editCategory/{id}', 'ViewController@goEditCategory');




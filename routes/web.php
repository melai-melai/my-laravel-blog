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

Route::get('/', 'PageController@welcome');

Route::get('/about', 'PageController@about');

Route::get('/articles', 'ArticleController@index')
	->name('articles.index');

// POST-запрос (Обработка формы)
Route::post('/articles', 'ArticleController@store')
  ->name('articles.store');	

// Страница с формой для создания
Route::get('/articles/create', 'ArticleController@create')
  ->name('articles.create');

// Показ 1 статьи
Route::get('/articles/{id}', 'ArticleController@show')
  ->name('articles.show');

// Страница с формой редактирования
Route::get('/articles/{id}/edit', 'ArticleController@edit')
  ->name('articles.edit');

// Обработка формы редактирования
Route::patch('/articles/{id}', 'ArticleController@update')
  ->name('articles.update');

// Удаление статьи
Route::delete('/articles/{id}', 'ArticleController@destroy')
  ->name('articles.destroy');



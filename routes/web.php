<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 

Route::get('/', [DashboardController::class,'index']);
Route::get('/authors',[AuthorController::class,'index'])->name('authors.index');
Route::get('/register_author',[AuthorController::class,'register']);
Route::get('/books',[BookController::class,'index'])->name('books.index');
Route::get('/add_book',[BookController::class,'addBook']);
Route::get('/edit_book/{id}', [BookController::class, 'edit'])->name('edit_book');

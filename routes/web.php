<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/signup', [PageController::class, 'signup'])->middleware('guest');
Route::post('/signup', [LoginController::class, 'createaccount']);

Route::get('/home', [PageController::class, 'home'])->middleware('auth');
Route::get('/view-user/{username}', [PageController::class, 'profileuser'])->middleware('auth');
Route::get('/profile', [PageController::class, 'profile'])->middleware('auth');
Route::get('/edit-profile', [PageController::class, 'editprofile'])->middleware('auth');
Route::get('/createpost', [PageController::class, 'createpost'])->middleware('auth');
Route::get('/profile/{album_slug}', [PageController::class, 'viewpostalbum'])->middleware('auth');
Route::get('/editalbum/{album_slug}', [PageController::class, 'editalbum'])->middleware('auth');
Route::get('/search', [PageController::class, 'search'])->middleware('auth');
Route::get('/view-user/{username}/{album_slug}', [PageController::class, 'viewpostalbumuser'])->middleware('auth');
Route::get('/view-album-search/{slug}', [PageController::class, 'viewpostalbumsearch'])->middleware('auth');
Route::get('/like', [PageController::class, 'like'])->middleware('auth');

Route::post('/createalbum', [Controller::class, 'createAlbum']);
Route::post('/uploadpost', [Controller::class, 'uploadPost']);
Route::post('/adddraft', [Controller::class, 'addDraft']);
Route::put('/updatealbum', [Controller::class, 'updateAlbum']);
Route::delete('/deletedraft', [Controller::class, 'deleteDraft']);
Route::put('/updateprofile', [Controller::class, 'updateProfile']);
Route::put('/updatepassword', [Controller::class, 'updatePassword']);
Route::delete('/deletepost', [Controller::class, 'deletepost']);
Route::delete('/deletealbum', [Controller::class, 'deletealbum']);
Route::put('/editpost', [Controller::class, 'editPost']);
Route::post('/addcomment', [Controller::class, 'addComment']);
Route::delete('/deletecomment', [Controller::class, 'deleteComment']);
Route::post('/addcommentuser', [Controller::class, 'addCommentuser']);
Route::delete('/deletecommentuser', [Controller::class, 'deleteCommentuser']);
Route::delete('/deletecommentuserview', [Controller::class, 'deleteCommentuserview']);
Route::post('/addlike', [Controller::class, 'addLike']);
Route::post('/addlikeuser', [Controller::class, 'addLikeuser']);
Route::post('/unlike', [Controller::class, 'unLike']);
Route::post('/unlikeuser', [Controller::class, 'unLikeuser']);



// Route::get('/createslug', [Controller::class, 'createSlug']);
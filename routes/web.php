<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blogs/create/', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blogs/{id}/detail', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::patch('/blogs/{id}/update', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blogs/{id}/delete', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('/blogs/trash', [BlogController::class, 'trash'])->name('blog.trash');
    Route::get('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blog.restore');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/phones', action: [PhoneController::class, 'index'])->name('phones.index');

    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/phones', action: [PhoneController::class, 'index'])->name('phones.index');
        Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment.store');
        Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
        Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
    });


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticate'])->name('autenticate');
});





Route::get('/blogs', [BlogController::class, 'homepage'])->name('blogs.homepage');
Route::get('/blogs/{id}', [BlogController::class, 'detail'])->name('blogs.detail');

// Route::get('')


// Route::resource('/blog', PostController::class);


// Route::get('', function () {
    // return 'Isi Respon';
// });

// Route::get('/hello', function () {
//     return 'Hallo Dari Laravel 11';
// });

// Route::get('/blog', function () {
//     return view('blog');
// });

// Route::get('/blog', function () {
//     return view('blog', ['data' => 'blog 1', 'title' => 'Belajar Laravel 11']);
// });

// Route::get('/blog', function() {
//         $data = 'Blog 1';
//         $title = 'Belajar Laravel 11';
//         return view('blog', ['data' => $data, 'title' => $title]);
// });

// Route::get('/hitung', function () {
//     $a = 5;
//     $b = 50;
//     return 'hasil: ' . ($a+$b);
// });

// Route::view('/tentang', 'about');
// Route::view('/blog', 'blog',['data' => 'blog 1', 'title' => 'Belajar Laravel 11'] );
// Route::get('/product/{id}', function ($id) {
//     return 'Ini halaman produk :' . $id ;
// });

// Route::get('/user/{nama?}', function ($nama = 'Tamu') {
//     return "Halo selamat datang, $nama!";
// });

// Route::get('/profil', function () {
//     return "Ini halaman Profil";
// }) -> name('prf');

// Route::get('/ke-profile', function () {
//     return redirect()->route('prf');
// });

// Route::redirect('/beranda', '/hitung');
// Route::get('/blog', [BlogController::class, 'index']);

// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Dashboard Admin';
//     })->name('dashboard');
//     Route::get('profile', function () {
//         return 'Profile Admin';
//     })->name('profile');
// });

// Route::resource('/posts', PostController::class);

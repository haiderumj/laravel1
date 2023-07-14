<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\BrandController;
use App\Http\Middleware\CheckAge;
use App\Models\User;
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

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
////////////////
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    echo "This is the home page.";
});

Route::middleware([CheckAge::class])->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
});
// Route::get('/about', function () {
//     return view('about');
// });

Route::get('/contact-dhhdhfhdhfdhf', [ContactController::class, 'index'])->name('con');
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('category/edit/{id}', [CategoryController::class, 'Edit']);
Route::Post('category/update/{id}', [CategoryController::class, 'Update']);
Route::get('softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('pdelete/category/{id}', [CategoryController::class, 'Pdelete']);
///////Brand Route ////////



Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('brand/edit/{id}', [BrandController::class, 'Edit']);
Route::Post('brand/update/{id}', [BrandController::class, 'Update']);
Route::get('brand/delete/{id}', [BrandController::class, 'Delete']);



////////////multi iamge rout//////////


Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'Storeimg'])->name('store.image');



//////user Route//////
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('admin.index', compact('users'));
    })->name('dashboard');
});
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
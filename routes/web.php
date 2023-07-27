<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\BrandController;
use  App\Http\Controllers\Homecontroller;
use  App\Http\Controllers\AbvoutController;
use  App\Http\Controllers\ChangePass;


use App\Http\Middleware\CheckAge;
use App\Models\User;
use App\Models\Multipic;
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
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->get();
    $images = Multipic::all();
    return view('home', compact('brands','abouts', 'images'));
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

//////////Admin all route////////////////
Route::get('/home/slider', [Homecontroller::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [Homecontroller::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [Homecontroller::class, 'StoreSlider'])->name('store.slider');


/////////////////Home about////////////////////
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [Aboutcontroller::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'editAbout'])->name('about.edit');
Route::post('update/homeabout/{id}', [AboutController::class, 'UpdateAbout'])->name('about.update');
Route::get('about/delete/{id}', [AboutController::class, 'DeleteAbout'])->name('about.delete');


////////////portfolio page
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

/////////////Admin Contact Rout//////////
Route::get('/contactabab', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('/contact/edit/{id}', [ContactController::class, 'editContact'])->name('contact.edit');
Route::post('update/contact/{id}', [ContactController::class, 'UpdateContact'])->name('contact.update');
Route::get('contact/delete/{id}', [ContactController::class, 'DeleteContact'])->name('Contact.delete');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
////////////// Home contact page Rout////////
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('message/delete/{id}', [ContactController::class, 'DeleteMessage'])->name('Contact.delete');

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

/// change Password and user Profile Route
Route::get('/user/password',[ChangePass::class,'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

////////////User Profile////////////

Route::get('/user/profile', [ChangePass::class, 'updatePass'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProdukController;
use App\Http\Controllers\User\UserPortfolioController;
use App\Http\Controllers\User\UserNewsletterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

//Route::get('/', function () {
//   return view('welcome');
//})->name('welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home1');

Auth::routes(['verify' => true]);

Route::get('/produk/{p}', [ProdukController::class, 'detailproduk'])->name('detailproduk');

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function() {
    //produk
    Route::get('/produk', [ProdukController::class, 'produkview'])->name('daftarproduk');

    Route::get('/produk/tambahproduk', [ProdukController::class, 'tambahprodukview'])->name('tambahproduk');
    Route::post('/produk/tambahproduk', [ProdukController::class, 'tambahproduk'])->name('tambahpro');
    Route::get('/produk/editproduk/{p}', [ProdukController::class, 'editprodukview'])->name('editproduk');
    Route::put('/produk/updateproduk/{produkedit}', [ProdukController::class, 'updateproduk'])->name('updatepro');
    Route::delete('/produk/hapusproduk/{p}', [ProdukController::class, 'hapusproduk'])->name('hapusproduk');

    //category

    Route::get('/category', [CategoryController::class, 'categoryview'])->name('daftarcategory');
    Route::get('/category/tambahcategory', [CategoryController::class, 'tambahcategoryview'])->name('tambahcategory');
    Route::post('/category/tambahcategory', [CategoryController::class, 'tambahcategory'])->name('tambahctg');
    Route::get('/category/editcategory/{c}', [CategoryController::class, 'editcategoryview'])->name('editcategory');
    Route::put('/category/updatecategory/{categoryedit}', [CategoryController::class, 'updatecategory'])->name('updatectg');
    Route::delete('/category/hapuscategory/{c}', [CategoryController::class, 'hapuscategory'])->name('hapuscategory');

    //brand

    Route::get('/brand', [BrandController::class, 'brandview'])->name('daftarbrand');
    Route::get('/brand/tambahbrand', [BrandController::class, 'tambahbrandview'])->name('tambahbrand');
    Route::post('/brand/tambahbrand', [BrandController::class, 'tambahbrand'])->name('tambahbrd');
    Route::get('/brand/editbrand/{b}', [BrandController::class, 'editbrandview'])->name('editbrand');
    Route::put('/brand/updatebrand/{brandedit}', [BrandController::class, 'updatebrand'])->name('updatebrd');
    Route::delete('/brand/hapusbrand/{b}', [BrandController::class, 'hapusbrand'])->name('hapusbrand');

    //order

    Route::get('/order', [OrderController::class, 'orderview'])->name('daftarorder');
    Route::get('/order/tambahorder', [OrderController::class, 'tambahorderview'])->name('tambahorder');
    Route::post('/order/tambahorder', [OrderController::class, 'tambahorder'])->name('tambahord');
    Route::put('/order/updateorder', [OrderController::class, 'editorder'])->name('updateord');
    Route::delete('/order/hapusorder/{o}', [OrderController::class, 'hapusorder'])->name('hapusorder');

    //news
    Route::get('/news',[NewsletterController::class,'index'])->name('berita');
    Route::get('/news/tambahberita',[NewsletterController::class,'create'])->name('tambahberita');
    Route::post('/news/tambahberita',[NewsletterController::class,'store'])->name('addberita');
    Route::get('/news/editberita/{news2}',[NewsletterController::class,'edit'])->name('editberita');
    Route::put('/news/editberita/{news2}',[NewsletterController::class,'update'])->name('updateberita');
    Route::delete('/news/hapusberita/{news2}',[NewsletterController::class,'destroy'])->name('hapusberita');

    //transaction
    Route::get('/transaction', [TransactionController::class, 'transactionview'])->name('kirimtransaksi');
    Route::get('/transaction/tambahtransaction', [TransactionController::class, 'tambahtransactionview'])->name('tambahtransaction');
    Route::post('/transaction/tambahtransaction', [TransactionController::class, 'tambahtransaction'])->name('tambahtss');
    Route::get('/transaction/edittransaction/{t}', [TransactionController::class, 'edittransactionview'])->name('edittransaction');
    Route::put('/transaction/updatetransaction/{transactionedit}', [TransactionController::class, 'updatetransaction'])->name('updatetss');
    Route::delete('/transaction/hapustransaction/{t}', [TransactionController::class, 'hapustransaction'])->name('hapustransaction');


    //portfolio
    Route::get('/portofolio',[PortfolioController::class,'index'])->name('portofolio');
    Route::get('/portofolio/tambahportofolio',[PortfolioController::class,'create'])->name('tambahport');
    Route::post('/portofolio/tambahportofolio',[PortfolioController::class,'store'])->name('addport');
    Route::get('/portofolio/editportofolio/{port}',[PortfolioController::class,'edit'])->name('editport');
    Route::put('/portofolio/editportofolio/{port}',[PortfolioController::class,'update'])->name('updateport');
    Route::delete('/portofolio/hapusportofolio/{port}',[PortfolioController::class,'destroy'])->name('hapusport');
    Route::get('/portofolio/{title}/{port}',[PortfolioController::class,'show'])->name('showport');
});

Route::get('/produk', [UserProdukController::class, 'produkview'])->name('produk');
Route::get('/portofolio',[UserPortfolioController::class,'index'])->name('portofolio');
Route::get('/portofolio/{title}/{port}',[UserPortfolioController::class,'show'])->name('showport');
Route::get('/news',[UserNewsletterController::class,'index'])->name('berita');
Route::get('/news/{title}/{news2}',[UserNewsletterController::class,'show'])->name('showberita');
Route::get('/order/vieworder', [UserOrderController::class, 'listorderview'])->middleware('verified')->name('vieworder');
Route::get('/order/tambahorder', [UserOrderController::class, 'tambahorderview'])->middleware('verified')->name('tambahorder');
Route::post('/order/tambahorder', [UserOrderController::class, 'tambahorder'])->middleware('verified')->name('tambahord');
Route::delete('/order/hapusorder/{o}', [OrderController::class, 'hapusorder'])->name('hapusorder');
Route::get('/transaction/viewtransaction',[TransactionController::class, 'listtransactionview'])->middleware('verified')->name('viewtransaction');
Route::get('/contact', function () {
    return view('contact', ['activeContact' => 'active']);
 })->name('contact');

 Route::get('/deleteuser', [UserController::class, 'deleteuserview'])->name('deleteuser');
 Route::post('/deleteuser/delete', [UserController::class, 'deleteuser'])->name('hapususer');

// Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->middleware('auth')->name('welcome');





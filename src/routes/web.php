<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ManagerController;

//アドミン用
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/send-email', [AdminController::class, 'showSendEmailForm'])->name('admin.sendEmailForm');
    Route::post('/admin/send-email', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');

     Route::get('/admin/create-manager', [AdminController::class, 'createManager'])->name('admin.createManager');
     Route::post('/admin/store-manager', [AdminController::class, 'storeManager'])->name('admin.storeManager');
});

// 店舗代表者用
Route::middleware(['auth', 'shop_manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/view-reservations', [ManagerController::class, 'viewReservations'])->name('manager.viewReservations');
    Route::get('/manager/create-shop', [ShopController::class, 'create'])->name('manager.createShop');
    Route::post('/manager/store-shop', [ShopController::class, 'store'])->name('manager.storeShop');

    //店舗編集
    Route::get('/manager/edit-shop', [ManagerController::class, 'editShop'])->name('manager.editShop');
    Route::put('/manager/update-shop/{id}', [ManagerController::class, 'updateShop'])->name('manager.updateShop');

});



Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])
    //->middleware(['signed'])
    ->name('verification.verify');

Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
Route::delete('/favorites/{shop}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');


// ホームページ（お店の一覧ページ）のルート
//Route::get('/', [ShopController::class, 'index'])->name('home');

//Auth::routes(['verify' => true]);

Route::get('/', [ShopController::class, 'index'])->name('shops.index');

// お店の詳細ページのルート
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');

// 来店店舗一覧ページのルート
Route::get('/visited-shops', [MyPageController::class, 'visitedShops'])->name('visited.shops');

//会員登録
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::view('/login', 'auth.login')->name('login');



Route::view('/register', 'auth.register')->name('register');

Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

// 予約の編集ページを表示
Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

// 予約内容を更新
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');

// 支払いページのルート
Route::get('/payment/{reservation}', [App\Http\Controllers\PaymentController::class, 'showPaymentPage'])->name('payment');

Route::get('/payment/success/{reservation}', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel/{reservation}', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');

Route::get('/reservation-complete', function () {
    return view('complete');
})->name('complete');

Route::post('/logout', function () {
    Auth::logout();  // ログアウト処理
    return redirect('/');  // ログアウト後にリダイレクトする先（例: ホームページ）
})->name('logout');



Route::get('/mypage', [MyPageController::class, 'index'])->middleware('auth')->name('mypage');

// ログイン時のメニューページ
Route::get('/menu', function () {

    if (Auth::check()) {
        // ログイン状態のデバッグ
        //return response()->json(['message' => 'User is logged in', 'user' => Auth::user()]);
    } else {
        // ログインしていない場合のメッセージ（デバッグ用）
        // return response()->json(['message' => 'User is NOT logged in']);
    }

    return view('menu');
})->middleware('auth');

// 非ログイン時のメニューページ
Route::get('/menu-guest', function () {

    if (Auth::check()) {
        // ログイン状態のデバッグ
        //return response()->json(['message' => 'User is logged in', 'user' => Auth::user()]);
    } else {
        // ログインしていない場合のメッセージ（デバッグ用）
        //return response()->json(['message' => 'User is NOT logged in']);
    }

    return view('menu-guest');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

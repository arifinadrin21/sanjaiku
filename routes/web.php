<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResiController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;

use App\Http\Controllers\KasirController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\MidtransController;

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware('auth')->group(function () {

    Route::get('/payment/midtrans/{order}', [MidtransController::class, 'pay'])
        ->name('payment.midtrans');

    Route::get('/payment/midtrans/{order}/finish', [MidtransController::class, 'finish'])
        ->name('payment.midtrans.finish');

});

Route::post('/midtrans/notification', [MidtransController::class, 'notification'])
    ->name('midtrans.notification');

/*
|--------------------------------------------------------------------------
| Profil
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class,'update'])
        ->name('profile.update');

});

/*
|--------------------------------------------------------------------------
| Keranjang (Orders untuk user)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

});


/*
|--------------------------------------------------------------------------
| Testimoni User
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/orders/{order}/testimonial', [TestimonialController::class, 'create'])
        ->name('testimonials.create');

    Route::post('/orders/{order}/testimonial', [TestimonialController::class, 'store'])
        ->name('testimonials.store');

});


/*
|--------------------------------------------------------------------------
| Checkout & Payment (QRIS)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Halaman upload bukti QRIS
    Route::get('/payment/qris/{order}', [CheckoutController::class, 'qris'])
        ->name('payment.qris');

    // Proses upload bukti QRIS
    Route::post('/payment/qris/{order}', [CheckoutController::class, 'uploadProof'])
        ->name('payment.upload-proof');   // ← nama route sudah pakai tanda hubung

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    
        
});

/*
|--------------------------------------------------------------------------
| Landing Page (Publik)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/produk', [LandingController::class, 'products'])->name('products');

Route::get('/tentang', [LandingController::class, 'about'])->name('about');

Route::get('/kontak', [LandingController::class, 'contact'])->name('contact');

Route::get('/produk/{slug}', [LandingController::class, 'detail'])
    ->name('products.detail');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');

    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

});

// Login / Register (tanpa auth)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Laporan
        Route::get('/reports/excel', [ReportController::class, 'excel'])
            ->name('reports.excel');

        Route::get('/reports/pdf', [ReportController::class, 'pdf'])
            ->name('reports.pdf');

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Kategori
        Route::resource('categories', CategoryController::class);

        // Produk
        Route::resource('products', ProductController::class);

        // Varian Produk (resource)
        Route::resource('product-variants', ProductVariantController::class);

        // Toggle status varian (PATCH) -> nama route: admin.product-variants.toggle-status
        Route::patch('/product-variants/{productVariant}/toggle-status', [ProductVariantController::class, 'toggleStatus'])
            ->name('product-variants.toggle-status');

        // Voucher
        Route::resource('vouchers', VoucherController::class);

        // Verifikasi pembayaran QRIS
        Route::put('/orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])
            ->name('orders.verify-payment');

        // Pesanan (index, show, update)
        Route::resource('orders', AdminOrderController::class)
            ->only(['index', 'show', 'update']);

        // Resi
        Route::get('/resi', [ResiController::class, 'index'])->name('resi.index');
        Route::get('/resi/create', [ResiController::class, 'create'])->name('resi.create');
        Route::post('/resi/create', [ResiController::class, 'store'])->name('resi.store');
        Route::get('/resi/edit/{id}', [ResiController::class, 'edit'])->name('resi.edit');
        Route::put('/resi/edit/{id}', [ResiController::class, 'update'])->name('resi.update');
        Route::delete('/resi/delete/{id}', [ResiController::class, 'destroy'])->name('resi.delete');
        Route::get('/resi/qr/{id}', [ResiController::class, 'showQr'])->name('resi.qr');

        // Testimoni Admin
Route::get('/testimonials', [AdminTestimonialController::class, 'index'])
    ->name('testimonials.index');

Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])
    ->name('testimonials.destroy');

    });
   /*
|--------------------------------------------------------------------------
| Kasir
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir/dashboard',
        [KasirController::class, 'dashboard'])
        ->name('kasir.dashboard');

    Route::post('/kasir/transaksi',
        [KasirController::class, 'store'])
        ->name('kasir.transaksi.store');

    Route::get('/kasir/riwayat',
        [KasirController::class, 'history'])
        ->name('kasir.history');

    Route::get('/kasir/riwayat/{order}',
        [KasirController::class, 'detail'])
        ->name('kasir.history.detail');
});
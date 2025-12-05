<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OrderController;


Auth::routes();


Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Website Routes 
Route::get('/', [WebsiteController::class, 'home'])->name('website.home');
Route::get('/products/filter', [WebsiteController::class, 'getProducts'])->name('products.filter'); // ← جديد
Route::get('/shop', [WebsiteController::class, 'products'])->name('products.products');
Route::get('/shop/categories', [WebsiteController::class, 'categoriesPage'])->name('website.categories');
Route::get('/shop/product/{id}', [WebsiteController::class, 'productDetails'])->name('products.productDetails');
Route::get('/shop/category/{id}', [WebsiteController::class, 'productsByCategory'])->name('website.productsByCategory');
Route::get('/search', [WebsiteController::class, 'search'])->name('website.search');

Route::get('/cart', [CartController::class, 'index'])->name('shopcart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update'); // تحديث كمية
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.contact.store');

Route::middleware(['auth:admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Categories Routes
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::delete('/category/image/{id}', [CategoryController::class, 'deleteImage'])->name('category.image.delete');
    Route::resource('categories', CategoryController::class);

    // Products Routes
    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/force-delete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::delete('/product/image/{id}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::resource('products', ProductController::class)->except(['show']);


    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


    // Users Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('contacts', ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::resource('admin/sliders', SliderController::class);
        Route::resource('admin/offers', OfferController::class);
        Route::resource('admin/services', ServiceController::class);
        Route::resource('admin/banners', BannerController::class);

        // Orders Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
});
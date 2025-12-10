<?php

use App\Http\Controllers\app\AddressController;
use App\Http\Controllers\app\CheckoutController;
use App\Http\Controllers\app\PaymentController;
use App\Http\Controllers\Panel\ActivityLogController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\App\CartController;
use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\OfferController;
use App\Http\Controllers\App\WishlistController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Panel\AboutusController;
use App\Http\Controllers\Panel\AttributeController;
use App\Http\Controllers\Panel\AttributeValueController;
use App\Http\Controllers\Panel\BannerController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ContactusController;
use App\Http\Controllers\Panel\CouponController;
use App\Http\Controllers\Panel\DiscountController;
use App\Http\Controllers\Panel\OrderController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\reviewController;
use App\Http\Controllers\Panel\ServiceController;
use App\Http\Controllers\panel\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\BlogController as AppBlogController;
use App\Http\Controllers\Panel\BlogController as PanelBlogController;


// -------------------------
// بخش سایت (App)
// -------------------------
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/get-products', [homeController::class, 'getProducts'])->name('get.products');

//category
Route::get('/category/{slug}', [homeController::class, 'show'])->name('app.category.show');
Route::get('/singelCategory/{slug}', [homeController::class, 'show'])->name('home.show');


//products
Route::get('/offer', [OfferController::class, 'index'])->name('offer.index');
Route::get('/offer/{slug}', [OfferController::class, 'show'])->name('offer.show');

Route::get('/aboutus', [AboutusController::class, 'index'])->name('about.index');
Route::get('/contactus', [ContactusController::class, 'create'])->name('contactus.create');
Route::post('/products/{product}/comments', [reviewController::class, 'store'])
    ->middleware('auth')
    ->name('products.comments.store');

//blogs
Route::resource('blogs', AppBlogController::class)->names('app.blogs');
Route::get('/blog/{slug}', [AppBlogController::class, 'show'])->name('blogs.singleBlog');

//contact us (app)
Route::get('create-contact',[ContactusController::class,'create'])->name('create-contact');
Route::post('create-contact', [ContactusController::class,'store'])->name('submit-contact');


// wishlists
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'destroy'])->name('wishlist.remove');
    // نمایش صفحه تسویه‌حساب
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// ثبت سفارش
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/payment/zarinpal/start', [PaymentController::class, 'start'])->name('payment.zarinpal.start');
    Route::get('/payment/zarinpal/callback', [PaymentController::class, 'callback'])->name('payment.zarinpal.callback');
    Route::post('/address/store', [AddressController::class, 'store'])
        ->name('address.store');
    Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');

});
// Wishlist toggle
Route::middleware('auth')->post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

//سبد خرید
Route::get('/carts',[CartController::class,'index'])->name('cart.index');
Route::post('/carts/add',[CartController::class,'addToCart'])->name('cart.add');
Route::put('cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
Route::put('cart/update-attributes/{itemId}', [CartController::class, 'updateAttributes'])->name('cart.updateAttributes');
Route::delete('/carts/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/carts/CouponCode', [CartController::class, 'verifyCouponCode'])->name('cart.verifyCouponCode');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');




// پروفایل کاربر
Route::get('/user_profile',[\App\Http\Controllers\ProfileUserController::class,'edit'])->name('user.profile');
Route::put('/user_profile/{id}',[\App\Http\Controllers\ProfileUserController::class,'update'])->name('user.profile.update');
Route::delete('/profile', [\App\Http\Controllers\ProfileUserController::class, 'destroy'])->name('user.profile.destroy');


// لاگین و رجیستر کاربر
Route::middleware('guest')->group(function () {
    // نمایش فرم ثبت‌نام
    Route::get('/user/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
    // پردازش ثبت‌نام
    Route::post('/user/register', [UserAuthController::class, 'register'])->name('user.register.store');

    // نمایش فرم لاگین
    Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    // پردازش لاگین
    Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.store');
});
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// -------------------------
// داشبورد ادمین
// -------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/404', function () {
    return view('errors.404');
})->name('404');


Route::get('/discounted-products', [DiscountController::class, 'showDiscountedProducts'])
    ->name('discountedproduct.index');



// فرم ورود ادمین (بدون Middleware)

Route::get('admin_login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin_login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
// -------------------------
// پنل ادمین
// -------------------------
Route::middleware(['auth',AdminMiddleware::class])->prefix('admin')->group(function () {

    Route::get('logs', [ActivityLogController::class, 'index'])->name('logs.index');
    Route::resource('category', CategoryController::class);
    Route::patch('category/{category}/status',[CategoryController::class,'changeStatus'])->name('category.changeStatus');
    Route::resource('product', ProductController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('attribute_values', AttributeValueController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('service', ServiceController::class);
    Route::patch('service/{service}/toggle', [ServiceController::class, 'toggle'])->name('service.toggle');

    Route::resource('discount', DiscountController::class);
    Route::get('/discount/search-products', [DiscountController::class, 'searchProducts'])
        ->name('discount.search-products');
    Route::patch('discount/{discount}/status',[DiscountController::class,'changeStatus'])->name('discount.changeStatus');

    //about us
    Route::get('about', [AboutusController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutusController::class, 'update'])->name('about.update');

    // contact us
    Route::resource('contactus', ContactusController::class)->only(['index','show']);
    Route::post('contactus/{id}/toggle-status', [ContactusController::class, 'toggleStatus'])
        ->name('contactus.toggleStatus');

    // setting
    Route::get('setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('setting', [SettingController::class, 'update'])->name('setting.update');


    //reviews
    Route::resource('reviews', reviewController::class)->except(['create','store','edit','update']);
    Route::post('reviews/{id}/toggle-status', [reviewController::class, 'toggleStatus'])->name('reviews.toggleStatus');

    //blogs
    Route::resource('blogs', PanelBlogController::class);
    Route::get('/add-blog', [PanelBlogController::class, 'create'])->name('admin.blogs.add');


    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/user/{user}', [ProfileController::class, 'deleteUser'])->name('profile.delete-user');

    Route::post('admin_logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

    Route::resource('coupon',CouponController::class);
    Route::patch('coupon/{coupon}/toggle', [CouponController::class, 'toggle'])->name('coupon.toggle');
    Route::resource('editImage',\App\Http\Controllers\Panel\ImageController::class);


    Route::resource('orders', OrderController::class)
        ->only(['index', 'show']);


});


require __DIR__.'/auth.php';

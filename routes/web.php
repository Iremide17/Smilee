<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\TagController;
use App\Http\Controllers\Pages\PostController;
use App\Http\Controllers\Pages\AgentController;
use App\Http\Controllers\Pages\HouseController;
use App\Http\Controllers\Pages\OrderController;
use App\Http\Controllers\Pages\ReplyController;
use App\Http\Controllers\Pages\AuthorController;
use App\Http\Controllers\Pages\FollowController;
use App\Http\Controllers\Pages\ThreadController;
use App\Http\Controllers\Pages\VendorController;
use App\Http\Controllers\Pages\BillingController;
use App\Http\Controllers\Pages\CommentController;
use App\Http\Controllers\Pages\PaymentController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ProfileController;
use App\Http\Controllers\Pages\PropertyController;
use App\Http\Controllers\Pages\FurnitureController;
use App\Http\Controllers\Externals\GoogleController;
use App\Http\Controllers\Pages\MembershipController;
use App\Http\Controllers\Externals\FacebookController;
use App\Http\Controllers\Pages\NotificationController;
use App\Http\Controllers\Pages\SubscriptionController;

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

require 'admin.php';
require 'writer.php';
require 'vendor.php';
require 'agent.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/terms', function () {
    return view('terms');
})->name('terms.show');

Route::middleware(['default', 'auth', ])->get('/preference', function () {
    return view('preference');
})->name('preference.show');

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/membership', [MembershipController::class, 'index'])->name('membership');

Route::group(['prefix' => 'smilee', 'as' => 'smilee.'], function () {

    /* Name: Notifications
     * Url: /dashboard/notifications*
     * Route: dashboard.notifications*
     */

    Route::group(['prefix' => 'notifications', 'as' => 'notifications.'], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'vendors', 'as' => 'vendors.'], function () {
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/show/{vendor}', [VendorController::class, 'show'])->name('show');
        Route::post('/', [VendorController::class, 'store'])->name('store');
        Route::put('/{vendor}', [VendorController::class, 'update'])->name('update');
        Route::get('/{vendor}/subscribe', [VendorController::class, 'subscribe'])->name('subscribe');
        Route::get('/{vendor}/unsubscribe', [VendorController::class, 'unsubscribe'])->name('unsubscribe');

    });

     /* Name: Agents
     * Url: /agent/agents
     * Route: agent.agents.*
     */
    Route::group(['prefix' => 'agent', 'as' => 'agent.'], function () {
        Route::get('/', [AgentController::class, 'index'])->name('index');
        Route::get('/create', [AgentController::class, 'create'])->name('create');
        Route::post('/', [AgentController::class, 'store'])->name('store');
        Route::get('show/{agent}', [AgentController::class, 'show'])->name('show');
        Route::get('/edit/{agent}', [AgentController::class, 'edit'])->name('edit');
        Route::get('{agent}', [AgentController::class, 'property'])->name('property');
        Route::get('{property}/{agent}', [AgentController::class, 'prop'])->name('property.show');
    });

        /* Name: Authors
    * Url: /authors/*
    * Route: authors.*
    */
    Route::group(['prefix' => 'authors', 'as' => 'authors.'], function () {
        Route::get('/', [AuthorController::class, 'index'])->name('index');
        Route::post('/', [AuthorController::class, 'store'])->name('store');
        Route::get('/{user}', [AuthorController::class, 'show'])->name('show');
    });

    /* Name: Product
     * Url: /dashboard/products
     * Route: dashboard.products.*
     */
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/{category}/{product}', [ProductController::class, 'category'])->name('category');
    });

      /* Name: Posts
     * Url: /dashboard/posts
     * Route: dashboard.posts.*
     */
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/show/{post}', [PostController::class, 'show'])->name('show');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('delete');
    });

      /* Name: Houses
     * Url: /dashboard/houses
     * Route: dashboard.houses.*
     */
    Route::group(['prefix' => 'houses', 'as' => 'houses.'], function () {
        Route::get('/', [HouseController::class, 'index'])->name('index');
        Route::post('/', [HouseController::class, 'store'])->name('store');
    });

    /* Name: Order
     * Url: /dashboard/orders
     * Route: dashboard.orders.*
     */

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('home/{vendor}', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'store'])->name('store');
        Route::get('show/{user}', [OrderController::class, 'show'])->name('show');
    });

     /* Name: Properties
     * Url: /agent/properties
     * Route: agent.properties.*
     */
    Route::group(['prefix' => 'properties', 'as' => 'properties.'], function () {
        Route::get('/', [PropertyController::class, 'index'])->name('index');
        Route::get('show/{property}', [PropertyController::class, 'show'])->name('show');
    });

       /* Name: furniture
     * Url: /agent/furniture
     * Route: agent.furniture.*
     */
    Route::group(['prefix' => 'furnitures', 'as' => 'furnitures.'], function () {
        Route::get('/', [FurnitureController::class, 'index'])->name('index');
        Route::get('/{vendor}/edit', [FurnitureController::class, 'edit'])->name('edit');
        Route::get('show/{furniture}', [FurnitureController::class, 'show'])->name('show');
        Route::get('/{vendor}/{furniture}', [FurnitureController::class, 'furniture'])->name('furniture');
    });


    Route::group(['prefix' => 'threads', 'as' => 'threads.'], function () {
        /* Name: Threads
         * Url: /threads/*
         * Route: threads.*
         */
        Route::get('/', [ThreadController::class, 'index'])->name('index');
        Route::get('create', [ThreadController::class, 'create'])->name('create');
        Route::post('/', [ThreadController::class, 'store'])->name('store');
        Route::get('/{thread:slug}/edit', [ThreadController::class, 'edit'])->name('edit');
        Route::post('/{thread:slug}', [ThreadController::class, 'update'])->name('update');
        Route::get('/{category:slug}/{thread:slug}', [ThreadController::class, 'show'])->name('show');

        Route::get('/{category:slug}/{thread:slug}/subscribe', [ThreadController::class, 'subscribe'])->name('subscribe');
        Route::get('/{category:slug}/{thread:slug}/unsubscribe', [ThreadController::class, 'unsubscribe'])->name('unsubscribe');

        Route::group(['as' => 'tags.'], function () {
            Route::get('/{tag:slug}', [TagController::class, 'index'])->name('index');
        });
    });

    /* Name: Tags
    * Url: /tags/*
    * Route: tags.*
    */
    Route::group(['prefix' => 'tags', 'as' => 'tags.'], function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/{tag}', [TagController::class, 'show'])->name('show');
    });

    Route::get('/furnish', [ProfileController::class, 'furnish'])->name('furnish');
    Route::get('cart', [ProfileController::class, 'cart'])->name('cart');

});

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FacebookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


// Google URL
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});

Route::group(['prefix' => 'replies', 'as' => 'replies.'], function () {
    /* Name: Replies
     * Url: /replies/*
     * Route: replies.*
     */
    Route::post('/', [ReplyController::class, 'store'])->name('store');
    Route::get('reply/{id}/{type}', [ReplyController::class, 'redirect'])->name('replyAble');
});

Route::group(['prefix' => 'payments', 'as' => 'payments.'], function () {
    /* Name: Payments
     * Url: /payments/*
     * Route: payments.*
     */

    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/show/{payment}', [PaymentController::class, 'show'])->name('show');
});


/* Name: comments
 * Url: /comments/*
 * Route: comments.*
*/
Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
    Route::post('/', [CommentController::class, 'store'])->name('store');
});

/* Name: subscriptions
 * Url: /subscriptions/*
 * Route: subscriptions.*
*/
Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function () {
    Route::get('/resume/{subscription}', [SubscriptionController::class, 'update'])->name('update');
    Route::get('/cancel/{subscription}', [SubscriptionController::class, 'destroy'])->name('destroy');

    Route::get('billing/plans', [SubscriptionController::class, 'showBillingPlans'])->name('billing.plans');
    Route::get('billing/cancel', [SubscriptionController::class, 'cancel'])->name('billing.cancel');
    Route::get('billing/restart', [SubscriptionController::class, 'restart'])->name('billing.restart');
    Route::get('billing/process', [SubscriptionController::class, 'handlePaystackCallback'])->name('billing.process');
    Route::post('billing/process', [SubscriptionController::class, 'handlePaystackPostCallBack'])->name('billing.process.post');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/billing/invoices', [BillingController::class, 'index'])->name('billing');
    Route::get('/billing/invoices/{invoice}', [BillingController::class, 'download'])->name('download');
});

// Profile
Route::get('profile/user/{user}', [ProfileController::class, 'show'])->name('profile');
Route::get('checkout/{user}', [ProfileController::class, 'checkout'])->name('checkout');
Route::get('show/{user}/bookings', [ProfileController::class, 'booking'])->name('booking');
// Route::get('verify-payment/{reference}/{data}', [PaymentController::class, 'verify']);

Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);

// Follows
Route::post('follow/profile/{user}', [FollowController::class, 'store'])->name('follow');

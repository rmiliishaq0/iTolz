<?php

use App\Http\Controllers\mainController;
use App\Mail\OrderShipped;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalHandeler;




Route::get('/',[mainController::class, 'home'])->name("home");

Route::get("/logout",[mainController::class,"logout"])->name("logout");




Route::middleware(['auth:sanctum', \App\Http\Middleware\RateLimitPerIP::class,config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        seo()->title("My Tools Dashboard | Itolz")->description("Access all your subscribed tools, manage your active plans, and explore our free tool offerings all in one place.");
        return view('dashboard',['is_active_chat'=>true]);
    })->name('dashboard');

    Route::get("/download",[mainController::class,"download"]);

    Route::get("/access/{id}",[mainController::class,"access"])->whereNumber('id');

    Route::get("/contact",[mainController::class,"contact"]);

    Route::post("/contact_post",[mainController::class,"contact_post"])->name("contact_post");

    Route::get('Pro_Access/{id}',[mainController::class,"pro_access"])->whereNumber('id')->middleware(\App\Http\Middleware\Ensurehaspro::class);

    Route::post('/api/paypal/create', [PaypalHandeler::class, 'apiCreate'])->name('paypal.api.create');

    Route::post('/api/paypal/capture', [PaypalHandeler::class, 'apiCapture'])->name('paypal.api.capture');

    Route::get('/orders',[mainController::class,'orders']);

    Route::get('/active_plans',[mainController::class,'active_plans']);

    Route::post("/send",[mainController::class,'send']);

    Route::post("/update_read",[mainController::class,'update_read']);

    Route::get("/pack/create",[mainController::class,"pack_create"])->name("pack.custom");

    Route::post("/CustomPrices",[mainController::class,"CustomPrices"]);

    Route::get("/orders/delete",[mainController::class,"delete_orders"])->name("delete.orders");

});
Route::get("/terms_and_conditions",[mainController::class,"terms"])->name("tools.all")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::get("/about",[mainController::class,"about"])->name("tools.all")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::get("/privacy_policy" ,[mainController::class,"privacy"])->name("tools.all")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',\App\Http\Middleware\AdminCheck::class, \App\Http\Middleware\RateLimitPerIP::class])->group(function () {
    Route::get('/admin', [mainController::class,"admin_home"])->name('admin');

    Route::get("/admin/users",[mainController::class,"admin_users"])->name("admin_users");

    Route::get("/admin/user/edit/{id}",[mainController::class,"admin_user"])->name("admin_user");

    Route::post("/admin/user/edit/{id}",[mainController::class,"admin_user_post"])->name("admin_user_post");

    Route::get("/admin/user/delete/{id}",[mainController::class,"admin_user_delete"])->name("admin_user_delete");

    Route::get("/admin/products",[mainController::class,"admin_products"])->name("admin_products");

    Route::get("/admin/product/create",[mainController::class,"product_create"])->name("product_create");

    Route::post("/admin/product/create",[mainController::class,"product_create_post"])->name("product_create_post");

    Route::get("/admin/product/edit/{id}",action: [mainController::class,"admin_product"])->name("admin_product");

    Route::post("/admin/product/edit/{id}",[mainController::class,"admin_product_post"])->name("admin_product_post");

    Route::get("/admin/product/delete/{id}",[mainController::class,"admin_product_delete"])->name("admin_product_delete");

    Route::get('/admin/messages',[mainController::class,'admin_messages']);

    Route::get('/admin/messages/{id}',[mainController::class,'admin_single_message']);

    Route::get("/admin/orders",[mainController::class,'admin_orders']);

    Route::get("admin/order/edit/{id}",[mainController::class,'admin_order_edit'])->name('admin.order.edit');

    Route::post('/admin/order/edit/{id}/submit',[mainController::class,'admin_order_edit_post'])->name('admin.order.edit.post');

    Route::get('admin/order/delete/{id}',[mainController::class,'admin_order_delete'])->name('admin.order.delete');

    Route::get("/admin/order/creat",[mainController::class , 'admin_order_creat'])->name("admin.order.create");

    Route::post("admin/order/submit",[mainController::class,'admin_order_submit'])->name("admin.order.submit");

    Route::get("admin/plan/create",[mainController::class,'admin_plan_create'])->name("admin.plan.create");

    Route::post("/admin/plan/submit",[mainController::class,'admin_plan_submit'])->name("admin.plan.submit");

    Route::get('/admin/plan',[mainController::class,'admin_plan'])->name('admin.plan');

    Route::get("/admin/plan/edit/{id}",[mainController::class,"admin_plan_edit"])->name("admin.plan.edit");

    Route::post("/admin/plan/{id}/submit",[mainController::class,'admin_plan_edit_submit'])->name('admin.plan.edit.submit');

    Route::get("/admin/plan/{id}/delete",[mainController::class,'admin_plan_delete'])->name('admin.plan.delete');
});

Route::middleware(['auth:sanctum',\App\Http\Middleware\RateLimitPerIP::class, config('jetstream.auth_session'),'password.confirm'])->group(function () {
    Route::get('/settings', [mainController::class,"settings_get"])->name('settings');

    Route::post('/settings', [mainController::class,"settings_post"]);
});


Route::get("/tool/{id}",[mainController::class,"Gettool"])->whereNumber('id')->middleware([\App\Http\Middleware\VerifyExtensionToken::class,\App\Http\Middleware\RateLimitPerIP::class]);

Route::post('/reg-ext',[mainController::class,"register"])->whereNumber('id')->middleware(\App\Http\Middleware\RateLimitPerIP::class);

Route::get("/pro/{id}",[mainController::class,"Gettool_Pro"])->whereNumber('id')->middleware([\App\Http\Middleware\VerifyExtentionPro::class,\App\Http\Middleware\RateLimitPerIP::class]);

Route::get("/p",[mainController::class,"getAll"])->name("tools.all")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::get('/{product}/{id}',[mainController::class,"product_page"])->whereIn('product', ['product', 'pack'])->name("product_page")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::get('/tools', [mainController::class, 'All_tools'])->name("tools.all")->middleware([\App\Http\Middleware\RateLimitPerIP::class]);

Route::get("/test",function (){
    $paypalOrderId ="123";
    $products =[1,3];
    $duration="1m";
    $duration_month =1;
    Mail::to(Auth()->user()->email)->send(new OrderShipped(Auth()->user()->name,$paypalOrderId,$products,$duration,Carbon::now()->addMonths($duration_month)));
    return "email sent it";
});











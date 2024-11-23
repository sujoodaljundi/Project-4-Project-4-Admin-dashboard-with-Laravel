<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PriceRangeController;
use App\Http\Controllers\Admin\PropertyStatusController;
use App\Http\Controllers\Admin\PropertyConditionController;



Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
Route::get('/dashboard',[DashboardController::class,'index']);


Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('add-category',[CategoryController::class,'create']);
Route::post('add-category', [CategoryController::class, 'store'])->name('admin.add-category');
Route::put('update-category/{category_id}', [CategoryController::class, 'update'])->name('admin.update-category');
Route::get('edit-category/{category_id}', [CategoryController::class, 'edit'])->name('admin.edit-category');
Route::delete('delete-category/{id}', [CategoryController::class, 'destroy'])->name('admin.delete-category');
Route::get('soft-delete-category/{category_id}', [CategoryController::class, 'softDelete'])->name('admin.soft-delete-category');
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{id}/toggle-delete', [UserController::class, 'toggleDelete'])->name('users.toggleDelete');
// Routes for editing users
Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('admin/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');


Route::resource('users', UserController::class);




Route::prefix('property')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('admin.property.index');
    Route::get('/create', [PropertyController::class, 'create'])->name('admin.property.create');
    Route::post('/', [PropertyController::class, 'store'])->name('admin.property.store');
    Route::get('/{id}/edit', [PropertyController::class, 'edit'])->name('admin.property.edit');
    Route::put('/{id}', [PropertyController::class, 'update'])->name('admin.property.update');
    Route::get('/admin/property/create', [PropertyController::class, 'create'])->name('admin.property.create');
Route::post('/admin/property', [PropertyController::class, 'store'])->name('admin.property.store');
Route::delete('/admin/property/{id}', [PropertyController::class, 'destroy'])->name('admin.property.destroy');

});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('property', PropertyController::class);
    Route::get('property/{id}/view', [PropertyController::class, 'show'])->name('property.show');
});
Route::get('admin/property-condition/{id}', [PropertyConditionController::class, 'show'])->name('admin.property-condition.show');

});



Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // عرض جميع حالات العقارات
    Route::get('property-condition', [PropertyConditionController::class, 'index'])->name('property-condition.index');
    
    // عرض حالة العقار المفصلة
    Route::get('property-condition/{id}', [PropertyConditionController::class, 'show'])->name('property-condition.show');
        Route::get('property-condition/{id}', [PropertyController::class, 'show'])->name('admin.property.show');


    // عرض العقار المفصل
    Route::get('property/{id}', [PropertyController::class, 'show'])->name('property.show');
    Route::get('property/{id}', [PropertyController::class, 'show'])->name('admin.property.show');


});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('property_condition', PropertyConditionController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('property_status', PropertyStatusController::class);
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('price_range', PriceRangeController::class);
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('contacts', ContactController::class)->only(['index', 'show']);
    
});
Route::put('admin/contacts/{id}/mark-as-read', [ContactController::class, 'markAsRead'])->name('admin.contacts.markAsRead');
Route::resource('contacts', ContactController::class);
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::resource('contacts', ContactController::class);
});
Route::delete('contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

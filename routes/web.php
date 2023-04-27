<?php

use Illuminate\Support\Facades\Route;

// Guest Controller
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Guest\PostController as GuestPostController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;
use App\Http\Controllers\Guest\ContactController as GuestContactController;
use App\Http\Controllers\Guest\AboutController as GuestAboutController;
// End Guest Controller

// Admin Controller
use App\Http\Controllers\Auth\LoginController as LoginController;
use App\Http\Controllers\Admin\DetailPostController as AdminDetailPostController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UploadFileCKEditorController as AdminUploadFileCKEditorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;

// End Admin Controller

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

/** 
 * Guest Route
 */
//  Route::get('/artisan/run', function() {
//     Artisan::call('db:seed'); 
//     return 'OKE !';
// });
Route::get('/', [GuestHomeController::class, 'index'])->name('guest.home');

Route::get('/home', function()
{
   return redirect()->route('admin.post.index'); 
});

Route::group(['prefix' => 'project'], function(){
    Route::get('/', [GuestProjectController::class, 'index'])->name('guest.project.index');
    Route::get('/{slug}', [GuestProjectController::class, 'show'])->name('guest.project.detail');
});

Route::group(['prefix' => 'post'], function(){
    Route::get('/', [GuestPostController::class, 'index'])->name('guest.post.index');
    Route::get('/{slug}', [GuestPostController::class, 'show'])->name('guest.post.detail');
    Route::get('category/{category}', [GuestPostController::class, 'showByCategory'])->name('guest.post.category');
});

Route::group(['prefix' => 'contact'], function(){
    Route::get('/', [GuestContactController::class, 'index'])->name('guest.contact.index');
});

Route::group(['prefix' => 'about-us'], function(){
    Route::get('/', [GuestAboutController::class, 'index'])->name('guest.about_us.index');
});

/**
 * Admin Route
 */
Route::group(['prefix' => 'admin'], function()
{
    
    Route::get('/login', [LoginController::class, 'showLoginFormAdmin'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'authenticateAdmin'])->name('admin.login.authenticate');
    Route::post('/logout', [LoginController::class, 'logoutAdmin'])->name('admin.auth.logout');
    
    Route::get('template', function()
    {
        dd(rand(1, 2));
        return view('templateContent');
    });

    Route::group(['middleware' => 'isAdmin'], function()
    {
        Route::group(['prefix' => 'ckeditor-fileupload'], function ()
        {
            Route::get('/', [AdminUploadFileCKEditorController::class, 'index'])->name('admin.ckeditor.index');
            Route::get('{id}/show-post', [AdminUploadFileCKEditorController::class, 'show'])->name('admin.ckeditor.showPost');
            Route::post('upload-file', [AdminUploadFileCKEditorController::class, 'upload'])->name('admin.uploadFileCKEditor');   
        });

        Route::group(['prefix' => 'projects'], function ()
        {
            Route::get('/', [AdminProjectController::class, 'index'])->name('admin.project.index');

            Route::get('/data', [AdminProjectController::class, 'data'])->name('admin.project.data');
            
            Route::get('create', [AdminProjectController::class, 'create'])->name('admin.project.create');
            Route::post('create', [AdminProjectController::class, 'store'])->name('admin.project.store');
            Route::get('{slug}/edit', [AdminProjectController::class, 'edit'])->name('admin.project.edit');
            Route::put('{slug}/update', [AdminProjectController::class, 'update'])->name('admin.project.update');
            Route::put('{slug}/delete', [AdminProjectController::class, 'destroy'])->name('admin.project.destroy');
            Route::put('{slug}/delete', [AdminProjectController::class, 'destroy'])->name('admin.project.destroy');
            Route::get('{slug}/preview-as-reader', [AdminProjectController::class, 'previewAsReader'])->name('admin.project.preview.asReader');
            Route::put('{slug}/publish', [AdminProjectController::class, 'checkboxPublish'])->name('admin.project.checkboxPublish'); 

            Route::delete('/delete/{id}/img-slider', [AdminProjectController::class, 'destroyImgSlider'])->name('admin.project.imgSlider.destroy');
        });

        Route::group(['prefix' => 'post'], function ()
        {
            Route::get('/', [AdminDetailPostController::class, 'index'])->name('admin.post.index');

            Route::get('/data', [AdminDetailPostController::class, 'data'])->name('admin.post.data');
            
            Route::get('create', [AdminDetailPostController::class, 'create'])->name('admin.post.create');
            Route::post('create', [AdminDetailPostController::class, 'store'])->name('admin.post.store');
            Route::get('{slug}/edit', [AdminDetailPostController::class, 'edit'])->name('admin.post.edit');
            Route::put('{slug}/update', [AdminDetailPostController::class, 'update'])->name('admin.post.update');
            Route::put('{slug}/delete', [AdminDetailPostController::class, 'destroy'])->name('admin.post.destroy');
            Route::put('{slug}/delete', [AdminDetailPostController::class, 'destroy'])->name('admin.post.destroy');
            Route::get('{slug}/preview-as-reader', [AdminDetailPostController::class, 'previewAsReader'])->name('admin.post.preview.asReader');
            Route::put('{slug}/publish', [AdminDetailPostController::class, 'checkboxPublish'])->name('admin.post.checkboxPublish');

            

            Route::get('/{slug}', function ($slug) {
                return view('pages.user.post.show', compact('slug'));
            })->name('admin.post.show');
        });

        Route::group(['prefix' => 'category'], function ()
        {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
            Route::get('/data', [AdminCategoryController::class, 'data'])->name('admin.category.data');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/{id}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
            Route::get('/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/{id}/delete', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        Route::group(['prefix' => 'accounts'], function()
        {
            Route::get('/', [AdminAccountController::class, 'index'])->name('admin.accounts.index');
            Route::get('admin/data', [AdminAccountController::class, 'dataAdmin'])->name('admin.accounts.admin.data');
            Route::get('admin/create', [AdminAccountController::class, 'createDataAdmin'])->name('admin.accounts.admin.create');
            Route::get('admin/{id}/edit', [AdminAccountController::class, 'editDataAdmin'])->name('admin.accounts.admin.edit');
            Route::post('admin/store', [AdminAccountController::class, 'storeDataAdmin'])->name('admin.accounts.admin.store');
            Route::put('admin/{id}/update', [AdminAccountController::class, 'updateDataAdmin'])->name('admin.accounts.admin.update');
            Route::delete('admin/{id}/delete', [AdminAccountController::class, 'destroyDataAdmin'])->name('admin.accounts.admin.destroy');
            Route::put('admin/{id}/non-aktif', [AdminAccountController::class, 'nonAktifAdmin'])->name('admin.accounts.admin.nonAktif');
        });

        Route::group(['prefix' => 'settings'], function(){
            Route::group(['prefix' => 'tampilan'], function()
            {
                Route::post('add-slide', [AdminSettingsController::class, 'addSlide'])->name('admin.settings.tampilan.addSlide');
                Route::post('{id}/save-slide', [AdminSettingsController::class, 'saveSlide'])->name('admin.settings.tampilan.saveSlide');
                Route::delete('{id}/delete-slide', [AdminSettingsController::class, 'deleteSlide'])->name('admin.settings.tampilan.deleteSlide');

                Route::post('/post-content-about-us', [AdminSettingsController::class, 'kontenAboutUsStore'])->name('admin.settings.tampilan.about_us.konten.store');

                Route::group(['prefix' => 'our-clients'],function()
                {
                    Route::get('data', [AdminSettingsController::class, 'ourClientsData'])->name('admin.settings.tampilan.ourClients.data');
                    Route::get('{id}/show', [AdminSettingsController::class, 'ourClientsDatashow'])->name('admin.settings.tampilan.ourClients.show');
                    Route::post('store', [AdminSettingsController::class, 'ourClientsDataStore'])->name('admin.settings.tampilan.ourClients.store');
                    Route::put('{id}/update', [AdminSettingsController::class, 'ourClientsDataUpdate'])->name('admin.settings.tampilan.ourClients.update');
                    Route::delete('{id}/destroy', [AdminSettingsController::class, 'ourClientsDataDestroy'])->name('admin.settings.tampilan.ourClients.destroy');
                });

            });

            Route::get('/', [AdminSettingsController::class, 'index'])->name('admin.settings.index');
            Route::post('/update-data-account', [AdminSettingsController::class, 'updateDataAccount'])->name('admin.settings.updateDataAccount');
            Route::post('/change-password', [AdminSettingsController::class, 'changePassword'])->name('admin.settings.changePassword');
            Route::get('/data/uploaded-file-from-contents', [AdminSettingsController::class, 'library'])->name('admin.settings.library');
            Route::post('/data/uploaded-file-from-contents', [AdminSettingsController::class, 'deleteAllChecked'])->name('admin.settings.library.deleteAllChecked');
            Route::delete('/data/uploaded-file-from-contents/{id}/destroy', [AdminSettingsController::class, 'deleteFileAtContent'])->name('admin.settings.library.deleteFileAtContent');
            
        });

    });

});
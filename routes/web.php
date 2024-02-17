<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\EmailsController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth::routes();


Route::group(['middleware' => ['guest']], function () {
    // Login
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.perform');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('members', [MembersController::class, 'index'])->name('members');
    Route::post('member-delete', [MembersController::class, 'delete'])->name('member.delete');
    Route::post('member-create', [MembersController::class, 'create'])->name('member.create');
    Route::post('member-update', [MembersController::class, 'update'])->name('member.update');

    Route::get('campaigns', [CampaignsController::class, 'index'])->name('campaigns');
    Route::post('campaign-delete', [CampaignsController::class, 'delete'])->name('campaign.delete');
    Route::post('campaign-create', [CampaignsController::class, 'create'])->name('campaign.create');
    Route::post('campaign-update', [CampaignsController::class, 'update'])->name('campaign.update');
    Route::post('campaign-send', [CampaignsController::class, 'send'])->name('campaign.send');
    
    Route::get('emails', [EmailsController::class, 'index'])->name('emails');
    
});
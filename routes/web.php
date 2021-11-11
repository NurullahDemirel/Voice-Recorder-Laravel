<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserDetail\UserDetail;
use App\Models\UserPost\Post;
use App\Models\UserRole\Role;
use App\Models\UserRole\UserRole;
use App\Models\Reviewer\Reviewer;
use App\Models\Tag\Tag;
use App\Models\Category\Category;


Route::get('/',function (){
        return view('voice');
});

Route::post('upload/voice',[CategoryController::class,'postVoice'])->name('upload.voice');



<?php

use App\Http\Controllers\LeaderBoardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("",[LeaderBoardController::class,'index'])->name('leader-board.index');
Route::get("leader-board/recalculate",[LeaderBoardController::class,'recalculate'])->name('leader-board.recalculate');

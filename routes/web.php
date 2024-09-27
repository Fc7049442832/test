<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('index');
})->name('index');

// Route::view('/showForm','register')->name('showForm');
// Route::post('register', [AuthController::class, 'register'])->name('register');

Route::view('/showLoginForm','login')->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard',[AuthController::class, 'showDashboard'])->name('dashboard');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Companies CRUD Routes
Route::resource('companies', CompanyController::class);

// Employees CRUD Routes
Route::resource('employees', EmployeeController::class);


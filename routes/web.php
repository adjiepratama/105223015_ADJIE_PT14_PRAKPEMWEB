<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', function () {
    return view('login'); 
})->name('login'); 

Route::get('/debug-login', function () {
    $user = \App\Models\User::firstOrCreate(
        ['email' => 'test@labloan.com'],
        ['name' => 'Mahasiswa Test', 'password' => bcrypt('12345678')]
    );
    Auth::login($user);
    return redirect()->route('items.index');
});


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/items', [LoanController::class, 'index'])->name('items.index');
    Route::post('/loan', [LoanController::class, 'store'])->name('loan.store');
    Route::get('/my-loans', [LoanController::class, 'myLoans'])->name('loans.index');
    Route::post('/loan/{id}/return', [LoanController::class, 'returnItem'])->name('loan.return');
});
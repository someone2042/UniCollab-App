<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/users', function (Request $request) {
    $formFields = $request->validate([
        'name' => ['required', 'min:3'],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'password' => 'required|confirmed|min:6'
    ]);
    //hash password
    $formFields['password'] = bcrypt(($formFields['password']));

    $user = User::create($formFields);

    event(new Registered($user));

    auth()->login($user);
    return redirect('/email/verify');
});

Route::get('/main', function () {
    return view('main');
})->middleware(['auth', 'verified']);;

Route::post('/logout', function (Request $request) {

    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
});
Route::post('/users/authenticate', function (Request $request) {
    $formFields = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);
    if (auth()->attempt($formFields)) {
        $request->session()->regenerate();
        return redirect('/main')->with('message', 'You are now logged in');
    }
    return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
});

Route::get('/email/verify', function () {
    return view('auth-verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/main');
})->middleware(['auth', 'signed'])->name('verification.verify');

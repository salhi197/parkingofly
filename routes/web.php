<?php

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/mail', function(){
    $data = [
        'subject' => 'Ticket de Reservation',
        'email' => "salhiali197@gmail.com",
        'content' => "Hi there Hhhh"    
      ];
  
    Mail::send('email', $data, function($message) use ($data) {
        $message->to('salhiali197@gmail.com')
        ->subject('Ticket de reservation ');
      });
});

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['prefix' => 'reservation', 'as' => 'reservation'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ReservationController@index']);
    Route::get('/caisse', ['as' => '.caisse', 'uses' => 'ReservationController@caisse']);
    Route::post('/caisse/filter', ['as' => '.caisse.filter', 'uses' => 'ReservationController@caisseFilter']);
    Route::get('/setstate/{id_reservation}/{state}', ['as' => '.setstate', 'uses' => 'ReservationController@setState']);

    Route::post('/total', ['as' => '.total', 'uses' => 'ReservationController@total']);
    Route::get('/create',['as'=>'.create', 'uses' => 'ReservationController@create']);
    Route::post('/store', ['as' => '.store', 'uses' => 'ReservationController@store']);
    Route::post('/multiple', ['as' => '.multiple', 'uses' => 'ReservationController@multiple']);
    Route::post('/filter', ['as' => '.filter', 'uses' => 'ReservationController@filter']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'ReservationController@destroy']); 
    Route::get('/stock/{id_demande}', ['as' => '.stock', 'uses' => 'ReservationController@stock']); 
    Route::get('/print/stock/{id_demande}', ['as' => '.print.stock', 'uses' => 'ReservationController@printStock']); 
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'ReservationController@edit']);
    Route::get('/show/{id_reservation}', ['as' => '.show', 'uses' => 'ReservationController@show']);
    Route::post('/update/{reservation}', ['as' => '.update', 'uses' => 'ReservationController@update']);    
    Route::post('/regler/{reservation}', ['as' => '.regler', 'uses' => 'ReservationController@regler']);    
    Route::get('/valider/{reservation}', ['as' => '.valider', 'uses' => 'ReservationController@valider']);    
    Route::post('/search', ['as' => '.search', 'uses' => 'ReservationController@search']);    
    Route::post('/filter', ['as' => '.filter', 'uses' => 'ReservationController@filter']);    
    Route::post('/filter/paiment', ['as' => '.filter.paiment', 'uses' => 'ReservationController@filterPaiment']);    
    
    Route::get('/ticket/{id_reservation}', ['as' => '.ticket', 'uses' => 'ReservationController@ticket']);


});


Route::group(['prefix' => 'hotel', 'as' => 'hotel'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'HotelController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'HotelController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'HotelController@store']);
    Route::post('/update/{id_hotel}', ['as' => '.update', 'uses' => 'HotelController@update']);
    Route::get('/destroy/{id_hotel}', ['as' => '.destroy', 'uses' => 'HotelController@destroy']);    
    Route::get('/edit/{id_hotel}', ['as' => '.edit', 'uses' => 'HotelController@edit']);
});



Route::group(['prefix' => 'place', 'as' => 'place'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'PlaceController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'PlaceController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'PlaceController@store']);
    Route::post('/update/{id_place}', ['as' => '.update', 'uses' => 'PlaceController@update']);
    Route::get('/destroy/{id_place}', ['as' => '.destroy', 'uses' => 'PlaceController@destroy']);    
    Route::get('/edit/{id_place}', ['as' => '.edit', 'uses' => 'PlaceController@edit']);
});

Route::group(['prefix' => 'categorie2', 'as' => 'categorie2'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'Categorie2Controller@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'Categorie2Controller@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'Categorie2Controller@store']);
    Route::post('/update/{id_categorie}', ['as' => '.update', 'uses' => 'Categorie2Controller@update']);
    Route::get('/destroy/{id_categorie}', ['as' => '.destroy', 'uses' => 'Categorie2Controller@destroy']);    
    Route::get('/edit/{id_categorie}', ['as' => '.edit', 'uses' => 'Categorie2Controller@edit']);
});
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/caisse', 'HomeController@caisse')->name('caisse');
Route::get('/setting', 'HomeController@setting')->name('setting');
Route::get('/qrcode/{qrcode}', 'HomeController@qrcodePDF')->name('qrcode.pdf');
Route::get('/qrcode', 'HomeController@qrcode')->name('qrcode');
Route::post('/setting/update', 'HomeController@updateSetting')->name('setting.update');

Route::post('/payment/store', 'PaymentController@store')->name('payment.store');
Auth::routes();








Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/livreur', 'Auth\LoginController@showLivreurLoginForm')->name('login.Livreur');
Route::get('/login/operateur', 'Auth\LoginController@showOperateurLoginForm')->name('login.operateur');
Route::get('/login/fournisseur', 'Auth\LoginController@showFournisseurLoginForm')->name('login.Fournisseur');
Route::get('/login/freelancer', 'Auth\LoginController@showFreelancerLoginForm')->name('login.Freelancer');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/operateur', 'Auth\RegisterController@showOperateurRegisterForm')->name('register.operateur');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/livreur', 'Auth\LoginController@livreurLogin');
Route::post('/login/operateur', 'Auth\LoginController@operateurLogin');
Route::post('/login/fournisseur', 'Auth\LoginController@fournisseurLogin');
Route::post('/login/freelancer', 'Auth\LoginController@freelancerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/livreur', 'Auth\RegisterController@createLivreur')->name('register.Livreur');


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});


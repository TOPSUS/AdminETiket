<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>'SAdmin'],function(){
Route::get('/Dashboard', 'Admin\adminController@index')->name('admin-home');

Route::prefix('Admin')->group(function () {
	Route::get('/Dashboard', 'Admin\adminController@index')->name('admin-home');
	Route::get('/Dashboard/ContactUs', 'Admin\adminController@contact')->name('admin-contact');
	});

//Route Page
Route::get('/Dashboard/Speedboat', 'speedboatController@index')->name('speedboat');
Route::get('/Dashboard/SpeedboatContact', 'speedboatController@contact')->name('speedboat-contact');

Route::get('/Dashboard/Berita', 'beritaController@index')->name('berita');

Route::get('/Dashboard/Pelabuhan', 'Crud\pelabuhanController@index')->name('pelabuhan');
Route::get('/Dashboard/PelabuhanContact', 'Crud\pelabuhanController@contact')->name('pelabuhan-contact');




//Route CRUD
	//User
		Route::get('/Dashboard/CRUD/CustomerData', 'Crud\userController@viewcustomer')->name('viewuser-customer');
		Route::get('/Dashboard/CRUD/DirekturData', 'Crud\userController@viewdirektur')->name('viewuser-direktur');
		Route::get('/Dashboard/CRUD/AdminData', 'Crud\userController@viewadmin')->name('viewuser-admin');
		Route::get('/Dashboard/CRUD/SuperAdminData', 'Crud\userController@viewsuperadmin')->name('viewuser-superadmin');
		Route::get('/Dashboard/CRUD/CreateUser', 'Crud\userController@create')->name('create-user');
		Route::post('/Dashboard/CRUD/AddUser','Crud\UserController@addUser')->name('add-user');
		

	//Speedboat
		Route::get('/Dashboard/CRUD/SpeedboatData', 'Crud\speedboatController@view')->name('viewspeedboat');
		Route::get('/Dashboard/CRUD/CreateSpeedboat', 'Crud\speedboatController@create')->name('create-speedboat');
		Route::post('/Dashboard/CRUD/AddSpeedboat','Crud\speedboatController@addSpeedboat')->name('add-speedboat');
	
	//Jadwal
		Route::get('/Dashboard/CRUD/JadwalData', 'Crud\jadwalController@view')->name('viewjadwal');
		Route::get('/Dashboard/CRUD/CreateJadwal', 'Crud\jadwalController@create')->name('create-jadwal');
	
	//Pelabuhan
		Route::get('/Dashboard/CRUD/PelabuhanData', 'Crud\pelabuhanController@view')->name('viewpelabuhan');
		Route::get('/Dashboard/CRUD/CreatePelabuhan', 'Crud\pelabuhanController@create')->name('create-pelabuhan');
		Route::post('/Dashboard/CRUD/AddPelabuhan','Crud\pelabuhanController@addPelabuhan')->name('add-pelabuhan');

	//Reward Speedboat
		Route::get('/Dashboard/CRUD/RewardSpeedboatData', 'Crud\rewardSpeedboatController@view')->name('viewreward');
		Route::get('/Dashboard/CRUD/CreateRewardSpeedboatData', 'Crud\rewardSpeedboatController@create')->name('create-reward');
	
	//Card
		Route::get('/Dashboard/CRUD/Card', 'Crud\cardController@view')->name('viewcard');
		Route::get('/Dashboard/CRUD/CreateCard', 'Crud\cardController@create')->name('create-card');
		Route::post('/Dashboard/CRUD/AddCard','Crud\cardController@addCard')->name('add-card');

});


//Route Login Register
Route::get('/', 'loginController@index')->name('logins')->middleware('guest');
Route::get('/Logout', 'loginController@logoutAdmin')->name('logouts');
Route::post('/LoginAdmin','loginController@loginAdmin')->name('loginAdmin');
Route::get('/Register','registerController@index')->name('register');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

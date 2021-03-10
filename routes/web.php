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
		Route::post('/Dashboard/CRUD/UpdateCustomer','Crud\UserController@updateUser')->name('update-user');
		Route::get('/Dashboard/CRUD/DeleteUser/{id}','Crud\UserController@deleteUser')->name('delete-user');
		

	//Speedboat
		Route::get('/Dashboard/CRUD/SpeedboatData', 'Crud\speedboatController@view')->name('viewspeedboat');
		Route::get('/Dashboard/CRUD/CreateSpeedboat', 'Crud\speedboatController@create')->name('create-speedboat');
		Route::post('/Dashboard/CRUD/AddSpeedboat','Crud\speedboatController@addSpeedboat')->name('add-speedboat');
		Route::post('/Dashboard/CRUD/UpdateSpeedboat','Crud\speedboatController@updateSpeedboat')->name('update-speedboat');
		Route::get('/Dashboard/CRUD/DeleteSpeedboat/{id}','Crud\speedboatController@deleteSpeedboat')->name('delete-speedboat');
	
	//Jadwal
		Route::get('/Dashboard/CRUD/JadwalData', 'Crud\jadwalController@view')->name('viewjadwal');
		Route::get('/Dashboard/CRUD/CreateJadwal', 'Crud\jadwalController@create')->name('create-jadwal');
		Route::post('/Dashboard/CRUD/AddJadwal','Crud\jadwalController@addJadwal')->name('add-jadwal');
		Route::post('/Dashboard/CRUD/UpdateJadwal','Crud\jadwalController@updateJadwal')->name('update-jadwal');
		Route::get('/Dashboard/CRUD/DeleteJadwal/{id}','Crud\jadwalController@deleteJadwal')->name('delete-jadwal');

	
	//Pelabuhan
		Route::get('/Dashboard/CRUD/PelabuhanData', 'Crud\pelabuhanController@view')->name('viewpelabuhan');
		Route::get('/Dashboard/CRUD/CreatePelabuhan', 'Crud\pelabuhanController@create')->name('create-pelabuhan');
		Route::post('/Dashboard/CRUD/AddPelabuhan','Crud\pelabuhanController@addPelabuhan')->name('add-pelabuhan');
		Route::post('/Dashboard/CRUD/UpdatePelabuhan','Crud\pelabuhanController@updatePelabuhan')->name('update-pelabuhan');
		Route::get('/Dashboard/CRUD/DeletePelabuhan/{id}','Crud\pelabuhanController@deletePelabuhan')->name('delete-pelabuhan');

	//Reward Speedboat
		Route::get('/Dashboard/CRUD/RewardSpeedboatData', 'Crud\rewardSpeedboatController@view')->name('viewreward');
		Route::get('/Dashboard/CRUD/CreateRewardSpeedboatData', 'Crud\rewardSpeedboatController@create')->name('create-reward');
		Route::post('/Dashboard/CRUD/AddRewardSpeedboat','Crud\rewardSpeedboatController@addRewardSpeedboat')->name('add-rewardspeedboat');
		Route::post('/Dashboard/CRUD/UpdateRewardSpeedboat','Crud\rewardSpeedboatController@updateRewardSpeedboat')->name('update-rewardspeedboat');
		Route::get('/Dashboard/CRUD/DeleteRewardSpeedboat/{id}','Crud\rewardSpeedboatController@deleteRewardSpeedboat')->name('delete-rewardspeedboat');
	
	//Card
		Route::get('/Dashboard/CRUD/Card', 'Crud\cardController@view')->name('viewcard');
		Route::get('/Dashboard/CRUD/CreateCard', 'Crud\cardController@create')->name('create-card');
		Route::post('/Dashboard/CRUD/AddCard','Crud\cardController@addCard')->name('add-card');
		Route::post('/Dashboard/CRUD/UpdateCard','Crud\cardController@updateCard')->name('update-card');
		Route::get('/Dashboard/CRUD/DeleteCard/{id}','Crud\cardController@deleteCard')->name('delete-user');

});


//Route Login Register
Route::get('/', 'loginController@index')->name('logins')->middleware('guest');
Route::get('/Logout', 'loginController@logoutAdmin')->name('logouts');
Route::post('/LoginAdmin','loginController@loginAdmin')->name('loginAdmin');
Route::get('/Register','registerController@index')->name('register');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

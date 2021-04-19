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

//ROUTE SUPER ADMIN -----------------------------------------------------------------------------------
Route::group(['middleware'=>'SAdmin'],function(){
Route::get('/Dashboard', 'Admin\adminController@index')->name('admin-home');


Route::prefix('Admin')->group(function () {
	Route::get('/Dashboard', 'Admin\adminController@index')->name('admin-home');
	Route::get('/Dashboard/ContactUs', 'Admin\adminController@contact')->name('admin-contact');
	});

//Route Page
Route::get('/Dashboard/Speedboat', 'speedboatController@index')->name('speedboat');
Route::get('/Dashboard/SpeedboatContact', 'speedboatController@contact')->name('speedboat-contact');
Route::get('/Dashboard/Ferry', 'kapalController@index')->name('kapal');

//Berita Pelabuhan
Route::get('/Dashboard/BeritaPelabuhan', 'beritaController@indexPelabuhan')->name('berita-pelabuhan');
Route::get('/Dashboard/BeritaPelabuhan/Create', 'beritaController@createBeritaPelabuhan')->name('create-beritaPelabuhan');
Route::Post('/Dashboard/BeritaPelabuhan/AddBerita', 'beritaController@addBeritaPelabuhan')->name('add-beritaPelabuhan');
route::delete('/Dashboard/BeritaPelabuhan/{id}/delete','beritaController@deleteBeritaPelabuhan')->name('delete-BeritaPelabuhan');


//Berita Speedboat
Route::get('/Dashboard/BeritaSpeedboat', 'beritaController@indexSpeedboat')->name('berita-speedboat');
Route::get('/Dashboard/BeritaSpeedboat/Create', 'beritaController@createBeritaSpeedboat')->name('create-beritaSpeedboat');
Route::Post('/Dashboard/BeritaSpeedboat/AddBerita', 'beritaController@addBeritaSpeedboat')->name('add-beritaSpeedboat');
route::delete('/Dashboard/BeritaSpeedboat/{id}/delete','beritaController@deleteBeritaSpeedboat')->name('delete-beritaSpeedboat');


//
Route::get('/Dashboard/Pelabuhan', 'Crud\pelabuhanController@index')->name('pelabuhan');
Route::get('/Dashboard/PelabuhanContact', 'Crud\pelabuhanController@contact')->name('pelabuhan-contact');

//Direktur Speedboat
Route::get('/Dashboard/CRUD/DirekturData/Speedboat/View/{id}', 'direkturController@speedboat')->name('direktur-speedboat');
Route::get('/Dashboard/CRUD/DirekturData/Speedboat/Create/{id}', 'direkturController@createspeedboat')->name('direktur-createspeedboat');
Route::Post('/Dashboard/CRUD/DirekturData/Speedboat/Add', 'direkturController@addSpeedboat')->name('direktur-addspeedboat');

//Direktur Kapal
Route::get('/Dashboard/CRUD/DirekturData/Kapal/View/{id}', 'direkturController@kapal')->name('direktur-kapal');
Route::get('/Dashboard/CRUD/DirekturData/Kapal/Create/{id}', 'direkturController@createkapal')->name('direktur-createkapal');
Route::Post('/Dashboard/CRUD/DirekturData/Kapal/Add', 'direkturController@addKapal')->name('direktur-addkapal');



//Route CRUD
	//User
		Route::get('/Dashboard/CRUD/CustomerData', 'Crud\userController@viewcustomer')->name('viewuser-customer');
		Route::get('/Dashboard/CRUD/DirekturData', 'Crud\userController@viewdirektur')->name('viewuser-direktur');
		Route::get('/Dashboard/CRUD/AdminData', 'Crud\userController@viewadmin')->name('viewuser-admin');
		Route::get('/Dashboard/CRUD/SuperAdminData', 'Crud\userController@viewsuperadmin')->name('viewuser-superadmin');
		Route::get('/Dashboard/CRUD/CreateUser', 'Crud\userController@create')->name('create-user');
		Route::get('/Dashboard/CRUD/CreateDirektur', 'Crud\userController@createdirektur')->name('create-direktur');
		Route::get('/Dashboard/CRUD/CreateAdmin', 'Crud\userController@createadmin')->name('create-admin');
		Route::post('/Dashboard/CRUD/AddAdmin','Crud\UserController@addAdmin')->name('add-admin');
		Route::post('/Dashboard/CRUD/AddDirektur','Crud\UserController@addDirektur')->name('add-direktur');
		Route::post('/Dashboard/CRUD/AddUser','Crud\UserController@addUser')->name('add-user');
		Route::post('/Dashboard/CRUD/UpdateCustomer','Crud\UserController@updateUser')->name('update-user');
		Route::get('/Dashboard/CRUD/DeleteUser/{id}','Crud\UserController@deleteUser')->name('delete-user');
		

	//Speedboat
		Route::get('/Dashboard/CRUD/SpeedboatData', 'Crud\speedboatController@view')->name('viewspeedboat');
		Route::get('/Dashboard/CRUD/CreateSpeedboat', 'Crud\speedboatController@create')->name('create-speedboat');
		Route::post('/Dashboard/CRUD/AddSpeedboat','Crud\speedboatController@addSpeedboat')->name('add-speedboat');
		Route::post('/Dashboard/CRUD/UpdateSpeedboat','Crud\speedboatController@updateSpeedboat')->name('update-speedboat');
		Route::get('/Dashboard/CRUD/DeleteSpeedboat/{id}','Crud\speedboatController@deleteSpeedboat')->name('delete-speedboat');
	
	//Speedboat
		Route::get('/Dashboard/CRUD/KapalData', 'Crud\kapalController@view')->name('viewkapal');
		Route::get('/Dashboard/CRUD/CreateKapal', 'Crud\kapalController@create')->name('create-kapal');
		Route::post('/Dashboard/CRUD/AddKapal','Crud\kapalController@addKapal')->name('add-kapal');
		Route::post('/Dashboard/CRUD/UpdateKapal','Crud\kapalController@updateKapal')->name('update-kapal');
		Route::get('/Dashboard/CRUD/DeleteKapal/{id}','Crud\kapalController@deleteKapal')->name('delete-kapal');

	
	//Jadwal
		Route::get('/Dashboard/CRUD/JadwalData', 'Crud\jadwalController@view')->name('viewjadwal');
		Route::get('/Dashboard/CRUD/CreateJadwal', 'Crud\jadwalController@create')->name('create-jadwal');
		Route::post('/Dashboard/CRUD/AddJadwal','Crud\jadwalController@addJadwal')->name('add-jadwal');
		Route::post('/Dashboard/CRUD/UpdateJadwal','Crud\jadwalController@updateJadwal')->name('update-jadwal');
		Route::get('/Dashboard/CRUD/DeleteJadwal/{id}','Crud\jadwalController@deleteJadwal')->name('delete-jadwal');
	
	//Jadwal Kapal
		Route::get('/Dashboard/CRUD/JadwalKapalData', 'Crud\jadwalKapalController@view')->name('viewjadwalkapal');
		Route::get('/Dashboard/CRUD/CreateJadwalKapal', 'Crud\jadwalKapalController@create')->name('create-jadwalkapal');
		Route::post('/Dashboard/CRUD/AddJadwalKapal','Crud\jadwalKapalController@addJadwal')->name('add-jadwalkapal');
		Route::post('/Dashboard/CRUD/UpdateJadwalKapal','Crud\jadwalKapalController@updateJadwal')->name('update-jadwalkapal');
		Route::get('/Dashboard/CRUD/DeleteJadwalKapal/{id}','Crud\jadwalKapalController@deleteJadwal')->name('delete-jadwalkapal');

	
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

	//Approve Pembelian
		Route::get('/Dashboard/CRUD/Pembelian', 'pembelianController@index')->name('viewpembelian');
		Route::get('/Dashboard/CRUD/DetailPembelian/{id}', 'pembelianController@detail')->name('detail-pembelian');
		Route::get('/Dashboard/CRUD/DetailPembelian/Approve/{id}', 'pembelianController@approve')->name('approve-pembelian');
		Route::get('/Dashboard/CRUD/DetailPembelian/Reject/{id}', 'pembelianController@reject')->name('reject-pembelian');
	


});
//ROUTE SUPER ADMIN END-----------------------------------------------------------------------------------

//Route Login Register
Route::get('/', 'loginController@index')->name('logins')->middleware('guest');
Route::get('/Logout', 'loginController@logoutAdmin')->name('logouts');
Route::post('/LoginAdmin','loginController@loginAdmin')->name('loginAdmin');
Route::get('/Register','registerController@index')->name('register');

//Admin
Route::get('/Admin/Home', 'Admin\adminSpeedboat@index')->name('adminSpeedboatHome');
Route::get('/Jadwal', 'crudAdmin\jadwalController@index')->name('jadwalSpeedboat');
Route::get('/BeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@index')->name('beritaPelabuhan');
Route::get('/Reward', 'crudAdmin\rewardController@view')->name('rewardSpeedboatView');
Route::get('/Review', 'crudAdmin\reviewController@index')->name('reviewSpeedboat');
Route::get('/Transaksi', 'crudAdmin\transaksiPembelianController@index')->name('transaksiPembelian');

//CRUD Admin
	//CRUD Berita Speedboat
	Route::get('/BeritaSpeedboat', 'crudAdmin\beritaSpeedboatController@index')->name('beritaSpeedboat');
	Route::get('/Beritas/CreateBerita', 'crudAdmin\beritaSpeedboatController@create')->name('createBeritaSpeedboat');
	Route::post('/Beritas/AddBerita','crudAdmin\beritaSpeedboatController@addBerita')->name('addBerita');
	Route::get('/BeritaSpeedboat/{id}/edit','crudAdmin\beritaSpeedboatController@editBerita');
    route::post('/Beritas/{id}/update','crudAdmin\beritaSpeedboatController@updateBeritas')->name('updateBerita');
	route::delete('/Beritas/{id}/delete','crudAdmin\beritaSpeedboatController@deleteBeritas')->name('deleteBerita');

	//CRUD Berita Pelabuhan
	Route::get('/BeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@index')->name('beritaPelabuhan');
	Route::get('/Berita/CreateBeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@create')->name('createBeritaPelabuhan');
	Route::post('/Berita/AddBeritaPelabuhan','crudAdmin\beritaPelabuhanController@addBerita')->name('addBeritaPelabuhan');
	Route::get('/BeritaPelabuhan/{id}/edit','crudAdmin\beritaPelabuhanController@editBerita');
    route::post('/Berita/{id}/update','crudAdmin\beritaPelabuhanController@updateBerita')->name('updateBeritaPelabuhan');
	route::delete('/Berita/{id}/delete','crudAdmin\beritaPelabuhanController@deleteBerita')->name('deleteBeritaPelabuhan');

	//CRUD Jadwal
	Route::get('/Jadwal', 'crudAdmin\jadwalController@index')->name('jadwalSpeedboat');
	Route::get('/Jadwal/CreateJadwal', 'crudAdmin\jadwalController@create')->name('createJadwal');
	Route::post('/Jadwal/AddJadwal','crudAdmin\jadwalController@addJadwal')->name('addJadwal');
    route::post('/Jadwal/update','crudAdmin\jadwalController@editJadwal')->name('editJadwal');
	route::delete('/Jadwal/delete/{id}','crudAdmin\jadwalController@deleteJadwalSpeedboat')->name('deleteJadwal');

	//CRUD Speedboat
	Route::get('/ProfileSpeedboat', 'crudAdmin\profileSpeedboatController@profile')->name('speedboatProfile');
	Route::get('/ProfileSpeedboat/CreateProfile', 'crudAdmin\profileSpeedboatController@createSpeedboat')->name('createSpeedboats');
	Route::post('/ProfileSpeedboat/AddProfile','crudAdmin\profileSpeedboatController@addSpeedboat')->name('addSpeedboat');
	Route::get('/ProfileSpeedboat/{id}/edit','crudAdmin\profileSpeedboatController@editSpeedboat');
    route::post('/ProfileSpeedboat/update','crudAdmin\profileSpeedboatController@updateSpeedboat')->name('updateSpeedboat');
	route::delete('/ProfileSpeedboat/{id}/delete','crudAdmin\profileSpeedboatController@deleteSpeedboat')->name('deleteSpeedboat');

	//CRUD Reward Speedboat
	Route::get('/RewardSpeedboat', 'crudAdmin\rewardController@index')->name('rewardSpeedboatView');
	Route::get('/RewardSpeedboat/CreateRewardSpeedboat', 'crudAdmin\rewardController@create')->name('createRewardSpeedboat');
	Route::post('/RewardSpeedboat/AddRewardSpeedboat','crudAdmin\rewardController@addReward')->name('addRewardSpeedboat');
	Route::post('/RewardSpeedboat/UpdateRewardSpeedboat','crudAdmin\rewardController@updateReward')->name('updateRewardSpeedboat');
	Route::get('/RewardSpeedboat/DeleteRewardSpeedboat/{id}','crudAdmin\rewardController@deleteReward')->name('deleteRewardSpeedboat');

	
	//Transaksi Pembelian
	Route::get('Transaksi', 'crudAdmin\transaksiPembelianController@index')->name('transaksiPembelian');
	Route::get('/DetailTransaksi/{id}', 'crudAdmin\transaksiPembelianController@detail')->name('detailTransaksi');
	Route::get('/DetailTransaksi/Approve/{id}', 'crudAdmin\transaksiPembelianController@approve')->name('approveTransaksi');
	Route::get('/DetailTransaksi/Reject/{id}', 'crudAdmin\transaksiPembelianController@reject')->name('rejectTransaksi');

	//Pembelian
	//Route::get('/RewardSpeedboat', 'crudAdmin\rewardController@index')->name('rewardSpeedboatView');
	Route::get('/Pembelian/CreatePembelian', 'pembelianController@create')->name('createPembelian');

//ROUTE ADMIN END-----------------------------------------------------------------------------------

//DIREKTUR
Route::get('/Direktur/Home', 'Admin\direkturController@index')->name('direkturHome');

//CRUD Jadwal
Route::get('/Direktur/Jadwal', 'crudDirektur\jadwalDirekturController@index')->name('jadwalDirektur');
Route::get('/Direktur/Jadwal/CreateJadwal', 'crudDirektur\jadwalDirekturController@create')->name('createJadwalDirektur');
Route::post('/Direktur/Jadwal/AddJadwal','crudDirektur\jadwalDirekturController@addJadwal')->name('addJadwalDirektur');
route::post('/Direktur/Jadwal/update','crudDirektur\jadwalDirekturController@editJadwal')->name('editJadwalDirektur');
route::delete('/Direktur/Jadwal/delete/{id}','crudDirektur\jadwalDirekturController@deleteJadwal')->name('deleteJadwalDirektur');

//CRUD Kapal
Route::get('/Direktur/Kapal', 'crudDirektur\kapalDirekturController@profile')->name('kapalProfile');
Route::get('/Direktur/Kapal/CreateProfile', 'crudDirektur\kapalDirekturController@formKapal')->name('formKapal');
Route::post('/Direktur/Kapal/AddProfile','crudDirektur\kapalDirekturController@createKapal')->name('createKapal');
Route::get('/Direktur/Kapal/{id}/edit','crudDirektur\kapalDirekturController@editKapal');
route::post('/Direktur/Kapal/update','crudDirektur\kapalDirekturController@updateKapal')->name('updateKapal');
route::delete('/Direktur/Kapal/{id}/delete','crudDirektur\kapalDirekturController@deleteKapal')->name('deleteKapal');

Route::get('/Direktur/Kapal/ListAdmin/{id}', 'crudDirektur\kapalDirekturController@viewAdmin')->name('listAdmin');
route::post('/Direktur/Kapal/updateAdmin','crudDirektur\kapalDirekturController@updateAdmin')->name('updateAdmin');
route::delete('/Direktur/Kapal/{id}/deleteAdmin','crudDirektur\kapalDirekturController@deleteAdmin')->name('deleteAdmin');
Route::post('/Direktur/Kapal/AddAdmin','crudDirektur\kapalDirekturController@createAdmin')->name('createAdmin');

Auth::routes();
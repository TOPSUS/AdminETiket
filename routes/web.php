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
Route::get('/ooof', function () {
    Artisan::call('storage:link');
});

Route::get('/ooof2', function () {
    Artisan::call('sweetalert:publish');
});

route::get('/test-blog',function (){
   return view('blog');
});

//Route Login Register
Route::get('/', 'loginController@index')->name('logins');
Route::get('/Logout', 'loginController@logoutAdmin')->name('logouts');
Route::post('/LoginAdmin', 'loginController@loginAdmin')->name('loginAdmin');
Route::get('/Register', 'registerController@index')->name('register');

Route::get('/e-ticket-generate/{id_pembelian}', 'pembelianController@eTicketGenerate');
Route::get('/e-ticket/{id_pembelian}', 'pembelianController@etickets');

Route::get('/getGolongans/{id}','pembelianController@getGolongans');

Route::get('/id-card/get', 'pembelianController@kaka');

Route::get('/berita/public/pelabuhan/{id}','publicBeritaController@pelabuhan');
Route::get('/berita/public/kapal/{id}','publicBeritaController@kapal');

route::get('/kapal/list/{id}','PAdmin\jadwalController@ajaxList')->name('listKapalBasedOnAsalPelabuhan');
route::post('/ajax/jadwal/turnOn','PAdmin\jadwalController@ajaxTurnOn')->name('status-aktif-jadwal');
route::post('/ajax/jadwal/turnOff','PAdmin\jadwalController@ajaxTurnOff')->name('status-nonaktif-jadwal');
route::get('/ajax/dermaga/list/tujuan/{id}','PAdmin\jadwalController@ajaxDermagaTujuan')->name('status-nonaktif-jadwal');
route::get('/ajax/dermaga/list/asal/{id}','PAdmin\jadwalController@ajaxDermagaAsal')->name('status-nonaktif-jadwal');
Route::post('/ajax/kapal/pelabuhan','direkturController@ajaxPelabuhan');
route::get('/cetakpdf','report@cetakPDF');

//ROUTE SUPER ADMIN -----------------------------------------------------------------------------------
Route::group(['middleware' => 'SAdmin'], function () {
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
    Route::get('/Dashboard/BeritaPelabuhan/{id}/update','beritaController@editFormBeritaPelabuhan')->name('form-updateBeritaPelabuhan');
    Route::Post('/Dashboard/BeritaPelabuhan/update/post', 'beritaController@updateBeritaPelabuhan')->name('update-beritaPelabuhan');
    route::delete('/Dashboard/BeritaPelabuhan/{id}/delete', 'beritaController@deleteBeritaPelabuhan')->name('delete-BeritaPelabuhan');

//Berita Speedboat
    Route::get('/Dashboard/BeritaSpeedboat', 'beritaController@indexSpeedboat')->name('berita-speedboat');
    Route::get('/Dashboard/BeritaSpeedboat/Create', 'beritaController@createBeritaSpeedboat')->name('create-beritaSpeedboat');
    Route::Post('/Dashboard/BeritaSpeedboat/AddBerita', 'beritaController@addBeritaSpeedboat')->name('add-beritaSpeedboat');
    Route::get('/Dashboard/BeritaSpeedboat/{id}/update','beritaController@editFormBeritaSpeedboat')->name('form-updateBeritaSpeedboat');
    Route::Post('/Dashboard/BeritaSpeedboat/update/post', 'beritaController@updateBeritaSpeedboat')->name('update-beritaSpeedboat');
    route::delete('/Dashboard/BeritaSpeedboat/{id}/delete', 'beritaController@deleteBeritaSpeedboat')->name('delete-beritaSpeedboat');

//Admin Pelabuhan
    Route::get('/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/View/{id}', 'Admin\adminPelabuhanController@pelabuhan')->name('padmin-pelabuhan');
    Route::get('/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/Create/{id}', 'Admin\adminPelabuhanController@createpelabuhan')->name('padmin-createpelabuhan');
    Route::Post('/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/Add', 'Admin\adminPelabuhanController@addPelabuhan')->name('padmin-addpelabuhan');

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
    Route::get('/Dashboard/CRUD/AdminPelabuhanData', 'Crud\userController@viewadminpelabuhan')->name('viewuser-adminpelabuhan');
    Route::get('/Dashboard/CRUD/SuperAdminData', 'Crud\userController@viewsuperadmin')->name('viewuser-superadmin');
    Route::get('/Dashboard/CRUD/CreateUser', 'Crud\userController@create')->name('create-user');
    Route::get('/Dashboard/CRUD/CreateDirektur', 'Crud\userController@createdirektur')->name('create-direktur');
    Route::get('/Dashboard/CRUD/CreateAdmin', 'Crud\userController@createadmin')->name('create-admin');
    Route::get('/Dashboard/CRUD/CreateAdminPelabuhan', 'Crud\userController@createadminpelabuhan')->name('create-adminpelabuhan');
    Route::post('/Dashboard/CRUD/AddAdmin', 'Crud\userController@addAdmin')->name('add-admin');
    Route::post('/Dashboard/CRUD/AddAdminPelabuhan', 'Crud\userController@addAdminPelabuhan')->name('add-adminpelabuhan');
    Route::post('/Dashboard/CRUD/AddDirektur', 'Crud\userController@addDirektur')->name('add-direktur');
    Route::post('/Dashboard/CRUD/AddUser', 'Crud\userController@addUser')->name('add-user');
    Route::post('/Dashboard/CRUD/UpdateCustomer', 'Crud\userController@updateUser')->name('update-user');
    Route::get('/Dashboard/CRUD/DeleteUser/{id}', 'Crud\userController@deleteUser')->name('delete-user');

    //Speedboat
    Route::get('/Dashboard/CRUD/SpeedboatData', 'Crud\speedboatController@view')->name('viewspeedboat');
    Route::get('/Dashboard/CRUD/CreateSpeedboat', 'Crud\speedboatController@create')->name('create-speedboat');
    Route::post('/Dashboard/CRUD/AddSpeedboat', 'Crud\speedboatController@addSpeedboat')->name('add-speedboat');
    Route::post('/Dashboard/CRUD/UpdateSpeedboat', 'Crud\speedboatController@updateSpeedboat')->name('update-speedboat');
    Route::get('/Dashboard/CRUD/DeleteSpeedboat/{id}', 'Crud\speedboatController@deleteSpeedboat')->name('delete-speedboat');

    //Kapal
    Route::get('/Dashboard/CRUD/KapalData', 'Crud\kapalController@view')->name('viewkapal');
    Route::get('/Dashboard/CRUD/CreateKapal', 'Crud\kapalController@create')->name('create-kapal');
    Route::post('/Dashboard/CRUD/AddKapal', 'Crud\kapalController@addKapal')->name('add-kapal');
    Route::post('/Dashboard/CRUD/UpdateKapal', 'Crud\kapalController@updateKapal')->name('update-kapal');
    Route::get('/Dashboard/CRUD/DeleteKapal/{id}', 'Crud\kapalController@deleteKapal')->name('delete-kapal');

    //Jadwal
    //Route::get('/Dashboard/CRUD/JadwalData/{hari}', 'Crud\jadwalController@view')->name('viewjadwal');
    //Route::get('/Dashboard/CRUD/CreateJadwal', 'Crud\jadwalController@create')->name('create-jadwal');
    //Route::post('/Dashboard/CRUD/AddJadwal', 'Crud\jadwalController@addJadwal')->name('add-jadwal');
    //Route::post('/Dashboard/CRUD/UpdateJadwal', 'Crud\jadwalController@updateJadwal')->name('update-jadwal');
    //Route::get('/Dashboard/CRUD/DeleteJadwal/{id}', 'Crud\jadwalController@deleteJadwal')->name('delete-jadwal');

    //Jadwal Kapal
    //Route::get('/Dashboard/CRUD/JadwalKapalData', 'Crud\jadwalKapalController@view')->name('masterjadwal');
    //Route::get('/Dashboard/CRUD/CreateJadwalKapal', 'Crud\jadwalKapalController@create')->name('create-jadwalkapal');
    //Route::post('/Dashboard/CRUD/AddJadwalKapal', 'Crud\jadwalKapalController@addJadwal')->name('add-jadwalkapal');
    //Route::post('/Dashboard/CRUD/UpdateJadwalKapal', 'Crud\jadwalKapalController@updateJadwal')->name('update-jadwalkapal');
    //Route::get('/Dashboard/CRUD/DeleteJadwalKapal/{id}', 'Crud\jadwalKapalController@deleteJadwal')->name('delete-jadwalkapal');

    //Refund
    Route::get('/Dashboard/Refund','Crud\refundController@index')->name('refund-sa');
    Route::post('/ajax/persentase-refund','Crud\refundController@persentase');
    Route::get('/Dashboard/Refund/Terima/{id}','Crud\refundController@terima');
    Route::get('/Dashboard/Refund/Tolak/{id}','Crud\refundController@tolak');

    //Manajemen Jadwal
    Route::get('/Dashboard/JadwalData/{hari}', 'Crud\jadwalController@view')->name('viewjadwal-sa');
    Route::get('/Dashboard/MasterData/', 'Crud\jadwalController@viewMaster')->name('master-jadwal-sa');
    Route::get('/Dashboard/CreateJadwal', 'Crud\jadwalController@create')->name('create-jadwal-sa');
    Route::get('/Dashboard/CreateDetailJadwal', 'Crud\jadwalController@createdetail')->name('create-detailjadwal-sa');
    Route::post('/Dashboard/AddJadwal/Detail', 'Crud\jadwalController@addJadwalDetail')->name('add-jadwal-detail-sa');
    Route::post('/Dashboard/AddJadwal', 'Crud\jadwalController@addJadwal')->name('add-jadwal-sa');
    Route::post('/Dashboard/UpdateJadwal', 'Crud\jadwalController@updateJadwal')->name('update-jadwal-sa');
    Route::get('/Dashboard/DeleteJadwal/{id}', 'Crud\jadwalController@deleteJadwal')->name('delete-jadwal-sa');

    //Pelabuhan
    Route::get('/Dashboard/CRUD/PelabuhanData', 'Crud\pelabuhanController@view')->name('viewpelabuhan');
    Route::get('/Dashboard/CRUD/CreatePelabuhan', 'Crud\pelabuhanController@create')->name('create-pelabuhan');
    Route::post('/Dashboard/CRUD/AddPelabuhan', 'Crud\pelabuhanController@addPelabuhan')->name('add-pelabuhan');
    Route::post('/Dashboard/CRUD/UpdatePelabuhan', 'Crud\pelabuhanController@updatePelabuhan')->name('update-pelabuhan');
    Route::get('/Dashboard/CRUD/DeletePelabuhan/{id}', 'Crud\pelabuhanController@deletePelabuhan')->name('delete-pelabuhan');

    //Dermaga
    Route::get('/Dashboard/CRUD/DermagaData', 'Crud\dermagaController@view')->name('viewdermaga');
    Route::get('/Dashboard/CRUD/CreateDermaga', 'Crud\dermagaController@create')->name('create-dermaga');
    Route::post('/Dashboard/CRUD/AddDermaga', 'Crud\dermagaController@addDermaga')->name('add-dermaga');
    Route::post('/Dashboard/CRUD/UpdateDermaga', 'Crud\dermagaController@updateDermaga')->name('update-dermaga');
    Route::get('/Dashboard/CRUD/DeleteDermaga/{id}', 'Crud\dermagaController@deleteDermaga')->name('delete-dermaga');

    //Reward Speedboat
    Route::get('/Dashboard/CRUD/RewardSpeedboatData', 'Crud\rewardSpeedboatController@view')->name('viewreward');
    Route::get('/Dashboard/CRUD/CreateRewardSpeedboatData', 'Crud\rewardSpeedboatController@create')->name('create-reward');
    Route::post('/Dashboard/CRUD/AddRewardSpeedboat', 'Crud\rewardSpeedboatController@addRewardSpeedboat')->name('add-rewardspeedboat');
    Route::post('/Dashboard/CRUD/UpdateRewardSpeedboat', 'Crud\rewardSpeedboatController@updateRewardSpeedboat')->name('update-rewardspeedboat');
    Route::get('/Dashboard/CRUD/DeleteRewardSpeedboat/{id}', 'Crud\rewardSpeedboatController@deleteRewardSpeedboat')->name('delete-rewardspeedboat');

    //Card
    Route::get('/Dashboard/CRUD/Card', 'Crud\cardController@view')->name('viewcard');
    Route::get('/Dashboard/CRUD/CreateCard', 'Crud\cardController@create')->name('create-card');
    Route::post('/Dashboard/CRUD/AddCard', 'Crud\cardController@addCard')->name('add-card');
    Route::post('/Dashboard/CRUD/UpdateCard', 'Crud\cardController@updateCard')->name('update-card');
    Route::get('/Dashboard/CRUD/DeleteCard/{id}', 'Crud\cardController@deleteCard')->name('delete-card');

    //Approve Pembelian
    Route::get('/Dashboard/CRUD/Pembelian', 'pembelianController@index')->name('viewpembelian');
    Route::get('/Dashboard/CRUD/DetailPembelian/{id}', 'pembelianController@detail')->name('detail-pembelian');
    Route::get('/Dashboard/CRUD/DetailPembelian/Approve/{id}', 'pembelianController@approve')->name('approve-pembelian');
    Route::get('/Dashboard/CRUD/DetailPembelian/Reject/{id}', 'pembelianController@reject')->name('reject-pembelian');

    //Golongan
    Route::get('/Dashboard/CRUD/Golongan', 'Crud\golonganController@view')->name('viewgolongan');
    Route::get('/Dashboard/CRUD/CreateGolongan', 'Crud\golonganController@create')->name('create-golongan');
    Route::post('/Dashboard/CRUD/AddGolongan', 'Crud\golonganController@addGolongan')->name('add-golongan');
    Route::post('/Dashboard/CRUD/UpdateGolongan', 'Crud\golonganController@updateGolongan')->name('update-golongan');
    Route::get('/Dashboard/CRUD/DeleteGolongan/{id}', 'Crud\golonganController@deleteGolongan')->name('delete-golongan');

});
//ROUTE SUPER ADMIN END-----------------------------------------------------------------------------------



Route::group(['middleware' => 'Admin'], function () {

//Admin
    Route::get('/Admin/Home', 'Admin\adminSpeedboat@index')->name('adminSpeedboatHome');
    Route::get('/Jadwal', 'crudAdmin\jadwalController@index')->name('jadwalSpeedboat');
    Route::get('/BeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@index')->name('beritaPelabuhan');
    Route::get('/RewardSpeedboat', 'crudAdmin\rewardController@index')->name('rewardSpeedboatView');
    Route::get('/Review', 'crudAdmin\reviewController@index')->name('reviewSpeedboat');
    Route::get('/Transaksi', 'crudAdmin\transaksiPembelianController@index')->name('transaksiPembelian');

//CRUD Admin
//CRUD Berita Speedboat
    Route::get('/BeritaSpeedboat', 'crudAdmin\beritaSpeedboatController@index')->name('beritaSpeedboat');
    Route::get('/Beritas/CreateBerita', 'crudAdmin\beritaSpeedboatController@create')->name('createBeritaSpeedboat');
    Route::post('/Beritas/AddBerita', 'crudAdmin\beritaSpeedboatController@addBerita')->name('addBerita');
    Route::get('/BeritaSpeedboat/{id}/edit', 'crudAdmin\beritaSpeedboatController@editBerita');
    route::post('/Beritas/{id}/update', 'crudAdmin\beritaSpeedboatController@updateBeritas')->name('updateBerita');
    route::delete('/Beritas/{id}/delete', 'crudAdmin\beritaSpeedboatController@deleteBeritas')->name('deleteBerita');

//CRUD Berita Pelabuhan
    Route::get('/BeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@index')->name('beritaPelabuhan');
    Route::get('/Berita/CreateBeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@create')->name('createBeritaPelabuhan');
    Route::post('/Berita/AddBeritaPelabuhan', 'crudAdmin\beritaPelabuhanController@addBerita')->name('addBeritaPelabuhan');
    Route::get('/BeritaPelabuhan/{id}/edit', 'crudAdmin\beritaPelabuhanController@editBerita');
    route::post('/Berita/{id}/update', 'crudAdmin\beritaPelabuhanController@updateBerita')->name('updateBeritaPelabuhan');
    route::delete('/Berita/{id}/delete', 'crudAdmin\beritaPelabuhanController@deleteBerita')->name('deleteBeritaPelabuhan');

//CRUD Jadwal
    Route::get('/Jadwal', 'crudAdmin\jadwalController@index')->name('jadwalSpeedboat');
    Route::get('/Jadwal/CreateJadwal', 'crudAdmin\jadwalController@create')->name('createJadwal');
    Route::post('/Jadwal/AddJadwal', 'crudAdmin\jadwalController@addJadwal')->name('addJadwal');
    route::post('/Jadwal/update', 'crudAdmin\jadwalController@editJadwal')->name('editJadwal');
    route::delete('/Jadwal/delete/{id}', 'crudAdmin\jadwalController@deleteJadwalSpeedboat')->name('deleteJadwal');

//CRUD Speedboat
    Route::get('/ProfileKapal', 'crudAdmin\profileSpeedboatController@profile')->name('kapalProfileAdmin');
    Route::get('/ProfileKapal/CreateProfile', 'crudAdmin\profileSpeedboatController@createSpeedboat')->name('createSpeedboats');
    Route::post('/ProfileKapal/AddProfile', 'crudAdmin\profileSpeedboatController@addSpeedboat')->name('addSpeedboat');
    Route::get('/ProfileKapal/{id}/edit', 'crudAdmin\profileSpeedboatController@editSpeedboat');
    route::post('/ProfileKapal/update', 'crudAdmin\profileSpeedboatController@updateSpeedboat')->name('updateKapalAdmin');
    route::delete('/ProfileKapal/{id}/delete', 'crudAdmin\profileSpeedboatController@deleteSpeedboat')->name('deleteSpeedboatAdmin');

//CRUD Reward Speedboat
    Route::get('/RewardSpeedboat', 'crudAdmin\rewardController@index')->name('rewardSpeedboatView');
    Route::get('/RewardSpeedboat/CreateRewardSpeedboat', 'crudAdmin\rewardController@create')->name('createRewardSpeedboat');
    Route::post('/RewardSpeedboat/AddRewardSpeedboat', 'crudAdmin\rewardController@addReward')->name('addRewardSpeedboat');
    Route::post('/RewardSpeedboat/UpdateRewardSpeedboat', 'crudAdmin\rewardController@updateReward')->name('updateRewardSpeedboat');
    Route::get('/RewardSpeedboat/DeleteRewardSpeedboat/{id}', 'crudAdmin\rewardController@deleteReward')->name('deleteRewardSpeedboat');

//Transaksi Pembelian
    Route::get('Transaksi', 'crudAdmin\transaksiPembelianController@index')->name('transaksiPembelian');
    Route::get('/DetailTransaksi/{id}', 'crudAdmin\transaksiPembelianController@detail')->name('detailTransaksi');
    Route::get('/DetailTransaksi/Approve/{id}', 'crudAdmin\transaksiPembelianController@approve')->name('approveTransaksi');
    Route::get('/DetailTransaksi/Reject/{id}', 'crudAdmin\transaksiPembelianController@reject')->name('rejectTransaksi');

//Pembelian
//Route::get('/RewardSpeedboat', 'crudAdmin\rewardController@index')->name('rewardSpeedboatView');

    //Route::post('/beli', 'pembelianController@beli')->name('testBeli');

    Route::get('/Golongan/Kapal/{id}','crudAdmin\golonganController@index')->name('golongan-kapal-a');
    Route::get('/Golongan/Create/Kapal/{id}','crudAdmin\golonganController@create')->name('golongan-create-kapal-a');
    Route::post('/Golongan/Create/Post','crudAdmin\golonganController@post')->name('post-detail-golongan-kapal');
    Route::post('/Golongan/Update/Post','crudAdmin\golonganController@update')->name('update-detail-golongan-kapal');
    Route::get('/Golongan/Delete/{id}','crudAdmin\golonganController@delete')->name('delete-detail-golongan');
});

//ROUTE ADMIN END-----------------------------------------------------------------------------------

Route::group(['middleware' => 'Direktur'], function () {
//DIREKTUR
    Route::get('/Direktur/Home', 'Admin\direkturController@index')->name('direkturHome');
	Route::get('/Direktur/Review', 'crudDirektur\reviewDirekturController@index')->name('reviewKapal');

//CRUD Jadwal
    Route::get('/Direktur/Jadwal', 'crudDirektur\jadwalDirekturController@index')->name('jadwalDirektur');
    Route::get('/Direktur/Jadwal/CreateJadwal', 'crudDirektur\jadwalDirekturController@create')->name('createJadwalDirektur');
    Route::post('/Direktur/Jadwal/AddJadwal', 'crudDirektur\jadwalDirekturController@addJadwal')->name('addJadwalDirektur');
    route::post('/Direktur/Jadwal/update', 'crudDirektur\jadwalDirekturController@editJadwal')->name('editJadwalDirektur');
    route::delete('/Direktur/Jadwal/delete/{id}', 'crudDirektur\jadwalDirekturController@deleteJadwal')->name('deleteJadwalDirektur');

//CRUD Kapal
    Route::get('/Direktur/Kapal', 'crudDirektur\kapalDirekturController@profile')->name('kapalProfile');
    Route::get('/Direktur/Kapal/CreateProfile', 'crudDirektur\kapalDirekturController@formKapal')->name('formKapal');
    Route::post('/Direktur/Kapal/AddProfile', 'crudDirektur\kapalDirekturController@createKapal')->name('createKapal');
    Route::get('/Direktur/Kapal/{id}/edit', 'crudDirektur\kapalDirekturController@editKapal');
    route::post('/Direktur/Kapal/update', 'crudDirektur\kapalDirekturController@updateKapal')->name('updateKapal');
    route::delete('/Direktur/Kapal/{id}/delete', 'crudDirektur\kapalDirekturController@deleteKapal')->name('deleteKapal');

    Route::get('/Direktur/Kapal/ListAdmin/{id}', 'crudDirektur\kapalDirekturController@viewAdmin')->name('listAdmin');
    route::post('/Direktur/Kapal/updateAdmin', 'crudDirektur\kapalDirekturController@updateAdmin')->name('updateAdmin');
    route::delete('/Direktur/Kapal/{id}/deleteAdmin', 'crudDirektur\kapalDirekturController@deleteAdmin')->name('deleteAdmin');
    Route::post('/Direktur/Kapal/AddAdmin', 'crudDirektur\kapalDirekturController@createAdmin')->name('createAdmin');

//Report
	Route::get('/Direktur/Report', 'crudDirektur\reportController@index')->name('reportKapal');
	Route::post('/Direktur/Report/Transaksi/Search', 'crudDirektur\reportController@fetch_data')->name('reportTransaksiSearch');
	Route::get('/Direktur/Report/Cetak', 'crudDirektur\reportController@cetakPDF')->name('reportCetak');

//Transaksi
	Route::get('/Direktur/Transaksi', 'crudDirektur\transaksiPembelianController@index')->name('transaksiPembelianDirektur');
	Route::get('/Direktur/DetailTransaksi/{id}', 'crudDirektur\transaksiPembelianController@detail')->name('detailTransaksiDirektur');

});

//ROUTE ADMIN END-----------------------------------------------------------------------------------

//ROUTE ADMIN PELABUHAN START-----------------------------------------------------------------------------------
Route::group(['middleware' => 'PAdmin'], function () {

//ADMIN PELABUHAN
    Route::get('/AdminPelabuhan/Home', 'Admin\adminPelabuhanController@index')->name('adminPelabuhanHome');

    //Pelabuhan
    Route::get('/AdminPelabuhan/Pelabuhan/View', 'PAdmin\pelabuhanController@view')->name('pelabuhan-view');
    Route::get('/AdminPelabuhan/Pelabuhan/CreatePelabuhan', 'PAdmin\pelabuhanController@createpelabuhan')->name('pelabuhan-create');
    Route::post('/AdminPelabuhan/Pelabuhan/AddPelabuhan', 'PAdmin\pelabuhanController@addPelabuhan')->name('pelabuhan-add');
    Route::post('/AdminPelabuhan/Pelabuhan/UpdatePelabuhan', 'PAdmin\pelabuhanController@updatePelabuhan')->name('pelabuhan-update');
    Route::get('/AdminPelabuhan/Pelabuhan/DeletePelabuhan/{id}', 'PAdmin\pelabuhanController@deletePelabuhan')->name('pelabuhan-delete');
    Route::get('/AdminPelabuhan/Pelabuhan/Kapal/{id}', 'PAdmin\pelabuhanController@viewKapal')->name('pelabuhan-kapal');

    //Verif Kapal
    Route::get('/AdminPelabuhan/VerifikasiKapal/View', 'PAdmin\verifKapalController@index')->name('verifkapal-view');
    Route::get('/AdminPelabuhan/VerifikasiKapal/DetailVerifikasiKapal/{id}', 'PAdmin\verifKapalController@detail')->name('verifkapal-detail');
    Route::get('/AdminPelabuhan/VerifikasiKapal/DetailVerifikasiKapal/Approve/{id}', 'PAdmin\verifKapalController@approve')->name('verifkapal-approve');
    Route::get('/AdminPelabuhan/VerifikasiKapal/DetailVerifikasiKapal/Reject/{id}', 'PAdmin\verifKapalController@reject')->name('verifkapal-reject');

    //Berita Pelabuhan
    Route::get('/AdminPelabuhan/BeritaPelabuhan', 'PAdmin\beritaController@indexPelabuhan')->name('berita-pelabuhan-pa');
    Route::get('/AdminPelabuhan/BeritaPelabuhan/Create', 'PAdmin\beritaController@createBeritaPelabuhan')->name('create-beritaPelabuhan-pa');
    Route::Post('/AdminPelabuhan/BeritaPelabuhan/AddBerita', 'PAdmin\beritaController@addBeritaPelabuhan')->name('add-beritaPelabuhan-pa');
    Route::get('/AdminPelabuhan/BeritaPelabuhan/{id}/update','PAdmin\beritaController@editFormBeritaPelabuhan')->name('form-updateBeritaPelabuhan-pa');
    Route::Post('/AdminPelabuhan/BeritaPelabuhan/update/post', 'PAdmin\beritaController@updateBeritaPelabuhan')->name('update-beritaPelabuhan-pa');
    route::delete('/AdminPelabuhan/BeritaPelabuhan/{id}/delete', 'PAdmin\beritaController@deleteBeritaPelabuhan')->name('delete-BeritaPelabuhan-pa');

    //Manajemen Jadwal
    Route::get('/AdminPelabuhan/JadwalData/{hari}', 'PAdmin\jadwalController@view')->name('viewjadwal');
    Route::get('/AdminPelabuhan/JadwalData/', 'PAdmin\jadwalController@viewMaster')->name('master-jadwal');
    Route::get('/AdminPelabuhan/CreateJadwal', 'PAdmin\jadwalController@create')->name('create-jadwal');
    Route::get('/AdminPelabuhan/CreateDetailJadwal', 'PAdmin\jadwalController@createdetail')->name('create-detailjadwal');
    Route::post('/AdminPelabuhan/AddJadwal', 'PAdmin\jadwalController@addJadwal')->name('add-jadwal');
    Route::post('/AdminPelabuhan/AddJadwal/Detail','PAdmin\jadwalController@addJadwalDetail')->name('add-jadwal-detail');
    Route::post('/AdminPelabuhan/UpdateJadwal', 'PAdmin\jadwalController@updateJadwal')->name('update-jadwal');
    Route::get('/AdminPelabuhan/DeleteJadwal/{id}', 'PAdmin\jadwalController@deleteJadwal')->name('delete-jadwal');

    //Pembelian
    Route::get('/Pembelian/CreatePembelian', 'pembelianController@create')->name('createPembelian');
    Route::post('/beli', 'pembelianController@beli')->name('testBeli');

    //Transaksi
    Route::get('/AdminPelabuhan/Transaksi/Detail','PAdmin\TransaksiController@index')->name('transaksi-pa');
    Route::get('/AdminPelabuhan/DetailTransaksi/{id}', 'PAdmin\TransaksiController@detail')->name('detail-transaksi-pa');

    //Golongan
    Route::get('/AdminPelabuhan/Golongan','PAdmin\golonganController@index')->name('golongan-pa');
    Route::get('/AdminPelabuhan/Golongan/Create','PAdmin\golonganController@create')->name('golongan-create-pa');
    Route::post('/AdminPelabuhan/Golongan/Create/Post','PAdmin\golonganController@addGolongan')->name('golongan-add-pa');
    Route::post('/AdminPelabuhan/Golongan/Update/Post','PAdmin\golonganController@updateGolongan')->name('golongan-update-pa');
    Route::get('/AdminPelabuhan/Golongan/Delete/{id}','PAdmin\golonganController@deleteGolongan')->name('golongan-delete-pa');

    //Dermaga
    Route::get('/AdminPelabuhan/Dermaga','PAdmin\dermagaController@index')->name('dermaga-pa');
    Route::get('/AdminPelabuhan/Dermaga/Create','PAdmin\dermagaController@create')->name('dermaga-create-pa');
    Route::post('/AdminPelabuhan/Dermaga/Create/Post','PAdmin\dermagaController@addDermaga')->name('dermaga-add-pa');
    Route::post('/AdminPelabuhan/Dermaga/Update/Post','PAdmin\dermagaController@updateDermaga')->name('dermaga-update-pa');
    Route::get('/AdminPelabuhan/Dermaga/Delete/{id}','PAdmin\dermagaController@deleteDermaga')->name('dermaga-delete-pa');


});


Auth::routes();


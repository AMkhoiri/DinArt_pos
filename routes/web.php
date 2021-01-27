<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('/thermal-struk', function () {
    return view('printer.thermal-struk');
});

Route::get('/loginn', function () {
    return view('auth.index');
});

// Route::get('/admin/databarang', function () {
//     return view('admin.databarang');
// });

Route::middleware(['auth','admin'])->group(function () {

	Route::get('/admin', 'adminController@index')->name('admin-dashboard');

	Route::get('/admin/databarang', 'adminController@databarang')->name('admin-databarang');
	Route::post('/admin/databarang/tambah', 'adminController@tambahBarang')->name('admin-tambahbarang');
	Route::get('/admin/databarang/{id}/detail', 'adminController@detailBarang')->name('admin-detailbarang');
	Route::get('/admin/databarang/{id}/edit', 'adminController@editBarang')->name('admin-editbarang');
	Route::put('/admin/databarang/{id}/update', 'adminController@updateBarang')->name('admin-updatebarang');
	Route::get('/admin/databarang/{id}/change', 'adminController@changeBarang')->name('admin-changestatusbarang');
	Route::get('/admin/databarang/{id}/delete', 'adminController@deleteBarang')->name('admin-deletebarang');


	Route::get('/admin/datapegawai', 'adminController@dataPegawai')->name('admin-datapegawai');
	Route::post('/admin/datapegawai/tambah', 'adminController@tambahPegawai')->name('admin-tambahpegawai');
	Route::get('/admin/datapegawai/{id}/edit', 'adminController@editPegawai')->name('admin-editpegawai');
	Route::put('/admin/datapegawai/{id}/update', 'adminController@updatePegawai')->name('admin-updatepegawai');
	Route::get('/admin/datapegawai/{id}/delete', 'adminController@deletePegawai')->name('admin-deletepegawai');
	Route::get('/admin/datapegawai/{id}/register', 'adminController@registerformPegawai')->name('admin-form-register-pegawai');
	Route::post('/admin/datapegawai/register/add', 'adminController@registerPegawai')->name('admin-register-pegawai');


	Route::get('/admin/datauser', 'adminController@dataUser')->name('admin-datauser');
	Route::get('/admin/datauser/{id}/delete', 'adminController@deleteUser')->name('admin-deleteuser');
	Route::get('/admin/datauser/{id}/edit', 'adminController@formEditUser')->name('admin-user-edit');
	Route::post('/admin/datauser/update', 'adminController@updateUser')->name('admin-user-update');


	Route::get('/admin/databox', 'adminController@dataBox')->name('admin-databox');
	Route::post('/admin/databox/tambah', 'adminController@tambahBox')->name('admin-tambahbox');
	Route::get('/admin/databox/{id}/edit', 'adminController@editBox')->name('admin-editbox');
	Route::put('/admin/databox/{id}/update', 'adminController@updateBox')->name('admin-updatebox');
	Route::get('/admin/databox/{id}/delete', 'adminController@deleteBox')->name('admin-deletebox');


	Route::get('/admin/transaksi', 'adminController@dataTransaksi')->name('admin-transaksi');
	Route::get('/admin/transaksi/{id}/detail', 'adminController@detailTransaksi')->name('admin-detailtransaksi');

	Route::get('/admin/transaksi/create', 'adminController@buatTransaksi')->name('admin-newtransaksi');
	Route::post('/admin/transaksi/{id}/additem', 'adminController@addItem')->name('admin-additem');
	Route::delete('/admin/transaksi/item/{id}/delete', 'adminController@deleteItem')->name('admin-deleteitem');
	Route::get('/admin/transaksi/item/{id}/catatan', 'adminController@showCatatanItem')->name('admin-catatan-item');
	Route::post('/admin/transaksi/{id}/submit', 'adminController@submitTransaksi')->name('admin-continue-payment');

	Route::post('/admin/transaksi/{id}/pembayaran/submit', 'adminController@submitPembayaran')->name('admin-submit-pembayaran');
	Route::get('/admin/transaksi/{id}/bayar/', 'adminController@transaksiBayar')->name('admin-transaksi-bayar');
	Route::get('/admin/transaksi/{id}/form-produksi/', 'adminController@tampilFormProduksi')->name('admin-transaksi-form-produksi');
	Route::post('/admin/transaksi/form-produksi/{id}/check', 'adminController@checkItemProduksi')->name('admin-transaksi-check-item-produksi');
	Route::get('/admin/transaksi/{id}/submit-produksi/', 'adminController@submitProduksi')->name('admin-transaksi-submit-produksi');
	Route::get('/admin/transaksi/{id}/submit-produksi/all', 'adminController@submitAllProduksi')->name('admin-transaksi-submit-all-produksi');
	Route::get('/admin/transaksi/{id}/submit-produksi/skip', 'adminController@skipProduksi')->name('admin-transaksi-skip-produksi');
	Route::get('/admin/transaksi/{id}/done', 'adminController@selesaiTransaksi')->name('admin-transaksi-selesai');

	Route::get('/admin/transaksi/{id}/cetak', 'adminController@cetakStrukTransaksi')->name('admin-transaksi-cetak');
	Route::get('/admin/transaksi/{id}/cetak/thermal', 'adminController@cetakStrukTransaksiThermal')->name('admin-transaksi-cetak-thermal');
	Route::get('/admin/transaksi/laporan', 'adminController@laporkanTransaksi')->name('admin-transaksi-laporan');
	Route::get('/admin/transaksi/{id}/cancel', 'adminController@batalkanTransaksi')->name('admin-transaksi-cancel');


	Route::get('/admin/produksi', 'adminController@dataProduksi')->name('admin-produksi');
	Route::get('/admin/produksi/{id}/proses/form', 'adminController@formProsesProduksi')->name('admin-produksi-form');
	Route::post('/admin/produksi/proses/{id}/check', 'adminController@checkItemProsesProduksi')->name('admin-produksi-check-item');
	Route::get('/admin/produksi/{id}/save', 'adminController@saveUpdateProduksi')->name('admin-produksi-save');
	Route::get('/admin/produksi/{id}/kirim', 'adminController@kirimProduksi')->name('admin-produksi-kirim');


	Route::get('/admin/laporan/search-form', 'adminController@laporan')->name('admin-laporan-form');
	Route::post('/admin/laporan/search-data', 'adminController@cariLaporan')->name('admin-laporan-search-data');
	Route::get('/admin/laporan/{id}/detail', 'adminController@detailLaporan')->name('admin-detaillaporan');


});









Route::middleware(['auth','cs'])->group(function () {

	Route::get('/cs', 'csController@dataTransaksi')->name('cs');
	Route::get('/cs/transaksi', 'csController@dataTransaksi')->name('cs-transaksi');
	Route::get('/cs/transaksi/{id}/detail', 'csController@detailTransaksi')->name('cs-detailtransaksi');

	Route::get('/cs/transaksi/create', 'csController@buatTransaksi')->name('cs-newtransaksi');
	Route::post('/cs/transaksi/{id}/additem', 'csController@addItem')->name('cs-additem');
	Route::delete('/cs/transaksi/item/{id}/delete', 'csController@deleteItem')->name('cs-deleteitem');
	Route::get('/cs/transaksi/item/{id}/catatan', 'csController@showCatatanItem')->name('cs-catatan-item');
	Route::post('/cs/transaksi/{id}/submit', 'csController@submitTransaksi')->name('cs-continue-payment');

	Route::post('/cs/transaksi/{id}/pembayaran/submit', 'csController@submitPembayaran')->name('cs-submit-pembayaran');
	Route::get('/cs/transaksi/{id}/bayar/', 'csController@transaksiBayar')->name('cs-transaksi-bayar');
	Route::get('/cs/transaksi/{id}/form-produksi/', 'csController@tampilFormProduksi')->name('cs-transaksi-form-produksi');
	Route::post('/cs/transaksi/form-produksi/{id}/check', 'csController@checkItemProduksi')->name('cs-transaksi-check-item-produksi');
	Route::get('/cs/transaksi/{id}/submit-produksi/', 'csController@submitProduksi')->name('cs-transaksi-submit-produksi');
	Route::get('/cs/transaksi/{id}/submit-produksi/all', 'csController@submitAllProduksi')->name('cs-transaksi-submit-all-produksi');
	Route::get('/cs/transaksi/{id}/submit-produksi/skip', 'csController@skipProduksi')->name('cs-transaksi-skip-produksi');
	Route::get('/cs/transaksi/{id}/done', 'csController@selesaiTransaksi')->name('cs-transaksi-selesai');

	Route::get('/cs/transaksi/{id}/cetak', 'csController@cetakStrukTransaksi')->name('cs-transaksi-cetak');
	Route::get('/cs/transaksi/{id}/cetak/thermal', 'csController@cetakStrukTransaksiThermal')->name('cs-transaksi-cetak-thermal');
	Route::get('/cs/transaksi/laporan', 'csController@laporkanTransaksi')->name('cs-transaksi-laporan'); 
	Route::get('/cs/transaksi/{id}/cancel', 'csController@batalkanTransaksi')->name('cs-transaksi-cancel');

	Route::get('/cs/databarang', 'csController@databarang')->name('cs-databarang');
	Route::get('/cs/databarang/{id}/detail', 'csController@detailBarang')->name('cs-detailbarang');
	

});







Route::middleware(['auth','produksi'])->group(function () {

	Route::get('/produksi', 'produksiController@dataProduksi')->name('produksi');
	Route::get('/produksi/produksi/{id}/proses/form', 'produksiController@formProsesProduksi')->name('produksi-produksi-form');
	Route::post('/produksi/produksi/proses/{id}/check', 'produksiController@checkItemProsesProduksi')->name('produksi-produksi-check-item');
	Route::get('/produksi/produksi/{id}/save', 'produksiController@saveUpdateProduksi')->name('produksi-produksi-save');
	Route::get('/produksi/produksi/{id}/kirim', 'produksiController@kirimProduksi')->name('produksi-produksi-kirim');  

	Route::get('/produksi/databarang', 'produksiController@databarang')->name('produksi-databarang');
	Route::get('/produksi/databarang/{id}/detail', 'produksiController@detailBarang')->name('produksi-detailbarang'); 

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('tampilan_awal');
});
// Auth::routes();

Route::get('/login', 'UserController@ShowLogin')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

// Mahasiswa
Route::get('/data-mhs', 'MahasiswaController@DataMhs')->name('data.mhs');
Route::get('/form-tambah-data-mhs', 'MahasiswaController@FormTambahDataMhs')->name('form.tambah.data.mhs');
Route::post('/proses-tambah-mhs', 'MahasiswaController@ProsesTambahMhs')->name('proses.tambah.mhs');
Route::get('/form-edit-data-mhs/{npm}', 'MahasiswaController@FormEditDataMhs')->name('form.edit.data.mhs');
Route::post('/proses-edit-mhs', 'MahasiswaController@ProsesEditMhs')->name('proses.edit.mhs');
Route::post('/proses-hapus-mhs', 'MahasiswaController@ProsesHapusMhs')->name('proses.hapus.mhs');

//detail mhs 
Route::get('/form-detail-data-mhs/{npm}', 'MahasiswaController@FormDetailDataMhs')->name('form.detail.data.mhs');
Route::post('/proses-set-pendaftaran-mhs', 'MahasiswaController@ProsesPendaftaranMhs')->name('proses.set.pendaftrana.mhs');
Route::post('/proses-set-pembayaran-mhs', 'MahasiswaController@ProsesPembayaranMhs')->name('proses.set.pembayaran.mhs');
Route::post('/proses-set-verifikasi-mhs', 'MahasiswaController@ProsesVerifikasiMhs')->name('proses.set.verifikasi.mhs');

// import & export mahasiswa
Route::post('/import_mhs', 'MahasiswaController@ImportMhs')->name('import.mhs');
Route::get('/export_mhs', 'MahasiswaController@ExportMhs')->name('export.mhs');

Route::get('/add-form-user', 'UserController@AddUser');
Route::post('/proses-add-user', 'UserController@ProsesAddUser')->name('proses.add.user');

// zonasi sekolah
Route::get('/data-zonasi', 'ZonasiController@DataZonasi')->name('data.zonasi');
Route::get('/zonasi-sekolah', 'SekolahController@Zonasi')->name('zonasi');
Route::post('/proses-add-zonasi', 'SekolahController@ProsesAddZonasi')->name('proses.add.zonasi');

// pengumuman
Route::get('/pengumuman', 'SekolahController@Pengumuman')->name('pengumuman');
Route::post('/ajax/pengumuman', 'SekolahController@PengumumanCari');
Route::get('/pengumuman_pdf/{id}', 'SekolahController@PengumumanPdf');

// user role
Route::get('/ajax/prodi', 'UserController@Prodi');
Route::get('/ajax/mitra-sekolah', 'SekolahController@MitraSekolah');
Route::get('/ajax/kepsek', 'UserController@Kepsek');
Route::post('/ajax/jenis_plp', 'SekolahController@Jenis_plp');

// add dpl zonasi
Route::post('/ajax/add-dpl-1/{npm}', 'ZonasiController@AddDpl_1');
Route::post('/ajax/add-guru-pamong-1/{npm}', 'ZonasiController@AddGuruPamong_1');

Route::post('/ajax/add-dpl-2/{npm}', 'ZonasiController@AddDpl_2');
Route::post('/ajax/add-guru-pamong-2/{npm}', 'ZonasiController@AddGuruPamong_2');

Route::post('/hapus-data-zonasi', 'ZonasiController@HaspusDataZonasi')->name('hapus.data.zonasi');

// DPL
Route::get('/data-dpl', 'DPLController@DataDpl')->name('data.dpl');
Route::get('/form-data-dpl', 'DPLController@FormDataDpl')->name('form.data.dpl');
Route::post('/proses-simpan-dpl', 'DPLController@ProsesSimpanDpl')->name('proses.simpan.dpl');
Route::get('/form-edit-dpl/{id_dpl}', 'DPLController@FormEditDpl')->name('form.edit.dpl');
Route::post('/proses-edit-dpl/{id_dpl}', 'DPLController@ProsesEditDpl')->name('proses.edit.dpl');
Route::post('/hapus-dpl', 'DPLController@HapusDpl')->name('hapus.dpl');

// Mitra Sekolah
Route::get('/data-sekolah', 'SekolahController@DataSekolah')->name('data.sekolah');
Route::get('/form-tambah-data-sekolah', 'SekolahController@FormTambahDataSekolah')->name('form.tambah.data.sekolah');
Route::post('/proses-simpan-sekolah', 'SekolahController@ProsesSimpanSekolah')->name('proses.simpan.sekolah');
Route::get('/form-edit-data-sekolah/{id_sekolah}', 'SekolahController@FormEditDataSekolah')->name('form.edit.data.sekolah');
Route::post('/proses-edit-sekolah/{id_sekolah}', 'SekolahController@ProsesEditSekolah')->name('proses.edit.sekolah');
Route::post('/hapus-sekolah', 'SekolahController@HapusSekolah')->name('hapus.sekolah');

// guru pamong
Route::get('/data-guru-pamong', 'SekolahController@DataGuruPamong')->name('data.guru.pamong');
Route::get('/form-add-guru-pamong', 'SekolahController@FormAddGuruPamong')->name('form.add.guru.pamong');
Route::post('/proses-simpan-guru-pamong', 'SekolahController@ProsesSimpanGuruPamong')->name('proses.simpan.guru.pamong');
Route::get('/form-edit-guru-pamong/{id}', 'SekolahController@FormEditGuruPamong')->name('form.edit.guru.pamong');
Route::post('/hapus-guru-pamong', 'SekolahController@HapusGuruPamong')->name('hapus.guru.pamong');

// penilaian
Route::get('/data-penilaian', 'PenilaianController@DataPenilaian')->name('data.penilaian');
Route::post('/simpan-penilaian', 'PenilaianController@SimpanPenilaian')->name('simpan.penilaian');
Route::post('/json/get-mhs-penilaian', 'PenilaianController@GetMhsPenilaian');

// set penilaian plp 1
Route::get('/set-nilai/{id}', 'PenilaianController@SetNilai')->name('set.nilai');
Route::post('/proses_simpan_penilaian_p1', 'PenilaianController@SimpantNilaiP1')->name('proses.simpan.penilaian.p1');
Route::get('/dateail-penilaian-p1/{id}', 'PenilaianController@DetailPenilaianP1')->name('detail.penilaian.p1');

// edit penilaian plp 1
Route::get('/edit-nilai/{id}', 'PenilaianController@EditNilai')->name('edit.nilai');
Route::get('/detail-nilai-p2/{id}', 'PenilaianController@DetailNilaiP2')->name('detail.nilai.p2');

// set nilai plp 2
Route::get('/set-nilai-p2/{id}', 'PenilaianController@SetNilaiP2')->name('set.nilai.p2');
Route::post('/simpan-nilai-p2/{id}', 'PenilaianController@SimpanNilaiP2')->name('simpan.nilai.p2');

// edit nilai plp 2
Route::get('/edit-nilai-p2/{id}', 'PenilaianController@EditNilaiP2')->name('edit.nilai.p2');

Route::get('/ajax/get-indikator-keaktifan', 'PenilaianController@GetIndikatorKeaktifan');

// kepala sekolah
// laporan penilaian
Route::get('/laporan-penilaian', 'PenilaianController@LaporanPenilaian')->name('laporan.penilaian');
Route::get('/penilaian-kepsek', 'PenilaianController@PenilaianKepsek')->name('penilaian.kepsek');
Route::post('/simpan-nilai-kepsek', 'PenilaianController@SimpanNilaiKepsek')->name('simpan.nilai.kepsek');

// DPL Role
Route::get('/penilaian-dpl-p1', 'DPLController@PenilaianP1')->name('penilaian.dpl.p1');
// set nilai dpl p2
Route::get('/set-nilai-dpl-p2/{id}', 'DPLController@SetPenilaianP2')->name('set.nilai.dpl.p2');
Route::get('/edit-nilai-dpl-p2/{id}', 'DPLController@EditPenilaianP2')->name('edit.nilai.dpl.p2');

Route::post('/proses-edit-nilai-dpl-p2/{id}', 'DPLController@ProsesEditNilaiDplP2')->name('proses.edit.nilai.dpl.p2');

//detail nilai dpl p2
Route::get('/detail-nilai-dpl-p2/{id}', 'DPLController@DetailPenilaianP2')->name('detail.nilai.dpl.p2');

// eit nilai dpl p2
Route::post('/simpan-nilai-dpl-p2/{id}', 'DPLController@SimpanNilaiDplP2')->name('simpan.nilai.dpl.p2');

// set video terbaik
Route::get('/set-video-terbaik/{id}', 'DPLController@SetVIdeoTerbaik')->name('video.terbaik');

// laporan Penilaian Sekolah
Route::get('laporan-penilaian-sekolah', 'LaporanPenilaian@LaporanPenilaianSekolah')->name('laporan.penilaian.sekolah');

// laporan penilaian Dpl
Route::get('laporan-penilaian-dpl', 'LaporanPenilaian@LaporanPenilaianDpl')->name('laporan.penilaian.dpl');

// rekap nilai
Route::get('rekap-nilai', 'LaporanPenilaian@RekapNilai')->name('rekap.nilai');

// Indikator Penilaian Kepala Sekolah
Route::get('indikator-sekolah', 'PenilaianController@IndikatorPenilaianSekolah')->name('indikator.sekolah');
Route::post('simpan-indikator-sekolah-p1', 'PenilaianController@SimpanIndikatorSekolahP1')->name('simpan.indikator.sekolah.p1');
Route::post('hapus-indikator-n1-p1', 'PenilaianController@HapusIndikatorSekolahP1');

// indikator penilaian Dpl
Route::get('indikator-dpl', 'PenilaianController@IndikatorPenilaianDpl')->name('indikator.dpl');
Route::post('simpan-indikator-dpl', 'PenilaianController@SimpanIndikatorDpl')->name('simpan.indikator.dpl');
Route::post('hapus-indikator-n1-p1', 'PenilaianController@HapusIndikatorDpl');


//Admin User role 
Route::get('/user-role', 'UserController@UserRole')->name('user.role');
Route::post('/hapus-user', 'UserController@HapusUser')->name('hapus.user');

// ajax
Route::get('ajax/get-indikator', 'PenilaianController@GetIndikaatorAjax');
Route::get('ajax/indikator-dpl', 'PenilaianController@GetIndikaatorAjaxDpl');



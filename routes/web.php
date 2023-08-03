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
Route::get('/clear-config', function() {
    $exitCode = Artisan::call('config:clear');
    return "config clear";
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return "config cache";
});

Route::get('/buatkolom', 'ParfumController@buatkolom');
Route::get('/kirimemail', 'ParfumController@index');
Route::get('/kirimregister', 'ParfumController@register');
Route::get('/resetpassword', 'ParfumController@reset');
Route::get('/query/{origin}/{idalamat}', 'QueryController@shipping');
Route::get('/apicost', 'QueryController@cost');
Route::get('/users/export', 'UsersController@export');

//##Administrator##
//Login Admin
Route::get('/administrator', 'AuthController@login')->name('adminlogin');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');
Route::get('/resetadmin', 'AuthController@resetadmin')->name('resetadmin');
Route::post('/cekemailadmin', 'AuthController@cekemailadmin');
Route::post('/resetpassadmin', 'AuthController@resetpassadmin');
Route::get('/resetsuccessadmin', 'AuthController@resetsuccessadmin')->name('resetsuccessadmin');

Route::group(['middleware'=>['auth:user']], function(){
  Route::get('/dashboard', 'Admin\DashboardController@index');
  Route::get('/profile', 'Admin\ProfileController@index');
  Route::get('/profile/kota/{id}', 'Admin\ProfileController@kota');
  Route::get('/profile/kotabaru/{id}', 'Admin\ProfileController@kotabaru');
  Route::get('/getbody/{id}', 'Admin\Getbody@index');
  Route::post('/profile/update', 'Admin\ProfileController@update');
  Route::get('/footerimage', 'Admin\FooterimageController@index');
  Route::post('/footerimage/update', 'Admin\FooterimageController@update');
  Route::get('/hapusfooterimage', 'Admin\FooterimageController@hapusfooterimage');
  Route::get('/bannerimage', 'Admin\BannerimageController@index');
  Route::post('/bannerimage/update', 'Admin\BannerimageController@update');
  Route::get('/hapusbannerimage', 'Admin\BannerimageController@hapusbannerimage');
  Route::get('/logo', 'Admin\LogoController@index');
  Route::post('/logo/update', 'Admin\LogoController@update');
  Route::get('/hapuslogo', 'Admin\LogoController@hapuslogo');
  Route::get('/hapusfavicon', 'Admin\LogoController@hapusfavicon');
  Route::resource('/bank', 'Admin\BankController');
  Route::resource('/rekening', 'Admin\RekeningController');
  Route::get('/twitter', 'Admin\TwitterController@index');
  Route::post('/twitter/update', 'Admin\TwitterController@update');
  Route::get('/facebook', 'Admin\FacebookController@index');
  Route::post('/facebook/update', 'Admin\FacebookController@update');
  Route::get('/instagram', 'Admin\InstagramController@index');
  Route::post('/instagram/update', 'Admin\InstagramController@update');
  Route::get('/youtube', 'Admin\YoutubeController@index');
  Route::post('/youtube/update', 'Admin\YoutubeController@update');
  Route::get('/pixel', 'Admin\PixelController@index');
  Route::post('/pixel/update', 'Admin\PixelController@update');
  Route::get('/webmaster', 'Admin\WebmasterController@index');
  Route::post('/webmaster/update', 'Admin\WebmasterController@update');
  Route::get('/settingseo', 'Admin\SeoController@index');
  Route::post('/settingseo/update', 'Admin\SeoController@update');
  Route::get('/settinguser', 'Admin\SettinguserController@index');
  Route::get('/settinguser/add', 'Admin\SettinguserController@add');
  Route::post('/settinguser/insert', 'Admin\SettinguserController@insert');
  Route::get('/settinguser/edit/{id}', 'Admin\SettinguserController@edit');
  Route::post('/settinguser/update', 'Admin\SettinguserController@update');
  Route::get('/settinguser/changepass/{id}', 'Admin\SettinguserController@changepass');
  Route::post('/settinguser/updatepass', 'Admin\SettinguserController@updatepass');
  Route::get('/settinguser/delete/{id}', 'Admin\SettinguserController@delete');

  Route::resource('/modulbanner', 'Admin\ModulbannerController');
  Route::get('/bannertext', 'Admin\BannertextController@index')->name('bannertext.index');
  Route::post('/bannertext/update', 'Admin\BannertextController@update');
  Route::get('/headerproduct', 'Admin\HeaderproductController@index')->name('headerproduct.index');
  Route::post('/headercontact/update', 'Admin\HeadercontactController@update');
  Route::get('/headercontact', 'Admin\HeadercontactController@index')->name('headercontact.index');
  Route::post('/headerproduct/update', 'Admin\HeaderproductController@update');
  Route::get('/modulaboutus', 'Admin\ModulaboutusController@index')->name('modulaboutus.index');
  Route::post('/modulaboutus/update', 'Admin\ModulaboutusController@update');
  Route::resource('/modultime', 'Admin\ModultimeController');
  Route::get('/featpromo', 'Admin\FeatpromoController@index')->name('featpromo.index');
  Route::post('/featpromo/update', 'Admin\FeatpromoController@update');
  Route::resource('/modulpromo', 'Admin\ModulpromoController');
  Route::get('/featproduct', 'Admin\FeatproductController@index')->name('featproduct.index');
  Route::post('/featproduct/update', 'Admin\FeatproductController@update');

  Route::resource('/productcat', 'Admin\ProductCatController');
  Route::resource('/jenisproduk', 'Admin\JenisProdukController');
  Route::resource('/brand', 'Admin\BrandController');
  Route::resource('/product', 'Admin\ProductController');
  Route::resource('/modultestimoni', 'Admin\ModultestimoniController');
  Route::resource('/modulpage', 'Admin\ModulpageController');
  Route::resource('/modulfaq', 'Admin\ModulfaqController');
  Route::resource('/modulskill', 'Admin\ModulskillController');
  Route::resource('/modulwhy', 'Admin\ModulwhyController');
  Route::resource('/modulvideo', 'Admin\ModulvideoController');
  Route::get('/modtestimoni', 'Admin\ModtestimoniController@index')->name('modtestimoni.index');
  Route::post('/modtestimoni/update', 'Admin\ModtestimoniController@update');

  Route::get('/order/pesananbaru', 'Admin\OrderController@pesananbaru');
  Route::get('/order/responpesanan/{invoice}/{nostatuspembayaran}', 'Admin\OrderController@responpesanan');
  Route::get('/order/responbatal/{invoice}', 'Admin\OrderController@responbatal');
  Route::get('/order/statuspengiriman', 'Admin\OrderController@statuspengiriman');
  Route::get('/order/updateresi/{nostatustransaksi}/{noresi}', 'Admin\OrderController@updateresi');
  Route::get('/order/updatepengiriman/{nostatustransaksi}/{status}', 'Admin\OrderController@updatepengiriman');
  Route::get('/order/viewtrack/{noresi}', 'Admin\OrderController@viewtrack');
  Route::get('/order/daftartransaksi', 'Admin\OrderController@daftartransaksi');

  Route::get('modulkontak', 'Admin\ModulkontakController@index');
  Route::get('modulsubscribe', 'Admin\ModulsubscribeController@index');
  Route::get('modulmember', 'Admin\ModulmemberController@index');
});

//##Member##
//Member
Route::get('/login', 'LoginController@login')->name('login');
Route::get('/loginsegmen/{segmen}', 'LoginController@segmen');
Route::get('/loginhome', 'LoginController@home');
Route::post('/memberlogin', 'LoginController@postlogin');
Route::get('/memberlogout', 'LoginController@logout');
Route::get('/register', 'RegisterController@index')->name('register');
Route::get('/reset', 'RegisterController@reset')->name('reset');
Route::post('/cekemail', 'RegisterController@cekemail');
Route::post('/registerinsert', 'RegisterController@insert');
Route::post('/resetpass', 'RegisterController@resetpass');
Route::get('/registersuccess', 'RegisterController@success')->name('registersuccess');
Route::get('/resetsuccess', 'RegisterController@resetsuccess')->name('resetsuccess');

Route::group(['middleware'=>['auth:member']], function(){
  Route::get('/member/dashboard', 'Member\MemberController@index');
  Route::get('/member/paymentstatus', 'Member\MemberController@paymentstatus');
  Route::get('/member/confirmation', 'Member\MemberController@confirmation');
  Route::get('/member/transactionlist', 'Member\MemberController@transactionlist');
  Route::get('/member/profile', 'Member\MemberController@profile');
  Route::post('/member/updateprofile', 'Member\MemberController@updateprofile');
  Route::get('/member/changepass', 'Member\MemberController@changepass');
  Route::post('/cekpassword', 'Member\MemberController@cekpassword');
  Route::post('/member/updatepass', 'Member\MemberController@updatepass');
  Route::post('/member/updatebukti', 'Member\MemberController@updatebukti');
  Route::post('/member/updatepenerimaan', 'Member\MemberController@updatepenerimaan');
  Route::get('/member/viewtrack/{resi}', 'Member\MemberController@viewtrack');

  Route::resource('/alamat', 'Member\AlamatController');
  Route::get('/alamat/kota/{id}', 'Member\AlamatController@kota');
  Route::get('/alamat/getkota/{propinsi}/{idalamat}', 'Member\AlamatController@getkota');
  Route::post('/addalamat', 'Member\MemberController@addalamat');
});

//##Frontend##
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/faq', 'FaqController@index')->name('faq');
Route::get('/products', 'ProductsController@index')->name('products');
Route::get('/testimoni', 'TestimoniController@index')->name('testimoni');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contactadd', 'ContactController@insert');
Route::post('/subscribe', 'SubscribeController@insert');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cartadd', 'CartController@add');
Route::post('/updatecart', 'CartController@update');
Route::post('/deletecart', 'CartController@delete');
Route::post('/addhome', 'CartController@addhome');
Route::post('/getcart', 'CartController@getcart');
Route::post('/search', 'SearchController@index');

Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::get('/shipping/{origin}/{idalamat}', 'CheckoutController@shipping');
Route::get('/getalamat/{id}', 'CheckoutController@alamat');
Route::post('/checkoutstore', 'CheckoutController@store');
Route::post('/payment', 'CheckoutController@payment')->name('payment');
Route::get('/thankyou/{invoice}', 'CheckoutController@thankyou');
Route::get('/contactsuccess', 'ContactController@success');
Route::get('/subscribesuccess', 'SubscribeController@success');

Route::get('/invoicepdf/{pemesanan}/{invoice}', 'UsersController@exportpdf');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/page/{slug}', 'PageController@index');
Route::get('/merk/{slug}', 'MerkController@index');
Route::get('/kategori/{slug}', 'CategoryController@index');
Route::get('/{slug}', 'DetailController@index')->name('detail.index');

// Frontend ================================
// Route::get('/', function () { return view('web.pages.home');})->name('home');
// Route::get('about', function () { return view('web.pages.about');})->name('about');
// Route::get('contact', function () { return view('web.pages.contact');})->name('contact');
// Route::get('store', function () { return view('web.pages.products');})->name('products');
// Route::get('store/{id}/{title}', function () { return view('web.pages.product_detail');})->name('product_detail');
// Route::get('faq', function () { return view('web.pages.faq');})->name('faq');
//
// Route::get('cart', function () { return view('web.pages.cart');})->name('cart');
// Route::get('checkout', function () { return view('web.pages.checkout');})->name('checkout');
// Route::get('proof', function () { return view('web.pages.proof');})->name('proof');
//
// Route::get('sign-in', function () { return view('web.pages.signin');})->name('signin');
// Route::get('sign-up', function () { return view('web.pages.signup');})->name('signup');
// Route::get('member', function () { return view('web.pages.member');})->name('member');

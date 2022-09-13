<?php
use App\Models\Location;
use App\Models\Baranggay;

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
Route::get('/api/province', function () {
	$location        = strtoupper(env("LOCATION"));
    
    $provinces       = json_decode(\File::get(public_path('location/philippines/refprovince.json')));
    $sorted          = collect($provinces->records)->sortBy('provDesc');
    $province        = $sorted->where('provDesc', $location)->first();

    $data['province'] = $province;

    return response()->json($province);
})->name('api.province');

Route::get('/api/municipalities', function () {
	$location   =   strtoupper(env("LOCATION"));
    
    // PROVINCE
    $provinces  = json_decode(\File::get(public_path('location/philippines/refprovince.json')));
    $sorted     = collect($provinces->records)->sortBy('provDesc');
    $province   = $sorted->where('provDesc', $location)->first();
    
    // MUNICIPALITIES
    $cities     = collect(json_decode(\File::get(public_path('location/philippines/refcitymun.json')))->records);
    $cities     = $cities->where('provCode', $province->provCode)->flatten();

    $data       = [];

    // Get All Cities
    foreach ($cities as $key => $city) {
        $data[] = [
            'name' => $city->citymunDesc,
            'name' => $city->citymunDesc,
        ];
    }

    // Store Locations (Cities)
    if( env('LOC_INSERT', false ) ) {
        if( count(Location::all()) <= 0 ) {
            $locations = Location::insert($data);
        }
    }

    return response()->json($cities);
})->name('api.municipalities');

Route::get('/api/barangays', function () {
    $province   = strtoupper(env("LOCATION"));
	$locations  = Location::all();

    // MUNICIPALITIES
    $provinces  = json_decode(\File::get(public_path('location/philippines/refprovince.json')));
    $sorted     = collect($provinces->records)->sortBy('provDesc');
    $province   = $sorted->where('provDesc', $province)->first();

    $data       = [];

    // Get All Cities
    foreach ($locations as $key => $location) {

        // MUNICIPALITIES
        $cities     = collect(json_decode(\File::get(public_path('location/philippines/refcitymun.json')))->records);
        $city       = $cities->where('citymunDesc', $location->name)
                        ->where('provCode', $province->provCode)
                        ->flatten()
                        ->first();

        // BARANGAYS
        $barangays = collect(json_decode(\File::get(public_path('location/philippines/refbrgy.json')))->records);
        $barangays = $barangays->where('citymunCode', $city->citymunCode)->flatten();

        // Get The Barangays of City
        foreach ($barangays as $key => $barangay) {
            $data[] = [
                'name' => $barangay->brgyDesc,
                'location_id' => $location->id
            ];
        }
    }
    
    // Store Barangays
    if( env('LOC_INSERT', false ) ) {
        if( count($locations) > 0 && count(Baranggay::all()) <= 0 ) {
            $insertBarangays = Baranggay::insert($data);
        }
    }

    return response()->json($barangays);
})->name('api.barangays');

// Route::group([
//     'prefix'     => 'admin-one',
// ], function () { // custom user login routes

// 	Route::get('logout', 'Auth\LoginController@logout')->name('backpack.auth.logout');
//     Route::post('logout', 'Auth\LoginController@logout');  
// });

/*
|--------------------------------------------------------------------------
| NAVBAR Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'PageController@about');
Route::get('/privacy', function () {
	$location         =   env("LOCATION") ?? "Project One";
    $title            =   "Privacy Policy of One " . $location;
    return view('v2.pages.privacy_policies')->with('title', $title);
})->name('privacy');


/*
|--------------------------------------------------------------------------
| UNDER CONSTRUCTION Routes
|--------------------------------------------------------------------------
*/
Route::get('/gallery', function () {
    return view('v2.pages.under_construction');
});
Route::get('/jobs', function () {
    return view('v2.pages.under_construction');
});
Route::get('/faq', function () {
    return view('pages.faq');
});
// Route::get('/categories', function () {
//     return view('pages.categories');
// });

/*
|--------------------------------------------------------------------------
| CATEGORIES Routes
|--------------------------------------------------------------------------
*/
Route::get('/categories', 'PageController@categories')->name('categories');
Route::get('/categories/category', 'PageController@getCategories')->name('/categories/category');

/*
|--------------------------------------------------------------------------
| SEARCH Routes
|--------------------------------------------------------------------------
*/
Route::post('/search', 'SearchController@search')->name('search');

/*
|--------------------------------------------------------------------------
| CONTACT US Routes
|--------------------------------------------------------------------------
*/
Route::get('/contact', 'ContactUsController@contactUs');
Route::get('/refresh_captcha', 'ContactUsController@refreshCaptcha')->name('refresh');
Route::post('/send_message','ContactUsController@sendMessage');

/*
|--------------------------------------------------------------------------
| JOBS Routes
|--------------------------------------------------------------------------
*/
// Route::get('/jobs', 'JobController@index');
// Route::get('/jobs/{id}', 'JobController@jobCategory')->where(['id'=> '[0-9]+']);
Route::get('/{business_slug}/{id}/hiring', 'JobController@jobInfo')->where(['id'=> '[0-9]+']);

Route::post('/submit_newsletter','NewsLetterController@registerAccount');

/*
|--------------------------------------------------------------------------
| REGISTRATION Routes
|--------------------------------------------------------------------------
*/
Route::post('/submit_registration','BusinessRegistrationController@registerBusiness');
Route::get('/register', 'BusinessRegistrationController@registration')->name('register');
Route::get('/registration', 'BusinessRegistrationController@registration')->name('registration');
Route::post('registration/api/get-baranggays', 'BusinessRegistrationController@getBaranggays');
Route::get('registration/api/get-sub-categories', 'BusinessRegistrationController@getSubCategories');

/*
|--------------------------------------------------------------------------
| BUSINESS Routes
|--------------------------------------------------------------------------
*/
// Route::get('businesses', 'ShowBusinessesController@showBusinessList');
// Route::get('single-business', 'ShowBusinessesController@showSingleBusiness');
Route::get('businesses/{slug}', 'ShowBusinessesController@showBusinessList');
Route::post('/{slug}/search', 'SearchController@search');
Route::get('{category_slug}/{slug}', 'ShowBusinessesController@showSingleBusiness')->name('show_business');
Route::post('businesses/{slug}', 'ShowBusinessesController@showBusinessList');

// Route::get('businesses', 'ShowBusinessesController@showBusinessList');

Route::post('/businesses/search', 'SearchController@search');

Route::post('/{business_code}/{slug}/search', 'SearchController@search');

Route::get('/create-job', 'JobController@createJob')->name('create-job');
Route::post('/submit-job', 'JobController@submitJob')->name('submit-job');

// // Redirect Default Login
// Route::match(['get', 'post'], 'login', function(){
//     return redirect('/');
// });

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');
Route::get('test', 'FilmController@getTest');

Route::get('/', ['as' => 'home', 'uses' => 'PhimHayController@home']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::group(['prefix' => 'error'], function() {
    Route::get('404', ['as' => '404', 'uses' => 'HandlerController@get404']);
    Route::get('500', ['as' => '500', 'uses' => 'HandlerController@get500']);
    Route::get('403', ['as' => '403', 'uses' => 'HandlerController@get403']);
});
//provider login
Route::group(['prefix' => 'provider'], function() {
    Route::group(['prefix' => 'facebook'], function() {
        Route::get('redirect', ['as' => 'facebook.getRedirect', 'uses' => 'SocialAuthController@redirectFacebook']);
        Route::get('callback',['as' => 'facebook.getCallback', 'uses' => 'SocialAuthController@callbackFacebook']);
    });
});
// login - logout
Route::group(['prefix' => 'auth'], function() {
    
    //login
    Route::get('login',['as'=>'auth.getLogin', 'uses'=>'Auth\AuthController@getLogin']);

    Route::post('login', 'Auth\AuthController@postLogin');
    //register
    Route::get('register',['as'=>'auth.getRegister', 'uses'=>'Auth\AuthController@getRegister']);
    Route::post('register', 'Auth\AuthController@postRegister');
    // active
    Route::get('active/{code}',['as'=>'auth.getActive', 'uses'=>'Auth\AuthController@getActive']);
    //active-message
    Route::get('active-message',['as'=>'auth.getActiveMessage', 'uses'=>'Auth\AuthController@getActiveMessage']);
    //send again email active
    Route::get('active-send',['as'=>'auth.getActiveSend', 'uses'=>'Auth\AuthController@getActiveSend']);
    Route::post('active-send','Auth\AuthController@postActiveSend');
    //logout
    Route::get('logout',['as'=>'auth.getLogout', 'uses'=>'Auth\AuthController@getLogout']);
    //recover-user
    Route::get('recover',['as'=>'auth.getRecover', 'uses'=>'Auth\AuthController@getRecover']);
    Route::post('recover', 'Auth\AuthController@postRecover');
     Route::get('recover-message',['as'=>'auth.getRecoverMessage', 'uses'=>'Auth\AuthController@getRecoverMessage']);
});
//user 
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    //
    Route::get('profile/{id}', ['as' => 'user.getProfile', 'uses' => 'UserController@getProfile']);
    Route::get('film-tick/{id}', ['as' => 'user.getFilmUserTick', 'uses' => 'UserController@getFilmUserTick']);
    Route::get('film-watch/{id}', ['as' => 'user.getFilmUserWatch', 'uses' => 'UserController@getFilmUserWatch']);
    Route::post('change-password', ['as' => 'user.postChangePassword', 'uses' => 'UserController@postChangePassword']);
    Route::post('change-info', ['as' => 'user.postChangeInfo', 'uses' => 'UserController@postChangeInfo']);
});
//person 
Route::group(['prefix' => 'person'], function() {
    //
    Route::match(['get', 'post'],'/', ['as' => 'person.getList', 'uses' => 'FilmPersonController@getPersonList']);
    Route::get('profile/{dir_name}/{id}', ['as' => 'person.getProfile', 'uses' => 'FilmPersonController@getProfile']);
    Route::get('person-director/{id}', ['as' => 'person.getPersonDirector', 'uses' => 'FilmPersonController@getPersonDirector']);
    Route::get('person-actor/{id}', ['as' => 'person.getPersonActor', 'uses' => 'FilmPersonController@getPersonActor']);
});
//report error
Route::group(['prefix' => 'report-error'], function() {
    //
    Route::post('add', ['as' => 'reportErrorAjax.postAdd', 'uses' => 'FilmReportErrorAjaxController@postAdd']);
});
//route captcha
Route::group(['prefix' => 'captcha'], function() {
	//captcha login
	Route::get('login/{id}', ['as'=>'captcha.getCaptchaLoginUser', 'uses'=>'CaptchaController@getCaptchaLoginUser']);
	//captcha register
	Route::get('register/{id}', ['as'=>'captcha.getCaptchaRegisterUser', 'uses'=>'CaptchaController@getCaptchaRegisterUser']);
    //captcha recover
    Route::get('recover/{id}', ['as'=>'captcha.getCaptchaRecoverUser', 'uses'=>'CaptchaController@getCaptchaRecoverUser']);
    //captcha download
    Route::get('download/{id}', ['as'=>'captcha.getCaptchaDownloadFilm', 'uses'=>'CaptchaController@getCaptchaDownloadFilm']);
    //captcha report error add
    Route::get('report-error-add/{id}', ['as'=>'captcha.getCaptchaReportErrorAdd', 'uses'=>'CaptchaController@getCaptchaReportErrorAdd']);
});

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', function(){
        return view('admin.master');
    });
    //film
    Route::group(['prefix' => 'film'], function() {
    	//add
        Route::get('add',['as'=>'admin.film.getAdd', 'uses'=>'FilmController@getAdd']);
        Route::post('add',['as'=>'admin.film.postAdd', 'uses'=>'FilmController@postAdd']);
        // //list
        Route::get('list',['as'=>'admin.film.getList', 'uses'=>'FilmController@getList']);
        //edit
        Route::get('edit/{id}',['as'=>'admin.film.getEdit', 'uses'=>'FilmController@getEdit']);
        Route::post('edit/{id}',['as'=>'admin.film.postEdit', 'uses'=>'FilmController@postEdit']);
        //show
        Route::get('show/{film_id}',['as'=>'admin.film.getShow', 'uses'=>'FilmController@getShow']);
        //check-link
        Route::get('check-link/{film_id}',['as'=>'admin.film.getCheckLink', 'uses'=>'FilmController@getCheckLink']);
        Route::post('trailer/edit/{film_id}',['as'=>'admin.film.postEditFilmTrailer', 'uses'=>'FilmController@postEditFilmTrailer']);
        Route::post('episode/add/{film_id}',['as'=>'admin.film.postAddFilmEpisode', 'uses'=>'FilmController@postAddFilmEpisode']);
        //
        Route::get('episode/edit/{film_id}/{id}',['as'=>'admin.film.getEditFilmEpisode', 'uses'=>'FilmController@getEditFilmEpisode']);
        Route::post('episode/edit/{film_id}/{id}',['as'=>'admin.film.postEditFilmEpisode', 'uses'=>'FilmController@postEditFilmEpisode']);
        Route::get('episode/delete/{film_id}/{id}',['as'=>'admin.film.getDeleteFilmEpisode', 'uses'=>'FilmController@getDeleteFilmEpisode']);
        Route::get('search',['as'=>'admin.film.getSearch', 'uses'=>'FilmController@getSearchAdmin']);
        // //delete
        Route::get('delete/{id}',['as'=>'admin.film.getDelete', 'uses'=>'FilmController@getDelete']);
    });
    //
    //user
    Route::group(['prefix' => 'user'], function() {
        //add
        Route::get('add',['as'=>'admin.user.getAdd', 'uses'=>'UserController@getAdd']);
        Route::post('add', 'UserController@postAdd');
        //list
        Route::get('list',['as'=>'admin.user.getList', 'uses'=>'UserController@getList']);
        //edit
        Route::get('edit/{id}',['as'=>'admin.user.getEdit', 'uses'=>'UserController@getEdit']);
        Route::post('edit/{id}', 'UserController@postEdit');
        //delete
        Route::get('delete/{id}',['as'=>'admin.user.getDelete', 'uses'=>'UserController@getDelete']);
        //search
         Route::get('search',['as'=>'admin.user.getSearch', 'uses'=>'UserController@getSearch']);
        //ajax search user
         Route::post('search', ['as' => 'admin.userAjax.postSearch', 'uses' => 'UserAjaxController@postSearch']);
    });
    //slider
    Route::group(['prefix' => 'slider'], function() {
        //add
        Route::get('add',['as'=>'admin.slider.getAdd', 'uses'=>'FilmSliderController@getAdd']);
        Route::post('add', 'FilmSliderController@postAdd');
        //list
        Route::get('list',['as'=>'admin.slider.getList', 'uses'=>'FilmSliderController@getList']);
        //edit
        Route::get('edit/{id}',['as'=>'admin.slider.getEdit', 'uses'=>'FilmSliderController@getEdit']);
        Route::post('edit/{id}', 'FilmSliderController@postEdit');
        //delete
        Route::get('delete/{id}',['as'=>'admin.slider.getDelete', 'uses'=>'FilmSliderController@getDelete']);
    });
    //person
    Route::group(['prefix' => 'person'], function() {
        //add
        Route::get('add',['as'=>'admin.person.getAdd', 'uses'=>'FilmPersonController@getAdd']);
        Route::post('add', 'FilmPersonController@postAdd');
        //list
        Route::get('list',['as'=>'admin.person.getList', 'uses'=>'FilmPersonController@getList']);
        //edit
        Route::get('edit/{id}',['as'=>'admin.person.getEdit', 'uses'=>'FilmPersonController@getEdit']);
        Route::post('edit/{id}', 'FilmPersonController@postEdit');
        //delete
        Route::get('delete/{id}',['as'=>'admin.person.getDelete', 'uses'=>'FilmPersonController@getDelete']);
        Route::get('search',['as'=>'admin.person.getSearch', 'uses'=>'FilmPersonController@getSearch']);
        //ajax
        Route::group(['prefix' => 'ajax'], function() {
            //add person
            Route::post('film-person-add', ['as' => 'admin.filmPersonAjax.postAdd', 'uses' => 'FilmPersonAjaxController@postAdd']);
            //search person
            Route::post('film-person-search', ['as' => 'admin.filmPersonAjax.postSearch', 'uses' => 'FilmPersonAjaxController@postSearch']);

        });
    });
    Route::group(['prefix' => 'job'], function() {
        //add
        Route::get('add',['as'=>'admin.job.getAdd', 'uses'=>'FilmJobController@getAdd']);
        Route::post('add', 'FilmJobController@postAdd');
        //list
        Route::get('list',['as'=>'admin.job.getList', 'uses'=>'FilmJobController@getList']);
        //edit
        Route::get('edit/{id}',['as'=>'admin.job.getEdit', 'uses'=>'FilmJobController@getEdit']);
        Route::post('edit/{id}', 'FilmJobController@postEdit');
        //delete
        Route::get('delete/{id}',['as'=>'admin.job.getDelete', 'uses'=>'FilmJobController@getDelete']);
    });
    //call route('admin.country.???')
    Route::resource('country', 'FilmCountryController', ['except' => ['show']]);
    Route::resource('type', 'FilmTypeController', ['except' => ['show']]);
    Route::resource('report-error', 'FilmReportErrorController', ['only' => ['index', 'destroy', 'show']]);
    Route::group(['prefix' => 'report-error'], function() {
        //
        Route::post('delete-array/{id}',['as'=>'admin.report-error.postDeleteArray', 'uses'=>'FilmReportErrorController@postDeleteArray']);
        Route::post('read-array/{id}',['as'=>'admin.report-error.postReadArray', 'uses'=>'FilmReportErrorController@postReadArray']);
    });
});
// phim
Route::group(['prefix' => 'film'], function() {
    //list phim auto, or search
    Route::get('/', ['as' => 'film.getSearch', 'uses' => 'FilmController@getSearch']);
    //film info
    Route::get('{film_dir}/{film_id}', ['as' => 'film.getFilm', 'uses' => 'FilmController@getFilmInfo']);
    //ajax processing film
    Route::group(['prefix' => 'film-processing'], function() {
        //search, method = post
        Route::post('search-film', ['as' => 'filmAjax.getSearchFilm', 'uses' => 'FilmAjaxController@getSearchFilm']);
        //search film relate
        Route::post('film-relate', ['as' => 'filmAjax.getSearchFilmRelate', 'uses' => 'FilmAjaxController@getSearchFilmRelate']);
        //
        Route::post('film-tick', ['as' => 'filmAjax.getFilmTick', 'uses' => 'FilmAjaxController@getFilmTick']);
        //danh gia
        Route::post('film-evaluate', ['as' => 'filmAjax.getFilmEvaluate', 'uses' => 'FilmAjaxController@getFilmEvaluate']);
        //report error
        Route::post('film-report-error', ['as' => 'filmAjax.getFilmReportError', 'uses' => 'FilmAjaxController@getFilmReportError']);
        //comment
        Route::group(['prefix' => 'film-comment-local'], function() {
            Route::post('add/{film_id}', ['as' => 'commentAjax.postAdd', 'uses' => 'FilmCommentLocalAjaxController@postAdd']);
            Route::post('load/{film_id}', ['as' => 'commentAjax.postLoad', 'uses' => 'FilmCommentLocalAjaxController@postLoad']);
        });

    });
});
//xem phim
// Route::get('watch/{film_dir}/{film_id}', ['as' => 'film.getFilmWatch', 'uses' => 'FilmController@getFilmWatch']);
Route::get('watch/{film_dir}/{film_id}/{id}', ['as' => 'film.getFilmWatch', 'uses' => 'FilmController@getFilmWatch']);
// Route::get('google', function(){
//     $analyticsData = LaravelAnalytics::getMostVisitedPages(365, 20);
//     dd($analyticsData);
// });
Route::group(['prefix' => 'download'], function() {
    //
    Route::get('captcha/{film_dir}/{film_id}', ['as' => 'film.getFilmDownloadCaptcha', 'uses' => 'FilmController@getFilmDownloadCaptcha']);
    Route::match(['get', 'post'],'{film_dir}/{film_id}', ['as' => 'film.getFilmDownload', 'uses' => 'FilmController@getFilmDownload']);
});


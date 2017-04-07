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

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {  
    Route::get('/', 'HomeController@index');
    Route::resource ('staff','StaffController');
    Route::resource ('inspactor','InspactorController');
    Route::resource ('electrician','ElectricianController');
});
Route::auth();

Route::group(['namespace' => 'Util','prefix' => 'util'],function(){
    
    Route::get('excel/outface','ExceltoolController@outface');
    // 获取20条用户数据
    Route::get('androidinterface/getpieceinfo/{start}','AndroidtoolController@getpieceinfo');
    Route::get('androidinterface/getinfofromname/{name}','AndroidtoolController@getinfofromname');
    Route::get('androidinterface/getinfofromqr/{qr}','AndroidtoolController@getinfofromqr');
    Route::get('androidinterface/getinfofromfactoryid/{factoryid}','AndroidtoolController@getinfofromfactoryid');
    
    // 更换二维码信息的路由
    Route::get('androidinterface/replaceqr/{clientid}','AndroidtoolController@replaceqr');
    Route::get('androidinterface/requestreplace/{clientid}','AndroidtoolController@requestreplaceqr');
    Route::get('androidinterface/informreplaceinfo/{electricianid}','AndroidtoolController@informreplaceinfo');

    //稽查员使用路由
    Route::get('androidinterface/getreplaceqr','AndroidtoolController@getreplaceqr');
    Route::get('androidinterface/confirmqr/{id}','AndroidtoolController@confirmqr');
    Route::get('androidinterface/cancelqr/{id}','AndroidtoolController@cancelqr');

    // 稽查员使用路由2
    Route::get('androidinterface/setClienterror/{clientid}/by/{info}/by/{inspactorid}','AndroidtoolController@setClienterror');
    Route::get('androidinterface/getClienterrors','AndroidtoolController@getClienterrors');
    Route::get('androidinterface/deleteClienterror','AndroidtoolController@deleteClienterror');

    // 上传图片路由
    Route::get('/uploadfile','UploadfileController@index');
    Route::post('/uploadfile','UploadfileController@showUploadFile');
    

});

Route::get('/', 'HomeController@index');

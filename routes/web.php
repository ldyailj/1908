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
//    // echo 123;
//    $name='1908 欢迎您！';
//     return view('welcome',['name'=>$name]);
// });

// Route::get('/show', function(){
//     echo 'hello';
// });
/*
Route::get('/user','UserController@index');

Route::get('/adduser','UserController@add');

Route::post('/adddo','UserController@adddo');



Route::get('/show', function(){
    echo '这里是商品详情页';
});

Route::get('/show/{id}', function($id){
    echo '商品id：'.$id;
});

Route::get('/show/{id}/{name}', function($id,$name){
    echo '商品id：'.$id;
    echo '商品是：'.$name;
});

Route::get('/cartgoty/add','UserController@cartgoty');

Route::get('/brand/add','UserController@brand');
*/
/*
//路由显示视图
Route::get('addstudent',StudentController@)
*/
// Route::get("/","PeopleController@index");

Route::get("/","Index\indexController@index");
 //登录页面
Route::view('/login','index.login');
 //执行登录
Route::post('/logindo','Index\LoginController@logindo');
//注册
Route::view('/reg','index.reg');
/*
//正则约束
Route::get('/goods/{id}',function($goods_id){
    echo '商品ID';
    echo '$goods_id';
});
Route::get('/show/{id}',function($goods_id){
    echo "ID:";
    echo $goods_id;
});
Route::get('/goods/{id}/{name}',function($goods_id,$name){
    echo '商品ID：';
    echo $goods_id;
    echo '商品名称：';
    echo $name; 
})->where(['name'=>'\w+']);

*/

/** 前台*/
Route::get("/","Index\indexController@index");
 //登录页面 、执行登录
Route::view('/login','index.login');
Route::post('/logindo','LoginController@logindo');
//注册、执行注册
Route::view('/reg','index.reg');
Route::post('/regdo','Index\LoginController@regdo');
//短信
Route::get('/send','Index\IndexController@ajaxsend');

//详情页面
Route::view('/proinfo','index.proinfo');
Route::post('/proinfodo','LoginController@proinfodo');
//发送邮件
Route::get('/sendemail','Index\IndexController@sendemail');
//商品展示页
Route::get('/pro/{id?}','Index\ProController@prolist');
//商品详情车页
Route::get('/proinfo/{id}','Index\ProController@proinfo');



//外来务工人员统计
Route::prefix('people')->middleware('checklogin')->group(function(){
    Route::get('create',"PeopleController@create");
    Route::post('store',"PeopleController@store");
    Route::get('/',"PeopleController@index");
    Route::get('edit/{id}',"PeopleController@edit");
    Route::post('update/{id}',"PeopleController@update");
    Route::get('destroy/{id}',"PeopleController@destroy");
});
    // //登录页面
    // Route::view('/login','login');
    // //执行登录
    // Route::post('/logindo','LoginController@logindo');
    

//学生表
Route::prefix('ban')->group(function(){
    Route::get('create','BanController@create');
    Route::post('store',"BanController@store");
    Route::get('/',"BanController@index");
    Route::get('edit/{id}',"BanController@edit");
    Route::post('update/{id}',"BanController@update");
    Route::get('destroy/{id}',"BanController@destroy");
});

//品牌
Route::prefix('ping')->group(function(){
    Route::get('create','PingController@create');
    Route::post('store',"PingController@store");
    Route::get('/',"PingController@index");
    Route::get('edit/{id}',"PingController@edit");
    Route::post('update/{id}',"PingController@update");
    Route::get('destroy/{id}',"PingController@destroy");
});

//文章
Route::prefix('wz')->group(function(){
    Route::get('create','WzController@create');
    Route::post('store',"WzController@store");
    Route::get('/',"WzController@index");
    Route::get('edit/{id}',"WzController@edit");
    Route::post('update/{id}',"WzController@update");
    Route::get('destroy/{id}',"WzController@destroy");
    Route::post('checkOnly','WzController@checkOnly');

});


//分类
Route::prefix('show')->group(function(){
    Route::get('create',"ShowController@create");
    Route::post('store',"ShowController@store");
    Route::get('/',"ShowController@index");
    Route::get('edit/{id}',"ShowController@edit");
    Route::post('update/{id}',"ShowController@update");
    Route::get('destroy/{id}',"ShowController@destroy");
});

//分类
Route::prefix('cate')->middleware('checklogin')->group(function(){
    Route::get('create','CateController@create');
    Route::post('store','CateController@store');
    Route::get('/','CateController@index');
    Route::get('destroy/{id}','CateController@destroy');
    Route::get('edit/{id}','CateController@edit');
    Route::post('update/{id}','CateController@update');
    Route::post('ajaxtest','CateController@ajaxtest');

});

//商品品牌
Route::prefix('brand')->group(function(){
    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('/','BrandController@index');
    Route::get('destroy/{id}','BrandController@destroy');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
});

//商品表
Route::prefix('shop')->group(function(){
    Route::get('create','ShopController@create');
    Route::post('store','ShopController@store');
    Route::get('/','ShopController@index');
    Route::get('destroy/{id}','ShopController@destroy');
    Route::get('edit/{id}','ShopController@edit');
    Route::post('update/{id}','ShopController@update');
    Route::post('ajaxtest','ShopController@ajaxtest');
});

//管理员
Route::prefix('admins')->group(function(){
    Route::get('create','AdminsController@create');
    Route::post('store','AdminsController@store');
    Route::get('/','AdminsController@index');
    Route::get('destroy/{id}','AdminsController@destroy');
    Route::get('edit/{id}','AdminsController@edit');
    Route::post('update/{id}','AdminsController@update');
    Route::post('ajaxtest','AdminsController@ajaxtest');
});


//cookie
// Route::get('/setCookie','Index\IndexController@setCookie');
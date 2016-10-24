<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::post('msg', 'HomeController@msg');
Route::get('/', 'HomeController@index');
Route::get('share/{id}', 'HomeController@share');
Route::get('rich/list/{id?}', 'HomeController@richList');
Route::get('rich/refresh/{id?}', 'HomeController@richRefresh');
Route::post('info', 'HomeController@info');
Route::post('lottery', 'HomeController@lottery');
Route::get('award', 'HomeController@award');
Route::post('share', 'HomeController@wxShare');
Route::get('/wx/share', function(){
    $url = urldecode(Request::get('url'));
    $_share = [
        [
            'title' => '告诉你个小秘密，其实我是富一代',
            'desc' => '我只告诉你啦，你可千万不要告诉别人啊，做人要低调……',
            'title_timeline' => '2016年华氏全球富豪榜：中国富豪'.json_decode(Session::get('wechat.nickname')).'年入6000万亿',//年入6000万亿（根据分享的互动榜单撰写）高居榜首（根据分享的互动榜单撰写）……
        ],
        [
            'title' => '如何在30岁前挤进全球富豪榜',
            'desc' => '先设定一个小目标，成为有钱人',
            'title_timeline' => '2016年华氏全球富豪榜：中国富豪'.json_decode(Session::get('wechat.nickname')).'年入6000万亿',//年入6000万亿（根据分享的互动榜单撰写）高居榜首（根据分享的互动榜单撰写）……
        ],
    ];
    $options = [
      'app_id' => env('WECHAT_APPID'),
      'secret' => env('WECHAT_SECRET'),
      'token' => env('WECHAT_TOKEN')
    ];
    $wx = new EasyWeChat\Foundation\Application($options);
    $js = $wx->js;
    $js->setUrl($url);
    $n = rand(0,1);
    $config = json_decode($js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'), false), true);
    $share = [
      'title' => $_share[$n]['title'],
      'desc' => $_share[$n]['desc'],
      'title_timeline' => $_share[$n]['title_timeline'],
      //'link' => env('APP_URL'),
      'imgUrl' => asset(env('WECHAT_SHARE_IMG')),
    ];
    return json_encode(array_merge($share, $config));
});
Route::get('logout',function(){
    Request::session()->set('wechat.openid',null);
    Request::session()->set('wechat.id',null);
    return redirect('/');
});
Route::get('login',function(){
    $wechat_user = App\WechatUser::find(1);
    Request::session()->set('wechat.openid',$wechat_user->open_id);
    Request::session()->set('wechat.id',$wechat_user->id);
    Request::session()->set('wechat.nickname',json_decode($wechat_user->nick_name));
    return redirect('/');
});

///

Route::get('/admin/login', 'Admin\AuthController@getLogin');
Route::post('/admin/login', 'Admin\AuthController@postLogin');
Route::any('/admin/logout', function(){
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
});

//抽奖部分管理
//wechat auth
Route::any('/wechat/auth', 'WechatController@auth');
Route::any('/wechat/callback', 'WechatController@callback');

Route::group(['middleware' => ['auth:admin','menu']], function () {
    Route::get('admin', 'CmsController@index')->name('admin_dashboard');
    Route::get('admin/users', 'CmsController@users');
    Route::get('admin/account', 'CmsController@account');
    Route::post('admin/account', 'CmsController@accountPost');
    Route::get('admin/wechat', 'CmsController@wechat');
    Route::get('admin/user/logs', 'CmsController@userLogs');
    Route::get('admin/export', 'CmsController@export');
    Route::get('admin/photos', 'CmsController@photos');
    Route::get('admin/photos/export', 'CmsController@photosExport');
    Route::get('admin/sessions', 'CmsController@sessions');
    Route::get('admin/session/{id}', 'CmsController@sessions');
    Route::get('admin/lotteries', 'CmsLotteryController@lotteries');
    Route::get('admin/prizes', 'CmsLotteryController@prizes');
    Route::post('admin/prize/update/{id}', 'CmsLotteryController@prizeUpdate');//
    Route::get('admin/lottery/configs', 'CmsLotteryController@lotteryConfigs');
    Route::post('admin/lottery/config/update/{id}', 'CmsLotteryController@lotteryConfigUpdate');
    Route::post('admin/lottery/config/add', 'CmsLotteryController@lotteryConfigAdd');
    Route::get('admin/prize/configs', 'CmsLotteryController@prizeConfigs');
    Route::get('admin/prize/config/update/{id}', 'CmsLotteryController@prizeConfig');
    Route::post('admin/prize/config/update/{id}', 'CmsLotteryController@prizeConfigUpdate');
    Route::get('admin/prize/config/add', 'CmsLotteryController@prizeConfigAdd');
    Route::post('admin/prize/config/add', 'CmsLotteryController@prizeConfigStore');
    Route::get('admin/prize/codes', 'CmsLotteryController@prizeCodes');
});
//初始化后台帐号
Route::get('admin/install', function () {
    if (0 == \App\Admin::count()) {
        $user = new \App\Admin();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin@2016');
        $user->save();
    }
    return redirect('admin/login');
});

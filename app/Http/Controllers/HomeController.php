<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use Session;
use App\Helpers\Lottery;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('wechat.auth');
    }
    public function index()
    {
        $has_award = \App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->count();
        $rich_list = App\RichList::where('user_id', Session::get('wechat.id'))->orderBy('created_at', 'DESC')->first();
        if( null == $rich_list){
            $scale = 0;
            $wealth = rand(2401,5000);
            $name = Session::get('wechat.nickname');
            $rich_list = new App\RichList();
            $rich_list->wealth = $wealth;
            $rich_list->scale = $scale;
            $rich_list->user_id = Session::get('wechat.id');
            $rich_list->save();
        }
        $link = url('/share/'.$rich_list->id);
        $info = App\Info::find(Session::get('wechat.id'));
        $mobile = null == $info ? '' : $info->mobile;
        return view('index', ['has_award'=> $has_award, 'link'=>$link, 'mobile'=>$mobile]);
    }
    public function msg(Request $request){
        $mobile = $request->input('mobile');
        if( preg_match('/^1\d{10}$/', $mobile) == FALSE){
            return ['ret'=>1001,'msg'=>'请输入正确的手机号'];
        }
        Session::set('mobile',$mobile);
        $msg = '感谢您对上海华瑞银行的支持，诚邀您登陆“朋友圈的银行”体验！我们用心为您打造移动金融服务的一站式服务平台，戳 t.cn/RVSSR9a';
        $data = [];
        $post_data = [];
        $data['appID'] = '83532675-fd59-4897-ad6d-5e3d3a011706';
        $data['random'] = time().'a';
        $data['key'] = '1de61ed3-1178-4e3e-aabb-994af28e8772';
        $url = 'https://hop.hulubank.com.cn:443/apis/msg/sendMsg';

        $md5 = strtoupper(md5(http_build_query($data)));
        $post_data['sign'] = $md5;
        $post_data['msg'] = $msg;
        $post_data['mobile'] = $mobile;
        $post_data['appID'] = $data['appID'];
        $post_data['random'] = $data['random'];
        $response = App\Helper\HttpClient::post($url, $post_data);

        $json = json_decode($response, true);
        if($json !== null && $json['returnCode'] == '000000' && $json['errorCode'] == '000000'){
            $result = ['ret'=>0];

            $info = App\Info::find(Session::get('wechat.id'));
            if( null == $info){
                $info = new App\Info();
                $info->id =  Session::get('wechat.id');
                $info->name = '';
                $info->mobile = $mobile;
                $info->address = '';
                $info->ip_address = $request->getClientIp();
            }
            else{
                $info->mobile = $mobile;
            }
            $info->save();
        }
        else{
            $result = ['ret'=>1002,'msg'=>'发送短信失败'];
        }
        return $result;

    }
    public function share(Request $request, $id)
    {
        $rich_list = App\RichList::where('user_id', Session::get('wechat.id'))->orderBy('created_at', 'DESC')->first();
        if( null == $rich_list){
            $scale = 0;
            $wealth = rand(2401,5000);
            $name = Session::get('wechat.nickname');
            $rich_list = new App\RichList();
            $rich_list->wealth = $wealth;
            $rich_list->scale = $scale;
            $rich_list->user_id = Session::get('wechat.id');
            $rich_list->save();
        }
        $link = url('/share/'.$rich_list->id);
        $has_award = \App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->count();
        $info = App\Info::find(Session::get('wechat.id'));
        $mobile = null == $info ? '' : $info->mobile;
        return view('index',['id'=>$id, 'has_award'=> $has_award, 'link'=>$link, 'mobile'=>$mobile]);
    }
    protected function reorder($data, $list = null)
    {
        if( $list == null ){
            $list = [
                ['name'=>'比尔盖子', 'wealth'=>'5200', 'scale'=>'-0.06', 'from'=>'投资', 'location'=>'美国', 'isUser'=>false],
                ['name'=>'涡轮巴飞特', 'wealth'=>'4500', 'scale'=>'-0.11', 'from'=>'投资', 'location'=>'墨西哥', 'isUser'=>false],
                ['name'=>'索螺丝', 'wealth'=>'4200', 'scale'=>'0.16', 'from'=>'投资', 'location'=>'加拿大', 'isUser'=>false],
                ['name'=>'史地富乔不思', 'wealth'=>'3500', 'scale'=>'0.83', 'from'=>'科技', 'location'=>'美国
', 'isUser'=>false],
                ['name'=>'李加橙', 'wealth'=>'3300', 'scale'=>'-0.40', 'from'=>'实业', 'location'=>'中国', 'isUser'=>false],
                ['name'=>'卡内急', 'wealth'=>'3100', 'scale'=>'0.07', 'from'=>'钢铁', 'location'=>'印度', 'isUser'=>false],
                ['name'=>'大胃贝壳汉姆', 'wealth'=>'3000', 'scale'=>'-0.15', 'from'=>'运动', 'location'=>'英国', 'isUser'=>false],
                ['name'=>'老虎舞姿', 'wealth'=>'2700', 'scale'=>'-0.22', 'from'=>'运动', 'location'=>'发过', 'isUser'=>false],
                ['name'=>'傲八马', 'wealth'=>'2500', 'scale'=>'0.22', 'from'=>'政治', 'location'=>'俄罗斯', 'isUser'=>false],
                ['name'=>'伯纳德', 'wealth'=>'2400', 'scale'=>'-0.76', 'from'=>'时装', 'location'=>'法国', 'isUser'=>false]
            ];
        }

        if( null == $data || $data['wealth'] == 0){
            return $list;
        }
        $_list = [];
        $n = 0;
        foreach($list as $k=>$v){
            if($data['wealth'] > $v['wealth']){
                $n = $k;
                break;
            }
        }
        for($i = 0; $i < 10; $i++){
            if($i < $n){
                $_list[$i] = $list[$i];
            }
            elseif($i == $n){
                $_list[$i] = ['name'=>$data['name'], 'wealth'=>$data['wealth'], 'scale'=>$data['scale'], 'from'=>'理财', 'location'=>'中国', 'isUser'=>true];
            }
            else{
                $_list[$i] = $list[$i-1];
            }
        }
        return $_list;
    }
    public function richList(Request $request, $id = null)
    {
        $rich_list = App\RichList::where('user_id', Session::get('wechat.id'))->orderBy('created_at', 'DESC')->first();

        if( null == $rich_list){
            $scale = 0;
            $wealth = rand(2401,5000);
            $name = Session::get('wechat.nickname');
            $rich_list = new App\RichList();
            $rich_list->wealth = $wealth;
            $rich_list->scale = $scale;
            $rich_list->user_id = Session::get('wechat.id');
            $rich_list->save();
        }
        else{
            $wealth = $rich_list->wealth;
            $scale = $rich_list->scale;
            $name = json_decode($rich_list->user->nick_name);
        }

        $link = url('/share/'.$rich_list->id);
        $data = [
            'name' => $name,
            'wealth' => $wealth,
            'scale' => $scale
        ];

        $_list = $this->reorder($data);

        if( $id != null){
            $rich_list = App\RichList::find($id);
            if(null == $rich_list){
                return ['ret'=>1001,'msg'=>''];
            }
            if($rich_list->user_id != Session::get('wechat.id')){
                $data = [
                    'name' => json_decode($rich_list->user->nick_name),
                    'wealth' => $rich_list->wealth,
                    'scale' => $rich_list->scale,
                ];
                $_list = $this->reorder($data, $_list);
            }

        }
        $html = view('list', ['list' => $_list]);
        return ['ret'=>0,'html'=>$html->render(),'link'=>$link];
        //return view('list', ['list' => $_list]);
    }
    public function richRefresh(Request $request, $id = null)
    {
        $wealth = rand(0,9) < 8 ? rand(2401,5200) : rand(5201,9999);
        $rich_list = App\RichList::where('user_id', Session::get('wechat.id'))->orderBy('created_at', 'DESC')->first();

        if( null == $rich_list){
            $scale = 0;
            $name = Session::get('wechat.nickname');
        }
        else{
            //$scale = $rich_list->scale;
            $name = json_decode($rich_list->user->nick_name);
            $scale = sprintf('%.2f',$wealth/$rich_list->wealth - 1);
        }

        $data = [
            'name' => $name,
            'wealth' => $wealth,
            'scale' => $scale
        ];

        $_list = $this->reorder($data);

        if( $id != null && $id != Session::get('wechat.id')){
            $rich_list = App\RichList::find($id);
            if(null == $rich_list){
                return ['ret'=>1001,'msg'=>''];
            }
            if($rich_list->user_id != Session::get('wechat.id')){
                $data = [
                    'name' => json_decode($rich_list->user->nick_name),
                    'wealth' => $rich_list->wealth,
                    'scale' => $rich_list->scale,
                ];
                $_list = $this->reorder($data, $_list);
            }

        }

        $rich_list = new App\RichList();
        $rich_list->wealth = $wealth;
        $rich_list->scale = $scale;
        $rich_list->user_id = Session::get('wechat.id');
        $rich_list->save();
        $html = view('list', ['list' => $_list]);
        return ['ret'=>0,'html'=>$html->render(),'link'=>url('/share/'.$rich_list->id)];
    }
    public function lottery(Request $request)
    {
        $timestamp = time();
        $wechat_user = App\WechatUser::find(Session::get('wechat.id'));
        $has_win = App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->whereNotNull('prize_id')
            ->count();
        if( $has_win > 0 ){
            $wechat_user->has_shared = 0;
            $wechat_user->save();
            return ['ret'=>1100, 'msg'=>'您已经中过奖了嗷~'];
        }
        $count2 = App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->where('lottery_time', '>=', date('Y-m-d', $timestamp))
            ->where('lottery_time', '<=', date('Y-m-d 23:59:59', $timestamp))
            ->count();
        if( $count2 == 1 && $wechat_user->has_shared == 0){
            return ['ret'=>1002, 'msg'=>'可以分享再获得一次抽奖机会'];
        }
        elseif( $count2 > 1){
            //超过1次后重置分享flag
            $wechat_user->has_shared = 0;
            $wechat_user->save();
            return ['ret'=>1001, 'msg'=>'今天您没有抽奖机会了嗷~'];
        }

        $lottery = new Lottery();
        $prize = $lottery->run();
        $code = $lottery->getCode();
        if( $prize == null) $prize = 0;
        if( $prize == 2 || $prize == 3){
            $mobile = Session::get('mobile');
            $msg = [
                '恭喜您中得二等奖（格瓦拉电影票一张），您的电影票串码： '.$code.'  请登录格瓦拉网站兑换礼遇！感谢您对“朋友圈的银行”支持，敬请登录我行网站体验 t.cn/RVSSR9a',
                '恭喜您中得三等奖（优酷周卡一张），您的周卡串码： '.$code.'  请登录优酷网站兑换礼遇！感谢您对“朋友圈的银行”支持，敬请登录我行网站体验 t.cn/RVSSR9a '
            ];

            $data = [];
            $post_data = [];
            $data['appID'] = '83532675-fd59-4897-ad6d-5e3d3a011706';
            $data['random'] = time().'a';
            $data['key'] = '1de61ed3-1178-4e3e-aabb-994af28e8772';
            $url = 'https://hop.hulubank.com.cn:443/apis/msg/sendMsg';

            $md5 = strtoupper(md5(http_build_query($data)));
            $post_data['sign'] = $md5;
            $post_data['msg'] = $msg;
            $post_data['mobile'] = $mobile;
            $post_data['appID'] = $data['appID'];
            $post_data['random'] = $data['random'];
            App\Helper\HttpClient::post($url, $post_data);


            /*
            $json = json_decode($response, true);
            if($json == true && $json['returnCode'] == '000000' && $json['errorCode'] == '000000'){
                $result = ['ret'=>0];
            }
            else{
                $result = ['ret'=>1002,'msg'=>'发送短信失败'];
            }
            */
        }
        return ['prize'=>$prize, 'ret'=>0, 'code'=>$code];
    }
    public function award()
    {
        $lottery = App\Lottery::where('user_id', Session::get('wechat.id'))
            ->whereNotNull('prize_id')
            ->first();
        if(null != $lottery){
            $code = null;
            if( null != $lottery->prize_code_id ){
                $prize_code = App\PrizeCode::find($lottery->prize_code_id);
                $code = $prize_code->code;
            }

            return ['ret'=>0,'prize'=>$lottery->prize_id, 'code'=>$code];
        }
        return ['ret'=>1001];
    }
    public function wxShare()
    {
        $timestamp = time();
        $count = \App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->whereNotNull('prize_id')->count();
        if( $count > 0){
            return ['ret'=>1002];
        }
        $count = \App\Lottery::where('user_id',  Session::get('wechat.id'))
            ->where('lottery_time', '>=', date('Y-m-d', $timestamp))
            ->where('lottery_time', '<=', date('Y-m-d 23:59:59', $timestamp))
            ->count();
        $user = App\WechatUser::find(Session::get('wechat.id'));
        if($count == 1){
            $user->has_shared = 1;
            $user->save();
            return ['ret'=>0];
        }
        else{
            return ['ret'=>1001];
        }
    }
    public function info(Request $request)
    {
        $info = App\Info::find(Session::get('wechat.id'));
        if( null == $info){
            $info = new App\Info();
            $info->id =  Session::get('wechat.id');
            $info->name = $request->get('name');
            $info->mobile = $request->get('mobile');
            $info->address = $request->get('address');
            $info->ip_address = $request->getClientIp();
        }
        else{
            $info->name = $request->get('name');
            $info->mobile = $request->get('mobile');
            $info->address = $request->get('address');
        }

        $info->save();
        return ['ret'=>0];
    }
}

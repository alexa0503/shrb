<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{env("PAGE_TITLE")}}</title>
<link rel="stylesheet" href="/css/main.css" />
<link rel="stylesheet" href="/css/animate.css" />
<script src="/js/jquery-2.2.0.min.js"></script>
<script src="/js/easeljs-0.8.2.min.js"></script>
<script src="/js/preloadjs-0.6.2.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/luckDraw.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="/js/wx.js"></script>
<!--移动端版本兼容 -->
<script type="text/javascript">
    var phoneWidth = parseInt(window.screen.width);
    var phoneScale = phoneWidth / 640;
    var ua = navigator.userAgent;
    if (/Android (\d+\.\d+)/.test(ua)) {
        var version = parseFloat(RegExp.$1);
        if (version > 2.3) {
            //document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
			document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
        } else {
            document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
        }
    } else {
        document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
    }
</script>
<!--移动端版本兼容 end -->
</head>

<body>
    <div class="wrap">
    	<!--朋友圈分享-->
      <div class="share">
      	<div class="shadow"></div>
        <img class="shareImg" src="/images/share.png" />
      </div>
      <!--朋友圈分享-->

      <!--首页-->
      <div class="p1">
        <div class="bgimg" style="width:640px; height:1039px; background:url(/images/noBox-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <div class="p1-img1"></div>
            <div class="p1-img2"></div>

            <!--预加载层-->
            <div class="preload-pop">
              <img class="p1-goldShade" src="/images/p1-goldshade.png" />
              <div class="p1-goldBox"></div>
              <div class="p1-piont"></div>
              <p class="p1-percent"></p>
            </div>
            <!--预加载层-->

            <!--首页按钮-->
            <div class="btn-group">
              <div class="innerDiv">
              <div class="p1-btn1"></div>
              <div class="p1-btn2"></div>
              @if ($has_award != 0)
              <div class="p1-btn3"></div>
              @endif
              <img class="btn-piont1" src="/images/p3-piont.png" />
              <img class="btn-piont2" src="/images/p3-piont.png" />
              </div>
            </div>
            <!--首页按钮-->

            <img class="p1-logo" src="/images/p1-logo.png" />
            <img class="p1-img3" src="/images/p1-img3.png" />

          </div>
        </div>
      </div>
      <!--首页结束-->

      <!--榜单loading-->
      <div class="p2">
        <div class="bgimg" style="width:640px; height:1039px; background:url(/images/sload-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

          	<img class="p2-gold" src="/images/p2-gold.png" />
            <img class="p2-piont" src="/images/p2-piont.png" />
            <img class="p2-img1" src="/images/p2-img1.png" />
            <img class="p2-d1" src="/images/11.png" />
            <img class="p2-d2" src="/images/11.png" />
            <img class="p2-d3" src="/images/11.png" />

        	</div>
        </div>
      </div>
      <!--榜单loading-->

      <!--榜单-->
      <div class="p3">
        <div class="bgimg" style="width:640px; height:1039px; background:url(/images/noBox-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <div class="p3-img1"></div>
            <div class="p3-box">

            </div>

            <div class="p3-btn2">
              <div class="innerDiv">
                <img src="/images/p3-btn2.png" />
                <img class="p3-piont1" src="/images/p3-piont.png" />
                <img class="p3-piont3" src="/images/p3-piont.png" />
              </div>
            </div>
            <div class="p3-btn3">
              <div class="innerDiv">
                <img src="/images/p3-btn3.png" />
                <img class="p3-piont2 p3-p1" src="/images/p3-piont.png" />
                <img class="p3-piont4 p3-p2" src="/images/p3-piont.png" />
              </div>
            </div>

            <img class="p3-img2" src="/images/p3-img2.png" />

            <img class="p1-img3" src="/images/p1-img3.png" />

          </div>
        </div>
      </div>
      <!--榜单-->

      <!--九宫格抽奖-->
      <div class="p4">
        <div class="bgimg" style="width:640px; height:1039px; background:url(/images/box-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <div class="p4-img1"></div>
            <div class="myBox">
              <ul class="cj1">
                <li></li>
              </ul>
            </div>

            <img class="p4-light1 p4Light1" src="/images/p4-light1.png" />
            <img class="p4-light2" src="/images/p4-light2.png" />

            <div class="bt1">
              <div class="innerDiv">
                <img src="/images/p4-start.png" />
              </div>
            </div>

            <img class="p1-img3" src="/images/p1-img3.png" />

          </div>
        </div>
      </div>
      <!--九宫格抽奖-->

      <!--一等奖-->
      <div class="p5">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p5-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

          	<img class="p5-img1" src="/images/p5-img1.png" />
            <p class="p5-w1">*点击填写<a href="javascript:;">个人完整中奖信息</a></p>
            <p class="p5-w2">*详情点击<a href="javascript:;">兑换方式及活动细则</a></p>
            <p class="p5-w3">中奖信息我们将通过短信形式同步给您，请注意查收。<br />晒出你的专属2016华氏全球富豪榜</p>
            <!--<input class="name" type="text" />
            <input class="mobil" type="tel" maxlength="11" />
            <input class="adress" type="text" />-->
            <div class="ma">
            	<img src="/images/ma.png" />
            </div>
            <a class="p5-btn" href="javascript:;"></a>

          </div>
        </div>
      </div>
      <!--一等奖-->

      <!--二等奖-->
      <div class="p6">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p6-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <p class="p6-info">格瓦拉电影票兑换码</p>
            <p class="p6-num">1240694003759234</p>
            <p class="p6-w1">*截屏保留中奖信息，详情点击<a href="javascript:;">兑换方式及活动细则</a></p>
            <p class="p6-w2">中奖信息我们将通过短信形式同步给您，请注意查收。<br />晒出你的专属2016华氏全球富豪榜</p>
          	<div class="ma1">
            	<img src="/images/ma.png" />
            </div>
            <a class="p6-btn" href="javascript:;"></a>

          </div>
        </div>
      </div>
      <!--二等奖-->

      <!--三等奖-->
      <div class="p8">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p8-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <p class="p8-info">优酷7天会员资格</p>
            <p class="p8-num">1240694003759234</p>
            <p class="p6-w1">*截屏保留中奖信息，详情点击<a href="javascript:;">兑换方式及活动细则</a></p>
            <p class="p6-w2">中奖信息我们将通过短信形式同步给您，请注意查收。<br />晒出你的专属2016华氏全球富豪榜</p>
          	<div class="ma1">
            	<img src="/images/ma.png" />
            </div>
            <a class="p6-btn" href="javascript:;"></a>

          </div>
        </div>
      </div>
      <!--三等奖-->

      <!--未中奖-->
      <div class="p7">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p7-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

          	<div class="ma1">
            	<img src="/images/ma.png" />
            </div>
            <a class="p6-btn" href="javascript:;"></a>

          </div>
        </div>
      </div>
      <!--未中奖-->
    <div class="p11">
      	<div class="bgimg" style="width: 640px; height: 1039px; background: url(&quot;/images/p11-bg.jpg&quot;) no-repeat; top: 190px;"></div>
        <div class="fix-height" style="padding-top: 205.5px;">
          <div class="relative">
          	<div class="ma1">
            	<img src="/images/ma.png">
            </div>
          </div>
        </div>
      </div>

      <!--规则-->
      <div class="p9">
        <div class="bgimg" style="width:640px; height:1039px; background:url(/images/p9-bg.jpg) no-repeat;"></div>
          <div class="fix-height">
            <div class="relative">

            	<div class="p9-box">
              	<div class="p9-rule"></div>
              </div>

              <a class="p9-close"><img src="/images/p9-close.png" /></a>

              <img class="p9-down" src="/images/p9-down.png" />

            </div>
          </div>
      </div>
      <!--规则-->

      <!--填写信息-->
      <div class="p10">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p10-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <a class="p10-close" href="javascript:;"><img src="/images/p9-close.png" /></a>

            <input class="name" type="text" />
            <input class="mobil" type="tel" maxlength="11" />
            <input class="adress" type="text" />

            <a class="p10-btn" href="javascript:;"></a>

          </div>
        </div>
      </div>
      <!--填写信息-->
      <!--新增填写信息-->
      <div class="p12">
      	<div class="bgimg" style="width:640px; height:1039px; background:url(/images/p12-bg.jpg) no-repeat;"></div>
        <div class="fix-height">
          <div class="relative">

            <a class="p12-close" href="javascript:;"><img src="/images/p9-close.png" /></a>

            <input class="mobile" type="tel" maxlength="11" placeholder="请输入您的手机号" />

            <a class="p12-btn" href="javascript:;"></a>

            <div class="ma1">
            	<img src="/images/ma.png" />
            </div>

          </div>
        </div>
      </div>
      <!--新增填写信息-->
          <!--榜单浮层-->
        <div class="showsdiv" >
           <div class="showsbox"><a href="javascript:;" onclick="jmClose();" class="cglcose"></a></div>
        </div>
        <div class="showsbgdiv"></div>
    </div>

<script>
function getAward()
{
    $.getJSON('/award', function(json){
        if(json && json.ret == 0){
            if(json.prize == 1){
                $('.p5').fadeIn();
            }
            else if(json.prize == 2){
                $('.p6').fadeIn();
            }
            else if(json.prize == 3){
                $('.p8').fadeIn();
            }
            else{
                $('.p7').fadeIn();
            }
        }
        else{
            $('.p7').fadeIn();
        }
    }).fail(function(){
        $('.p7').fadeIn();
    });
}

var prize = 0;
function lottery()
{
    $.post('/lottery',function(json){
        $('.p5,.p6,.p7,.p8,.share').hide();
        $('.cj1').empty();
        if(json && json.ret == 0){
            prize = json.prize;
            if( prize == 0 ){
                prize = Math.floor(Math.random()*10);
                if( prize < 4 || prize == 9 ) prize = 4
            }
            $('.cj1').myLuckDraw({
                row : 3, //行
                column : 3, //列
                spacing: 1, //空隙
                click : '.bt1', //点击触发
                time: 1 ,//匀速运动的时间
                end:function(e){
                    setTimeout(function(){
                        if(prize == 1){
                            $('.p5').fadeIn();
                        }
                        else if(prize == 2){
                            $('.p6').fadeIn();
                        }
                        else if(prize == 3){
                            $('.p8').fadeIn();
                        }
                        else{
                            $('.p7').fadeIn();
                        }
                        wxShare({shared:1});
                    },1000)
                    //抽奖执行完毕的回调函数,参数e为获奖编号
                    //因为这里是指定的，所以e == 5
                    //$('.jg1 em').text(e);
                }
            },prize); //这里tar是确定想要抽奖的目标是几号
            $('.p4').fadeIn();
        }
        else if( json.ret == 1001 ){
            $('.p11').fadeIn();
        }
        else if(json.ret == 1100){
            getAward();
        }
        else{
            alert(json.msg);
        }

    },"JSON");
}
$().ready(function(){
    //wxShare();
    wxShare({link:'{{$link}}'});
})
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var queue = new createjs.LoadQueue(false);
queue.loadManifest([
	{src:"/images/box-bg.jpg", id:"jpg1"},
	{src:"/images/sload-bg.jpg", id:"jpg2"},
	{src:"/images/p5-bg.jpg", id:"jpg3"},
	{src:"/images/p6-bg.jpg", id:"jpg4"},
	{src:"/images/p7-bg.jpg", id:"jpg5"},
	{src:"/images/p8-bg.jpg", id:"jpg6"},
	{src:"/images/p9-bg.jpg", id:"jpg7"},
	{src:"/images/p9-img1.png", id:"jpg8"}
]);
queue.on("progress", function(){
	$('.p1-percent').html((queue.progress * 100) + '%');
});
queue.on("complete", function(){
	setTimeout(function(){
		$('.preload-pop').fadeOut();
		$('.btn-group').fadeIn();
	},1500)
});

window.onload = function(){
	windowWH();
	p6fourSpace();
	p8fourSpace();
	timerPiont();

    ////////////////////////////////////////////////////新增JS///////////////////////////////////////////////////
    //新增页面点击关闭
    $('.p12-close').on('touchend',function(){
        $('.p12').fadeOut();
        lottery();
    });
    //中奖点击规则
	$('.p5-w2 a, .p6-w1 a, .p8-w1 a').on('touchend', function(){
		$('.p9').show();
	});

    $('.p5-w1 a').on('touchend', function(){
        $('.p10').show();
        $('.p5').hide();
    })

	//关闭填写信息
	$('.p10-close').on('touchend',function(){
		$('.p10').hide();
        $('.p5').show();
	})

	//信息提交
	$('.p10-btn').on('touchend',function(){
		var tName	= $('.name').val();
		var tMobile	= $('.mobil').val();
		var len = tMobile.length;
		var tAdress	= $('.adress').val();
		if( tName == '' || tMobile == '' || tAdress == '' ){
			alert('请完整填写信息');
		}
        else{
			if(len<11){
				alert('手机格式不对');
            }
            else{
                var data = {
                    name: tName,
                    mobile: tMobile,
                    address: tAdress
                }
                $.post('/info',data,function(json){
                    if( json.ret == 0){
                        alert('提交成功~');
                        $('.p10').hide();
                        $('.p5').show();
                        //getAward();
                    }
                    else{
                        alert(json.msg);
                    }
                },"JSON").fail(function(){
                    alert('提交失败~');
                })
				//这里提交信息
				//alert('来提交');
			}
		}
	});
	////////////////////////////////////////////////////新增JS///////////////////////////////////////////////////



	//点击我的财富按钮，此处需要判断用户中了几等奖
	$('.p1-btn3, .p3-btn1').on('touchend',function(){
        getAward();
        wxShare({shared:1});
		//一等奖
		//$('.p5').fadeIn();
		//二等奖
		//$('.p6').fadeIn();
		//三等奖
		//$('.p8').fadeIn();
		//未中奖
		//$('.p7').fadeIn();
		//p8-info、p6-info、p8-num、p6-num需要后台传过来，分别是中奖项目和号码
	})
    $('.p3-btn1').on('touchend', function(){
        //$('.p2').fadeIn();
    });

	//点击进入抽奖页面
	$('.p3-btn1').on('touchend',function () {
        $('.p4').fadeIn();
    });

	//点击进入榜单按钮
	$('.p1-btn1').on('touchend',function(){
		$('.p2').fadeIn();
        @if (!isset($id))
        var url = '/rich/list';
        @else
        var url = '/rich/list/{{$id}}';
        @endif
        $.getJSON(url,function(json){
            showjm();
            $('.p3-box').html(json.html);
            $('.p2').fadeOut();
            $('.p3').fadeIn();
            wxShare({link:json.link});
        }).fail(function(){
            alert('网络出问题了嗷~');
        })
	})

	//点击进入财富说明
	$('.p1-btn2').on('touchend',function(){
		$('.p9').fadeIn();
	})
	//关闭财富说明
	$('.p9-close').on('touchend',function(){
		$('.p9').fadeOut();
	})

  //点击保存榜单按钮,这里需要后台保存榜单功能，保存的同时执行下面的show()方法
  $('.p3-btn2').on('touchend',function () {
      //lottery();
      $('.p12').fadeIn();
  })



	//刷新榜单按钮，点击后需要出现一个假的loading画面，我做掉了，然后刷新页面里的table表单
	$('.p3-btn3').on('touchend',function(){
		$('.p3').fadeOut();
		$('.p2').fadeIn();

		$('.p3-piont2').removeClass('p3-p1').css('opacity',0);
		$('.p3-piont4').removeClass('p3-p2').css('opacity',0);
		$('.p3-piont1').addClass('p3-p1').css('opacity',1);
		$('.p3-piont3').addClass('p3-p2').css('opacity',1);
        @if (!isset($id))
        var url = '/rich/refresh';
        @else
        var url = '/rich/refresh/{{$id}}';
        @endif
        $.getJSON(url,function(json){
            $('.p3-box').html(json.html);
            $('.p2').fadeOut();
            $('.p3').fadeIn();
            wxShare({link:json.link});
        })
	});

	//点击出现朋友圈分享层
	$('.p5-btn, .p6-btn').on('touchend',function(){
		$('.share').fadeIn();
	})

	//点击朋友圈分享层关闭
	$('.share').on('touchend',function(){
		$('.share').fadeOut();
	})
}

//格式化方法
function p6fourSpace(){
	var str = $('.p6-num').html();
	str = str.replace(/(\d{4})/g,'$1 ').replace(/\s*$/,'');
	$('.p6-num').html(str);
}
function p8fourSpace(){
	var str = $('.p8-num').html();
	str = str.replace(/(\d{4})/g,'$1 ').replace(/\s*$/,'');
	$('.p8-num').html(str);
}

//数据加载省略号动画
var indexPiont = 1;
function timerPiont(){
	setInterval(function(){
		if(indexPiont <= 3){
			$('.p2-d'+indexPiont).show();
			indexPiont++;
		}else if(indexPiont > 3){
				$('.p2-d1, .p2-d2, .p2-d3').hide();
				indexPiont = 1;
			}
	},800);
}

</script>
</body>
</html>

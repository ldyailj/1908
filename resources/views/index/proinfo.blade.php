@extends('layouts.shop')
@section('title', '详情')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
         @php  $file=explode('|',$shopinfo['shop_file'])  @endphp

         @foreach($file as $vv)
      <img src="{{env('UPLOADS_URL')}}{{$vv}}" />
             @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$shopinfo->shop_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$shopinfo->shop_name}}</strong>
        <p class="hui">快把我带回家吧!</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang">
            <span  class="glyphicon glyphicon-star-empty"></span>
        </a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOADS_URL')}}{{$shopinfo->shop_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      {{$shopinfo->shop_account}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="{{url('/pro/'.$shopinfo->shop_id)}}">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
    <script src="/static/index/js/jquery.js"></script>
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
@endsection
<!-- <script src="/static/js/jquery.js"></script>
<script>
    $(document).on('click','.glyphicon',function(){
        var _this=$(this)
//     var color=_this.css('color',);
//        return alert(color)

        _this.css('color','red');
    })
</script> -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品展示</h2></center>
  
    <table class="table">
        <thead>
        <tr>
            <th>商品id</th>
            <th>商品名称</th>
            <th>商品货号</th>
            <th>商品价格</th>
            <th>商品图片</th>
            <th>商品库存</th>
            <th>商品精品</th>
            <th>商品热卖</th>
            <th>商品详情</th>
            <th>商品相册</th>
            <th>分类</th>
            <th>品牌</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
            @foreach($info as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->shop_id}}</td>
            <td>{{$v->shop_name}}</td>
            <td>{{$v->shop_art}}</td>
            <td>{{$v->shop_price}}</td>
            <td>@if($v->shop_img)<img src="{{env('UPLOAD_URL')}}{{$v->shop_img}}" width="30" height="30">@endif</td>
            <td>{{$v->shop_num}}</td>
            <td>{{$v->is_cp==1?'是':'否'}}</td>
            <td>{{$v->is_new==1?'是':'否'}}</td>
            <td>{{$v->shop_account}}</td>
            <td>
                @foreach($v->shop_file as $key=>$val)
                <img src="{{env('UPLOAD_URL')}}{{$val}}" width="30" height="30">
                @endforeach
            </td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->b_name}}</td>
            <td>
                <a href="{{url('shop/edit/'.$v->shop_id)}}" class="btn btn-info">修改</a>
                 <a href="javascript:void(0)" onclick="del({{$v['shop_id']}})">删除</a>
            </td>
        </tr>
        @endforeach
             <tr>
                 <td colspan='7'>{{$info->links()}}</td>
             </tr>
        </tbody>
    </table>
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
    <script>
        function del(id){
            if(!id){
                return;
            }
       
        if(confirm('是否确认删除')){
            //ajax删除
            $.get('/shop/destroy/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json')
        }
     } 
    </script>

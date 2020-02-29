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
<center><h2>商品修改</h2></center>

<form  action="{{url('/shop/update/'.$data->shop_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" name="shop_name" value="{{$data->shop_name}}" class="form-control" id="firstname">
            <b style="color:red">
                {{$errors->first('shop_name')}} 
            </b>
        </div>
    </div>


  <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品货号</label>
        <div class="col-sm-10">
            <input type="text" name="shop_art" value="{{$data->shop_art}}" class="form-control" id="firstname">
             <b style="color:red">
                {{$errors->first('shop_art')}} 
            </b>
        </div>
    </div>


      <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
           <input type="text" name="shop_price" value="{{$data->shop_price}}" class="form-control" id="firstname">
            <b style="color:red">
                {{$errors->first('shop_price')}} 
            </b>
        </div>
    </div>


    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-10">
            <input type="file" name="shop_img">
            <img src="{{env('UPLOAD_URL')}}{{$data->shop_img}}" width="30" height="30">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
            <input type="text" name="shop_num" value="{{$data->shop_num}}" class="form-control" id="firstname">
             <b style="color:red">
                {{$errors->first('shop_num')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否精品</label>
            <div class="radio">
                <label>
                    <input type="radio" name="is_cp" checked id="optionsRadios1" 
                    value="1" @if($data->is_cp==1) checked @endif>是
                </label>

                <label>
                    <input type="radio" name="is_cp" id="optionsRadios1" 
                    value="2" @if($data->is_cp==2)checked @endif>否
                </label>
            </div>
        </div>       

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否热卖</label>
            <div class="radio">
                <label>
                    <input type="radio" name="is_new" checked id="optionsRadios1" 
                    value="1" @if($data->is_new==1) checked @endif>是
                </label>
                <label>
                      <input type="radio" name="is_new" id="optionsRadios1" 
                      value="2" @if($data->is_new==2) checked @endif>否
                </label>
            </div>
    </div>


    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品详细</label>
        <div class="col-sm-10">
            <textarea name="shop_account">{{$data->shop_account}}</textarea>
             <b style="color:red">
                {{$errors->first('shop_account')}} 
            </b>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-10">
            <input type="file" name="shop_file[]" multiple>
                @if($data->shop_file)
                @php $files = explode('|',$data->shop_file);@endphp
                @foreach( $files as $key=>$val)
                 <img src="{{env('UPLOAD_URL')}}{{$val}}" width="30" height="30">
                @endforeach
                @endif
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-2">
            <select name="cate_id" class="form-control">
                <option value="0">&nbsp;-请选中-</option>
                @foreach($cateinfo as $k=>$v)
                 <option value="{{$v['cate_id']}}" @if($data->cate_id==$v['cate_id']) selected @endif>{!! str_repeat('&nbsp;&nbsp;',$v['level']*3)!!}{{$v['cate_name']}}</option>
                @endforeach
            </select>
            <b style="color: red">{{$errors->first('p_id')}}</b>
        </div>
    </div>

     <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">品牌</label>
            <div class="col-sm-2">
                <select name="b_id"  class="form-control">
                    <option value="">-请选中-</option>
                        @foreach($brandinfo as $k=>$v)
                            <option value="{{$v->b_id}}"
                                @if($data->b_id==$v['b_id']) selected @endif)
                                >{{$v->b_name}}</option>
                        @endforeach
                </select>
            </div>
        </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>
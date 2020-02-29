<form action="{{url('adddo')}}" method="post">
<h3>添加界面</h3>
@csrf
<input type="text" name='name'/>
<input type="number" name="age"/>
<input type="submit" value="添加"/> 
</form>
<?php


  /**无限极 
	$info 要循环处理的值
	$p_id  父级分类ID
	$level 级别 默认为0
   */
  function cateinfo($info,$p_id=0,$level=1){
    static $res=[];
    foreach($info as $k=>$v) {
        if ($v['p_id']==$p_id){
            $v['level']=$level;
            $res[] = $v;
            cateinfo($info, $v['cate_id'],$v['level'] + 1);
        }
    }
    return $res;
}

//单文件上传
   function upload($filename){
     $photo=request()->file($filename);
      if($photo->isValid()){
          $store_result=$photo->store('upload');
          return   $store_result;
      }
      exit('文件上传错误');
}

  //多个文件上传
    function Moreuploads($filename){
       $photo = request()->file($filename);
       if(!is_array($photo)){
         return;
       } 
       foreach( $photo as $v ){
          if ($v->isValid()){
            $store_result[] = $v->store('upload');
          }
       }
         
       return $store_result;
    }
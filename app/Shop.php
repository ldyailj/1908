<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
   //指定数据库中的表
   protected $table="shop";
   //指定主键
   protected $primaryKey='shop_id';
   //表名模型是否应该被打上时间戳，表里没有created_at和updated_at设为false
   public $timestamps=false;
   //黑名单
   protected $guarded=[];
}

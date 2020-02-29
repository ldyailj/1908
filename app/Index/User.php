<?php

namespace App\Index;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     //指定数据库中的表
   protected $table="user";
   //指定主键
   protected $primaryKey='u_id';
   //表名模型是否应该被打上时间戳，表里没有created_at和updated_at设为false
   public $timestamps=false;
   //黑名单
   protected $guarded=[];
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>'required|unique:people|max:12|min:2',
            'age'=>'required|integer|min:1|between:1,130',
        ];
    }

    public function messages(){
        return[
                'username.required'=>'名字不能为空',
                'username.unique'=>'名字已存在',
                'username.max'=>'名字长度不超过12位',
                'username.min'=>'名字长度不少于2位',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄必须为数字',
                'age.min'=>'年龄数据不合法',
                'age.required'=>'年龄数据不合法',
        ];
    }



}

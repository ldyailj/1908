<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreBanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'sname'=>[
                'required',
                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}$/u'],
                Rule::unique('ban')->ignore(request()->id,'sid'),    
            'sbj'=>'required',
            'scj'=>'required|between:0,100',
            
        ];
    }

    public function messages(){
        return[
                'sname.required'=>'名字不能为空',
                'sname.unique'=>'名字已存在',
                'sname.regex'=>'必须是中文、字母、下划线、数字组成、2,12位之前',
                'sbj.required'=>'班级不能为空',
                'scj.required'=>'成绩不能为空',
                'scj.max'=>'不超过100位',
        ];
    }
}

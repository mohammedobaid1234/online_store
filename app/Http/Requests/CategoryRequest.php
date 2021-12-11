<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Filter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        // dd($this->route('category'));
        $id = $this->route('category');
        return [
            //
            'name' => ['required',
                     'min:3', 
                    'string', 
                    'max:255',
                    'unique:categories,name,' . $id,

                    // function ($attribute, $value, $fail) 
                    //     {
                    //         if(stripos($value, 'gad') !== false){
                    //             $fail("you can't put $value word");
                    //         }
                    //     }
                    // new Filter(['larval' , 'php', 'gat'])
                    'Filter:php,css',
                    // Rule::unique('categories')->ignore($this->route('category'))
                   
                ],
            'parent_id'=>['nullable', 'int','exists:categories,id'],
            'description' => ['nullable', 'min:3', 'string'],
            'status'=> ['required', 'in:active,draft'],
            'image'=> ['nullable', 'image', 'dimensions:min-width:300px'] 
        ];
    }
    public function attributes()
    {
        return [
            'name' =>'Category Name',
            'parent_id' =>'parent'
        ];
    }
    public function messages()
    {
        return [
            
            'required' => ' :attribute this failed requerd ☺',
        ];
    }
}

<?php

namespace App\Http\Requests\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
        if($this->isMethod('post')) {
            return [
                'file'=>'required|file',
                'status'=>'required|in:0,1|numeric',
            ];
        }
        return [
            'file'=>'file',
            'status'=>'required|in:0,1|numeric',
        ];
    }
}

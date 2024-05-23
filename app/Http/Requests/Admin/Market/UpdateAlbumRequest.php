<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'link' => 'required|string',
            'image' => 'nullable|image',
            'video' => 'nullable|file|mimes:mp4,mpeg,mpkg,gif,odp',
            'type' => 'required|numeric',
            'status' => 'required|numeric|in:0,1'
        ];
    }
}

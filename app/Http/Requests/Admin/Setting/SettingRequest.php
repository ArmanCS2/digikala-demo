<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'logo' => 'nullable|image',
            'icon' => 'nullable|image',
            'tel' => 'nullable|string',
            'telegram' => 'nullable|string',
            'instagram' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'my_site' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'link_1' => 'nullable|string',
            'link_2' => 'nullable|string',
            'link_3' => 'nullable|string',
            'link_4' => 'nullable|string',
            'link_5' => 'nullable|string',
            'link_6' => 'nullable|string',
            'link_7' => 'nullable|string',
            'link_8' => 'nullable|string',
            'link_9' => 'nullable|string',
            'link_10' => 'nullable|string',
        ];
    }
}

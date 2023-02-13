<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'   => 'required|string|max:50',
            'slug'   => 'nullable|string|max:30|regex:/^[a-zA-Z0-9\._-]{1,}$/|unique:groups,slug',
            'link'   => 'required|max:100|url|unique:groups,link',
            'image'  => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'tags' => 'nullable|array|max:5|exists:tags,slug',
        ];
    }

    protected function passedValidation()
    {
        if ($this->tags)
            $this->replace(['tags' => Tag::whereIn('slug', $this->tags)->pluck('id')->toArray()]);
    }


    public function messages()
    {
        return [
            'slug.regex'       => 'نام انگلیسی فقط میتواند شامل حروف انگلیسی، اعداد و _ - . باشد.',
        ];
    }
}

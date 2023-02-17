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
            'name'        => 'required|string|max:50',
            'slug'        => 'nullable|string|max:30|regex:/^[a-zA-Z0-9\._-]{1,}$/|unique:groups,slug',
            'description' => 'nullable|string|max:10000',
            'link'        => 'required|max:100|url|unique:groups,link',
            'support_link'        => 'nullable|max:100|url',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,webp,gif|max:2048',
            'tags'        => 'nullable|array|max:5|exists:tags,slug',
        ];
    }

    protected function passedValidation()
    {
        if ($this->tags)
            $this->replace(['tags' => Tag::whereIn('slug', $this->tags)->pluck('id')->toArray()]);
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            'description' => strip_tags($this->description),
        ]);
    }


    public function messages()
    {
        return [
            'slug.regex' => ':attribute فقط میتواند شامل حروف انگلیسی، اعداد و _ - . باشد.',
        ];
    }
}

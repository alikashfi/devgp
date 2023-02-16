<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'group'   => 'required|string|exists:groups,slug',
            'name'    => 'required|string|max:30',
            'email'   => 'nullable|email|max:100',
            'message' => 'required|string|max:10000',
        ];
    }

    protected function passedValidation()
    {
        return $this->merge(['group_id' => Group::whereSlug($this->group)->first()->id]);
    }
}

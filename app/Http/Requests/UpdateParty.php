<?php

namespace KnessetRollCall\Http\Requests;

use KnessetRollCall\Http\Requests\Request;

class UpdateParty extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:parties'
        ];
    }
}

<?php

namespace KnessetRollCall\Http\Requests;

use Illuminate\Support\Facades\Auth;
use KnessetRollCall\Http\Requests\Request;

class UpdateUser extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . Auth::user()->id,
            'password' => 'required_with:password_confirmation',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}
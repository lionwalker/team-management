<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:team_members,email',
            'telephone' => 'required|string|max:15',
            'joined_date' => 'required|string|max:15|date_format:Y-m-d'
        ];
    }
}

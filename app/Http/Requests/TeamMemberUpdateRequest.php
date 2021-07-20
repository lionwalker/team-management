<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamMemberUpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'string',
                Rule::unique('team_members', 'id')->ignore($this->id)
            ],
            'telephone' => 'required|string|max:15',
            'joined_date' => 'required|string|max:15|date_format:Y-m-d'
        ];
    }
}

<?php

namespace App\Http\Requests\Teams;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class DeleteTeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $team = $this->route('team');

                if ($this->input('name') !== $team->name) {
                    $validator->errors()->add('name', __('The team name does not match.'));
                }
            },
        ];
    }
}

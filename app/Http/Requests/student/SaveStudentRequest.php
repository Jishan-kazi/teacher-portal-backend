<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SaveStudentRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required|max:40',
            'subject' => 'required|max:40',
            'marks' => 'required|numeric|min:0|max:100',
        ];

        if (null !== $this->route('id') && !empty($this->route('id'))) {
            $rules['name'] = Rule::unique('students', 'name')->where('subject', $this->input('subject'))->ignore($this->route('id'));
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.unique' => 'Student with this name & subject already exists.',
        ];
    }
}

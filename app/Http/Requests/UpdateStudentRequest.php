<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'roll_number' => [
                'string',
                'min:11',
                'required',
                'unique:students,roll_number,' . request()->route('student')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
            'centre' => [
                'required',
            ],
        ];
    }
}

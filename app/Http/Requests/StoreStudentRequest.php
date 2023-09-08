<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_create');
    }

    public function rules()
    {
        return [
            'roll_number' => [
                'string',
                'min:11',
                'required',
                'unique:students',
              
                
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
            'fee_paid' => [
                'required',
            ],
        ];
    }
}

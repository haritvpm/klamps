<?php

namespace App\Http\Requests;

use App\Models\HallTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHallTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hall_ticket_edit');
    }

    public function rules()
    {
        return [
            'roll_number' => [
                'string',
                'min:11',
                'required',
            ],
        ];
    }
}

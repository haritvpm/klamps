<?php

namespace App\Http\Requests;

use App\Models\HallTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHallTicketRequest extends FormRequest
{
    public function authorize()
    {
        return 1;// Gate::allows('hall_ticket_create');
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

<?php

namespace App\Http\Requests;

use App\Models\HallTicket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHallTicketRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hall_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hall_tickets,id',
        ];
    }
}

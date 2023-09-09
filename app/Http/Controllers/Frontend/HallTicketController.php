<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHallTicketRequest;
use App\Http\Requests\StoreHallTicketRequest;
use App\Models\HallTicket;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PDF;
class HallTicketController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hall_ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hallTickets = HallTicket::all();

        return view('frontend.hallTickets.index', compact('hallTickets'));
    }

    public function create()
    {
     //   abort_if(Gate::denies('hall_ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.hallTickets.create');
    }

    public function store(StoreHallTicketRequest $request)
    {
       
       $student = Student::where ( 'roll_number', $request->roll_number)->first();
    
       if(!$student){
        return redirect()->back()->withInput()->withErrors(['Invalid enrolment number!']);  
       }

       if( $student->fee_paid != 'y' ){
        return redirect()->back()->withInput()->withErrors(['Fee not paid!']);  

       }

      // dd( public_path("storage/images/apple.png") );
       //dd($student->getPhoto());


       $hallTicket = HallTicket::where('roll_number', $request->roll_number)->first();

       if($hallTicket){
            $hallTicket->update(['count' => $hallTicket->count+1 ]);
       }
       else {
            $hallTicket = HallTicket::create( [
                'roll_number' =>  $request->roll_number,
                'count' => 1,
            ]
            );
       }


       $pdf = PDF::loadView('frontend.hallTickets.show', compact('student'));
                 
       return $pdf->download('hallticket2023.pdf');
//       return view('frontend.hallTickets.show', compact('student'));
    }

    public function show(HallTicket $hallTicket)
    {
        //abort_if(Gate::denies('hall_ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $student = Student::where ( 'roll_number', $request->roll_number)->first();

        return view('frontend.hallTickets.show', compact('student'));
    }

    public function destroy(HallTicket $hallTicket)
    {
        abort_if(Gate::denies('hall_ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hallTicket->delete();

        return back();
    }

    public function massDestroy(MassDestroyHallTicketRequest $request)
    {
        $hallTickets = HallTicket::find(request('ids'));

        foreach ($hallTickets as $hallTicket) {
            $hallTicket->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

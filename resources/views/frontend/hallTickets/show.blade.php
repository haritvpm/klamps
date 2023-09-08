@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           
                <div >
                    <img src= "/klamps_logo600w.jpg" width = '150' class="mx-auto d-block">

                    <h3 class="text-center font-weight-light">KERALA LEGISLATIVE  ASSEMBLY MEDIA & PARLIAMENTARY STUDY CENTRE</h3>
                    <h4 class="text-center font-weight-light">CERTIFICATE COURSE IN PARLIAMENTARY PRACTICE AND PROCEDURE</h4>
                    <h4 class="text-center font-weight-light">EXAMINATION  2023</h4>
                    <h5 class="text-center font-weight-bold">HALL TICKET</h5>
                    
                </div>

        </div>
    </div>


    <div class="row d-flex justify-content-between">
        <div class="col-md-5 my-auto ml-5">
            Year : {{$hallTicket->getYear()}} <br>
            Batch : {{$hallTicket->getBatch()}}
        </div>
        <div class="col-md-5 mr-5">

                <div class="float-right">
                            @if($hallTicket->photo)
                                <a href="{{ $hallTicket->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $hallTicket->photo->getUrl('') }}"  width='90px'>
                                </a>
                            @else
                                <img src= "{{  $hallTicket->getFallbackPhoto()}}" width='90px'>
                            @endif
                </div>
        </div>
    </div>
            

    <div class="row justify-content-center">
        <div class="col-md-12">
                    <div class="mx-5 mt-5">
                    <table class="table table-bordered">
                        <tbody>
                            
                            <tr>
                                <th style="width: 20%">
                                    {{ trans('cruds.hallTicket.fields.roll_number') }}
                                </th>
                                <td class="text-monospace">
                                    {{ $hallTicket->roll_number }}
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 20%">
                                    {{ trans('cruds.student.fields.name') }}
                                </th>
                                <td>
                                    {{ $hallTicket->name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                            

        </div>
    </div>



    
    <div class="row justify-content-center">
        <div class="col-md-12">
                    <div class="mx-5 mt-5">
                    <table class="table table-bordered">
                        <tbody>
                            
                            <tr>
                                <th  style="width: 20%" class="align-middle" rowspan="2">
                                    Examination
                                </th>
                                <td >
                                    Date
                                </td>
                                <td class="text-center">
                                    30.09.2023  and  01.09.2023  
                                </td>
                            </tr>
                            <tr>
                              
                                <td >
                                    Time
                                </td>
                                <td class="text-center">
                                10.00 am – 12.30 pm   and   2.00 pm – 4.30 pm 
                                </td>
                            </tr>

                            <tr>
                                <th colspan="2">
                                    Center Of Exam
                                </th>
                                <td class="text-center">
                                    {{ $hallTicket->centre }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                            

        </div>
    </div>



</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.hallTicket.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                       
                        <table class="table table-bordered table-striped">
                            <tbody>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.hallTicket.fields.roll_number') }}
                                    </th>
                                    <td>
                                        {{ $hallTicket->roll_number }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
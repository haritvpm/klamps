@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                <h6 class="text-center font-weight-light">KERALA LEGISLATIVE  ASSEMBLY MEDIA & PARLIAMENTARY STUDY CENTRE</h6>
                    <h6 class="text-center font-weight-light">CERTIFICATE COURSE IN PARLIAMENTARY PRACTICE AND PROCEDURE</h6>
                   <h4 class="text-center">{{ trans('cruds.hallTicket.title_singular') }}</h4> 

                <div class="card-body">

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if($errors->count() > 0)
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

                    <form method="POST" action="{{ route('hallticket.store') }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="roll_number">{{ trans('cruds.hallTicket.fields.roll_number') }} (11 digits)</label>
                            <input class="form-control" type="text" pattern="^\S+$" name="roll_number" id="roll_number" value="{{ old('roll_number', '') }}" required>
                            @if($errors->has('roll_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roll_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.hallTicket.fields.roll_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                          
                            <button class="btn btn-danger" type="submit" name="action" value="download">Download</button>
                            <button class="btn btn-info" type="submit" name="action" value="view">View</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hallTicket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hall-tickets.update", [$hallTicket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="roll_number">{{ trans('cruds.hallTicket.fields.roll_number') }}</label>
                <input class="form-control {{ $errors->has('roll_number') ? 'is-invalid' : '' }}" type="text" name="roll_number" id="roll_number" value="{{ old('roll_number', $hallTicket->roll_number) }}" required>
                @if($errors->has('roll_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roll_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hallTicket.fields.roll_number_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
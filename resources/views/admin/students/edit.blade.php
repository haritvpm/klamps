@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="roll_number">{{ trans('cruds.student.fields.roll_number') }}</label>
                <input class="form-control {{ $errors->has('roll_number') ? 'is-invalid' : '' }}" type="text"  pattern="^\S+$" name="roll_number" id="roll_number" value="{{ old('roll_number', $student->roll_number) }}" required>
                @if($errors->has('roll_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roll_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.roll_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.student.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.student.fields.fee_paid') }}</label>
                <select class="form-control {{ $errors->has('fee_paid') ? 'is-invalid' : '' }}" name="fee_paid" id="fee_paid">
                    <option value disabled {{ old('fee_paid', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::FEE_PAID_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('fee_paid', $student->fee_paid) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('fee_paid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fee_paid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.fee_paid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.student.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.centre') }}</label>
                <select class="form-control {{ $errors->has('centre') ? 'is-invalid' : '' }}" name="centre" id="centre" required>
                    <option value disabled {{ old('centre', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::CENTRE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('centre', $student->centre) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('centre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('centre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.centre_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.students.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpg',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 300,
      height: 400
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($student) && $student->photo)
      var file = {!! json_encode($student->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection
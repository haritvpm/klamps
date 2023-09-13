@extends('layouts.admin')
@section('content')
@can('student_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.students.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.student.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Student', 'route' => 'admin.students.parseCsvImport'])
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
              
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.students.uploadPhotos') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Choose Photos (300x400, jpg) upload 20 at a time </label>
                            <input type="file"  name="images[]" multiple>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> 

@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.student.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Student">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.student.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.student.fields.roll_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.student.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.student.fields.fee_paid') }}
                        </th>
                        <th>
                            {{ trans('cruds.student.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.student.fields.centre') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                        <tr data-entry-id="{{ $student->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $student->id ?? '' }}
                            </td>
                            <td>
                                {{ $student->roll_number ?? '' }}
                            </td>
                            <td>
                                {{ $student->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Student::FEE_PAID_SELECT[$student->fee_paid] ?? '' }}
                            </td>
                            <td>
                                @if($student->photo)
                                    <a href="{{ $student->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $student->photo->getUrl('thumb') }}">
                                    </a>
                                @else
                                
                                        <img src= "{{  $student->getFallbackPhoto()}}" width='50'>
                                   
                                @endif
                            </td>
                            <td>
                                {{ App\Models\Student::CENTRE_SELECT[$student->centre] ?? '' }}
                            </td>
                            <td>
                                @can('student_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.students.show', $student->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-success" href="{{ route('admin.students.showHallTicket', $student->id) }}">
                                        HT
                                    </a>
                                    
                                @endcan

                                @can('student_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.students.edit', $student->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_delete')
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.students.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Student:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
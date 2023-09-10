@extends('layouts.admin')
@section('content')
@can('hall_ticket_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.hall-tickets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.hallTicket.title_singular') }}
            </a>
        </div>
    </div>

@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.hallTicket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-HallTicket">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.hallTicket.fields.roll_number') }}
                        </th>
                        
                        <th>
                            Downloaded
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hallTickets as $key => $hallTicket)
                        <tr data-entry-id="{{ $hallTicket->id }}">
                            <td>

                            </td>
                            <td>
                               {{ $hallTicket->roll_number ?? '' }}
                            </td>
                            <td>
                            {{ $hallTicket->count ?? '' }}
                            </td>
                            <td>
                            {{ $hallTicket->updated_at->toDateString() ?? '' }}
                            </td>
                            <td>
                                @can('hall_ticket_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hall-tickets.show', $hallTicket->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('hall_ticket_delete')
                                    <form action="{{ route('admin.hall-tickets.destroy', $hallTicket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('hall_ticket_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hall-tickets.massDestroy') }}",
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
  let table = $('.datatable-HallTicket:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
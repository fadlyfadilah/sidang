@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('skpi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('user.skpis.create') }}">
                            Tambah Skpi
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    Daftar Skpi
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Skpi">
                            <thead>
                                <tr>
                                    <th>
                                        NPM
                                    </th>
                                    <th>
                                        Nama Kegiatan (Bahasa Indonesia)
                                    </th>
                                    <th>
                                        Nama Kegiatan (Bahasa Inggris)
                                    </th>
                                    <th>
                                        Keterangan
                                    </th>
                                    <th>
                                        File
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skpis as $key => $skpi)
                                    <tr data-entry-id="{{ $skpi->id }}">
                                        <td>
                                            {{ $skpi->nama->nik ?? '' }}
                                        </td>
                                        <td>
                                            {{ $skpi->kualifikasi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $skpi->kegiatan ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Skpi::KETERANGAN_SELECT[$skpi->keterangan] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($skpi->file as $key => $media)
                                                <a href="https://{{ $media->getUrl() }}" target="_blank">
                                                    View File
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('skpi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('user.skpis.show', $skpi->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            @can('skpi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('user.skpis.edit', $skpi->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('skpi_delete')
                                                <form action="{{ route('user.skpis.destroy', $skpi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('skpi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('user.skpis.massDestroy') }}",
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
  let table = $('.datatable-Skpi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
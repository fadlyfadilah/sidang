@extends('layouts.admin')
@section('content')
<div class="content">
    @can('syarat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.syarats.create') }}">
                    Tambah Syarat Sidang
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Syarat Sidang
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-syarat">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        Mahasiswa
                                    </th>
                                    <th>
                                        Skripsi
                                    </th>
                                    <th>
                                        Pas Photo
                                    </th>
                                    <th>
                                        Sertifikat Pesantren Calon Sarjana
                                    </th>
                                    <th>
                                        Sertifikat Bebas Perpus
                                    </th>
                                    <th>
                                        Sertifikat Pesantren Maba
                                    </th>
                                    <th>
                                        Transkrip Nilai
                                    </th>
                                    <th>
                                        Bukti Pembayaran
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($syarats as $key => $syarat)
                                    <tr data-entry-id="{{ $syarat->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $syarat->mahasiswa->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->skripsi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->photo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->serticalonsarjana ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->sertibebasperpus ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->sertimaba ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->bebaslab ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->transkrip ?? '' }}
                                        </td>
                                        <td>
                                            {{ $syarat->pembayaran ?? '' }}
                                        </td>
                                        <td>
                                            @can('syarat_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.syarats.show', $syarat->id) }}">
                                                    View
                                                </a>
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
@can('syarat_delete')
  let deleteButtonTrans = 'Delete'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.syarats.massDestroy') }}",
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
  let table = $('.datatable-syarat:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
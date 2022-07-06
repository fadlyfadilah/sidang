@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('mahasiswa_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.mahasiswas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.mahasiswa.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.mahasiswa.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Mahasiswa">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.npm') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.prodi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.tempat_lahir') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.ttl') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.alamat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.no_hp') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.asal_sekolah') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mahasiswa.fields.medsos') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswas as $key => $mahasiswa)
                                    <tr data-entry-id="{{ $mahasiswa->id }}">
                                        <td>
                                            {{ $mahasiswa->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->npm ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Mahasiswa::PRODI_SELECT[$mahasiswa->prodi] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->tempat_lahir ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->ttl ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->alamat ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->no_hp ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->asal_sekolah ?? '' }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->medsos ?? '' }}
                                        </td>
                                        <td>
                                            @can('mahasiswa_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.mahasiswas.show', $mahasiswa->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('mahasiswa_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.mahasiswas.edit', $mahasiswa->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('mahasiswa_delete')
                                                <form action="{{ route('frontend.mahasiswas.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mahasiswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.mahasiswas.massDestroy') }}",
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
  let table = $('.datatable-Mahasiswa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
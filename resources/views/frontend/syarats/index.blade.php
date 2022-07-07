@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-uppercase">{{ auth()->user()->name }} | {{ auth()->user()->nik }}</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Syarat Sidang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table>

                            <form method="POST" action="{{ route('frontend.orangtuas.store') }}" enctype="multipart/form-data">
                                @csrf
                                <th>
                                    <div class="form-group {{ $errors->has('skripsi') ? 'has-error' : '' }}">
                                        <label class="required" for="skripsi">File Skripsi</label>
                                        <input class="form-control-file" type="file" name="skripsi" id="skripsi" value="{{ old('skripsi', '') }}" required>
                                        @if($errors->has('skripsi'))
                                            <span class="help-block" role="alert">{{ $errors->first('skripsi') }}</span>
                                        @endif
                                    </div>
                                </th>
                                <td>
                                    @if ($syarat === null)
                                    <a href="#"></a>
                                    @else
                                    <a href="{{ asset("/storage/".$syarat->skripsi) }}">{{ $syarat->skripsi }}</a>
                                    @endif
                                </td>
                                <td>
                                    
                                </td>
                                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                    <label class="required" for="photo">Pas Photo</label>
                                    <input class="form-control-file" type="file" name="photo" id="photo" value="{{ old('photo', '') }}" required>
                                    @if($errors->has('photo'))
                                        <span class="help-block" role="alert">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('serticalonsarjana') ? 'has-error' : '' }}">
                                    <label class="required" for="serticalonsarjana">Sertifikat Pesantren Calon Sarjana</label>
                                    <input class="form-control-file" type="file" name="serticalonsarjana" id="serticalonsarjana" value="{{ old('serticalonsarjana', '') }}" required>
                                    @if($errors->has('serticalonsarjana'))
                                        <span class="help-block" role="alert">{{ $errors->first('serticalonsarjana') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('sertibebasperpus') ? 'has-error' : '' }}">
                                    <label class="required" for="sertibebasperpus">Sertifikat Bebas Perpus</label>
                                    <input class="form-control-file" type="file" name="sertibebasperpus" id="sertibebasperpus" value="{{ old('sertibebasperpus', '') }}" required>
                                    @if($errors->has('sertibebasperpus'))
                                        <span class="help-block" role="alert">{{ $errors->first('sertibebasperpus') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('sertimaba') ? 'has-error' : '' }}">
                                    <label class="required" for="sertimaba">Sertifikat Pesantren Maba</label>
                                    <input class="form-control-file" type="file" name="sertimaba" id="sertimaba" value="{{ old('sertimaba', '') }}" required>
                                    @if($errors->has('sertimaba'))
                                        <span class="help-block" role="alert">{{ $errors->first('sertimaba') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('bebaslab') ? 'has-error' : '' }}">
                                    <label class="" for="bebaslab">Sertifikat Bebas Lab</label>
                                    <input class="form-control-file" type="file" name="bebaslab" id="bebaslab" value="{{ old('bebaslab', '') }}" required>
                                    @if($errors->has('bebaslab'))
                                        <span class="help-block" role="alert">{{ $errors->first('bebaslab') }}</span>
                                    @endif
                                    <span class="help-block">Hanya Prodi Farmasi</span>
                                </div>
                                <div class="form-group {{ $errors->has('transkrip') ? 'has-error' : '' }}">
                                    <label class="required" for="transkrip">File Transkrip</label>
                                    <input class="form-control-file" type="file" name="transkrip" id="transkrip" value="{{ old('transkrip', '') }}" required>
                                    @if($errors->has('transkrip'))
                                        <span class="help-block" role="alert">{{ $errors->first('transkrip') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('pembayaran') ? 'has-error' : '' }}">
                                    <label class="required" for="pembayaran">Bukti Pembayaran</label>
                                    <input class="form-control-file" type="file" name="pembayaran" id="pembayaran" value="{{ old('pembayaran', '') }}" required>
                                    @if($errors->has('pembayaran'))
                                        <span class="help-block" role="alert">{{ $errors->first('pembayaran') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('mahasiswa_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('frontend.mahasiswas.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Mahasiswa:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
@extends('layouts.admin')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detail Data Sidang
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.syarats.index') }}">
                                    Kembali Ke Daftar
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            Mahasiswa
                                        </th>
                                        <td>
                                            {{ $syarat->mahasiswa->user->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Skripsi
                                        </th>
                                        <td>
                                            {{ $syarat->skripsi }}
                                        </td>
                                        <td class="d-flex">
                                            @if ($syarat->skripsistatus == 0)
                                                <i class="fa-2x fas fa-times text-danger"></i>
                                                <div>
                                                    <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="skripsistatus" value="1">
                                                        <button class="btn btn-success btn-sm" type="submit">Verif</button>
                                                    </form>
                                                </div>
                                            @elseif ($syarat->skripsistatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Pas Photo
                                        </th>
                                        <td>
                                            {{ $syarat->photo ?? '' }}
                                        </td>
                                        <td class="d-flex">
                                            @if ($syarat->photostatus == 0)
                                                <div>
                                                    <i class="fa-2x fas fa-ellipsis-h"></i>
                                                </div>
                                                <div>
                                                    <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="form-group">
                                                            <select class="form-control" name="photostatus"
                                                                id="photostatus">
                                                                <option selected hidden>Pilih Salah Satu!</option>
                                                                <option value="1">Tolak</option>
                                                                <option value="2">Approve</option>
                                                            </select>
                                                        </div>
                                                        <button class="btn btn-success btn-sm" type="submit">Verif</button>
                                                    </form>
                                                </div>
                                            @elseif ($syarat->photostatus == 1)
                                                <i class="fas fa-times fa-2x text-danger"></i>
                                            @elseif ($syarat->photostatus == 2)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Serti Calon Sarjana
                                        </th>
                                        <td>
                                            {{ $syarat->serticalonsarjana }}
                                        </td>
                                        <td>
                                            @if ($syarat->serticalonsarjanastatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="serticalonsarjanastatus"
                                                                value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->serticalonsarjanastatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Serti Bebas Perpus
                                        </th>
                                        <td>
                                            {{ $syarat->sertibebasperpus }}
                                        </td>
                                        <td>
                                            @if ($syarat->sertibebasperpusstatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="sertibebasperpusstatus"
                                                                value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->sertibebasperpusstatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Serti Maba
                                        </th>
                                        <td>
                                            {{ $syarat->sertimaba }}
                                        </td>
                                        <td>
                                            @if ($syarat->sertimabastatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="sertimabastatus" value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->sertimabastatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Bebas Lab
                                        </th>
                                        <td>
                                            {{ $syarat->bebaslab }}
                                        </td>
                                        <td>
                                            @if ($syarat->bebaslabstatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="bebaslabstatus" value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->bebaslabstatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Transkrip
                                        </th>
                                        <td>
                                            {{ $syarat->transkrip }}
                                        </td>
                                        <td>
                                            @if ($syarat->transkripstatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="transkripstatus" value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->transkripstatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Pembayaran
                                        </th>
                                        <td>
                                            {{ $syarat->pembayaran }}
                                        </td>
                                        <td>
                                            @if ($syarat->pembayaranstatus == 0)
                                                <div class="d-flex">
                                                    <i class="fa-2x fas fa-times text-danger"></i>
                                                    <div>
                                                        <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="pembayaranstatus" value="1">
                                                            <button class="btn btn-success btn-sm"
                                                                type="submit">Verif</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif ($syarat->pembayaranstatus == 1)
                                                <i class="fas fa-check fa-2x text-success"></i>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option selected hidden>Pilih Salah Satu!</option>
                                            <option value="Verivikasi Admin">Verivikasi Admin</option>
                                            <option value="Verivikasi Kasie Akademik">Verivikasi Kasie Akademik</option>
                                            <option value="Vevivikasi Wakil Dekan 1">Vevivikasi Wakil Dekan 1</option>
                                        </select>
                                    </div>
                                    <button class="mb-3 btn btn-success btn-sm" type="submit">Kirim</button>
                                </form>
                            </div>
                            <div class="form-group">
                                <form action="{{ route('admin.syarats.update', $syarat->id) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="feedback">Feedback</label>
                                        <textarea class="form-control" name="feedback" id="feedback" rows="3"></textarea>
                                    </div>
                                    <button class="mb-3 btn btn-success btn-sm" type="submit">Kirim</button>
                                </form>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('admin.syarats.index') }}">
                                    Kembali Ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection

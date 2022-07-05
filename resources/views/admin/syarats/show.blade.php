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
                                </tr>
                                <tr>
                                    <th>
                                        Pas Photo
                                    </th>
                                    <td>
                                        {{ $syarat->photo ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Serti Calon Sarjana
                                    </th>
                                    <td>
                                        {{ $syarat->serticalonsarjana }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Serti Bebas Perpus
                                    </th>
                                    <td>
                                        {{ $syarat->sertibebasperpus }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Serti Maba
                                    </th>
                                    <td>
                                        {{ $syarat->sertimaba }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Bebas Lab
                                    </th>
                                    <td>
                                        {{ $syarat->bebaslab }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Transkrip
                                    </th>
                                    <td>
                                        {{ $syarat->transkrip }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Pembayaran
                                    </th>
                                    <td>
                                        {{ $syarat->pembayaran }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
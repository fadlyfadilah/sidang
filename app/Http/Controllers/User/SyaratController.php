<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrangtuaRequest;
use App\Http\Requests\StoreOrangtuaRequest;
use App\Http\Requests\UpdateOrangtuaRequest;
use App\Models\Mahasiswa;
use App\Models\Orangtua;
use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SyaratController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('syarat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $syarat = Syarat::where('mahasiswa_id', $mahasiswa->id)->first();

        return view('user.syarats.index', compact('syarat'));
    }

    public function create()
    {
        abort_if(Gate::denies('syarat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();
        return view('user.syarats.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $syarat = Syarat::where('mahasiswa_id', $mahasiswa->id)->first();
        $number = rand(0, 1000);
        if (request()->file('skripsi')) {
            if ($syarat === null) {
                $skripsi = request()->file('skripsi');
                $skripsiUrl = $skripsi->storeAs('file/syarat/skripsi', "{$number}skripsi.{$skripsi->extension()}");
            } else {
                Storage::delete($syarat->skripsi);
                $skripsi = request()->file('skripsi');
                $skripsiUrl = $skripsi->storeAs('file/syarat/skripsi', "{$number}skripsi.{$skripsi->extension()}");
            }
        } else {
            $skripsiUrl = $syarat->skripsi;
        }
        if (request()->file('photo')) {
            if ($syarat === null) {
                $photo = request()->file('photo');
                $photoUrl = $photo->storeAs('file/syarat/photo', "{$number}photo.{$photo->extension()}");
            } else {
                Storage::delete($syarat->photo);
                $photo = request()->file('photo');
                $photoUrl = $photo->storeAs('file/syarat/photo', "{$number}photo.{$photo->extension()}");
            }
        } else {
            $photoUrl = $syarat->photo;
        }
        if (request()->file('serticalonsarjana')) {
            if ($syarat === null) {
                $serticalonsarjana = request()->file('serticalonsarjana');
                $serticalonsarjanaUrl = $serticalonsarjana->storeAs('file/syarat/serticalonsarjana', "{$number}serticalonsarjana.{$serticalonsarjana->extension()}");
            } else {
                Storage::delete($syarat->serticalonsarjana);
                $serticalonsarjana = request()->file('serticalonsarjana');
                $serticalonsarjanaUrl = $serticalonsarjana->storeAs('file/syarat/serticalonsarjana', "{$number}serticalonsarjana.{$serticalonsarjana->extension()}");
            }
        } else {
            $serticalonsarjanaUrl = $syarat->serticalonsarjana;
        }
        if (request()->file('sertibebasperpus')) {
            if ($syarat === null) {
                $sertibebasperpus = request()->file('sertibebasperpus');
                $sertibebasperpusUrl = $sertibebasperpus->storeAs('file/syarat/sertibebasperpus', "{$number}sertibebasperpus.{$sertibebasperpus->extension()}");
            } else {
                Storage::delete($syarat->sertibebasperpus);
                $sertibebasperpus = request()->file('sertibebasperpus');
                $sertibebasperpusUrl = $sertibebasperpus->storeAs('file/syarat/sertibebasperpus', "{$number}sertibebasperpus.{$sertibebasperpus->extension()}");
            }
        } else {
            $sertibebasperpusUrl = $syarat->sertibebasperpus;
        }
        if (request()->file('sertimaba')) {
            if ($syarat === null) {
                $sertimaba = request()->file('sertimaba');
                $sertimabaUrl = $sertimaba->storeAs('file/syarat/sertimaba', "{$number}sertimaba.{$sertimaba->extension()}");
            } else {
                Storage::delete($syarat->sertimaba);
                $sertimaba = request()->file('sertimaba');
                $sertimabaUrl = $sertimaba->storeAs('file/syarat/sertimaba', "{$number}sertimaba.{$sertimaba->extension()}");
            }
        } else {
            $sertimabaUrl = $syarat->sertimaba;
        }
        if (request()->file('bebaslab')) {
            if ($syarat === null) {
                $bebaslab = request()->file('bebaslab');
                $bebaslabUrl = $bebaslab->storeAs('file/syarat/bebaslab', "{$number}bebaslab.{$bebaslab->extension()}");
            } else {
                Storage::delete($syarat->bebaslab);
                $bebaslab = request()->file('bebaslab');
                $bebaslabUrl = $bebaslab->storeAs('file/syarat/bebaslab', "{$number}bebaslab.{$bebaslab->extension()}");
            }
        } else {
            $bebaslabUrl = $syarat->bebaslab;
        }
        if (request()->file('transkrip')) {
            if ($syarat === null) {
                $transkrip = request()->file('transkrip');
                $transkripUrl = $transkrip->storeAs('file/syarat/transkrip', "{$number}transkrip.{$transkrip->extension()}");
            } else {
                Storage::delete($syarat->transkrip);
                $transkrip = request()->file('transkrip');
                $transkripUrl = $transkrip->storeAs('file/syarat/transkrip', "{$number}transkrip.{$transkrip->extension()}");
            }
        } else {
            $transkripUrl = $syarat->transkrip;
        }
        if (request()->file('pembayaran')) {
            if ($syarat === null) {
                $pembayaran = request()->file('pembayaran');
                $pembayaranUrl = $pembayaran->storeAs('file/syarat/pembayaran', "{$number}pembayaran.{$pembayaran->extension()}");
            } else {
                Storage::delete($syarat->pembayaran);
                $pembayaran = request()->file('pembayaran');
                $pembayaranUrl = $pembayaran->storeAs('file/syarat/pembayaran', "{$number}pembayaran.{$pembayaran->extension()}");
            }
        } else {
            $pembayaranUrl = $syarat->pembayaran;
        }
        $syarats = Syarat::updateOrCreate([
            'mahasiswa_id'   => $mahasiswa->id,
        ], [
            'skripsi'     => $skripsiUrl,
            'photo' => $photoUrl,
            'serticalonsarjana'    => $serticalonsarjanaUrl,
            'sertibebasperpus'   => $sertibebasperpusUrl,
            'sertimaba'       => $sertimabaUrl,
            'bebaslab'   => $bebaslabUrl,
            'transkrip'   => $transkripUrl,
            'pembayaran'   => $pembayaranUrl,
        ]);

        return redirect()->route('user.syarats.index');
    }

    public function edit(Syarat $syarat)
    {
        abort_if(Gate::denies('syarat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();

        $syarat->load('mahasiswa');

        return view('user.syarats.edit', compact('mahasiswas', 'syarat'));
    }

    public function update(Request $request, Syarat $syarat)
    {
        $syarat->update($request->all());

        return redirect()->back();
    }

    public function show(Syarat $syarat)
    {
        abort_if(Gate::denies('syarat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $syarat->load('mahasiswa');

        return view('user.syarats.show', compact('syarat'));
    }

    public function destroy(Orangtua $orangtua)
    {
        abort_if(Gate::denies('syarat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orangtua->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrangtuaRequest $request)
    {
        Orangtua::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

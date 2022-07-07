<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrangtuaRequest;
use App\Http\Requests\StoreOrangtuaRequest;
use App\Http\Requests\UpdateOrangtuaRequest;
use App\Models\Mahasiswa;
use App\Models\Orangtua;
use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SyaratController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('syarat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $syarat = Syarat::where('mahasiswa_id', auth()->user()->id)->first();

        return view('frontend.syarats.index', compact('syarat'));
    }

    public function create()
    {
        abort_if(Gate::denies('syarat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get();
        return view('frontend.syarats.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();

        $syarat = $request->all();
        $number = rand(0, 1000);
        $skripsi = request()->file('skripsi');
        $skripsiUrl = $skripsi->storeAs('file/syarat/skripsi', "{$number}skripsi.{$skripsi->extension()}");
        $photo = request()->file('photo');
        $photoUrl = $photo->storeAs('file/syarat/photo', "{$number}photo.{$photo->extension()}");
        $serticalonsarjana = request()->file('serticalonsarjana');
        $serticalonsarjanaUrl = $serticalonsarjana->storeAs('file/syarat/serticalonsarjana', "{$number}serticalonsarjana.{$serticalonsarjana->extension()}");
        $sertibebasperpus = request()->file('sertibebasperpus');
        $sertibebasperpusUrl = $sertibebasperpus->storeAs('file/syarat/sertibebasperpus', "{$number}sertibebasperpus.{$sertibebasperpus->extension()}");
        $sertimaba = request()->file('sertimaba');
        $sertimabaUrl = $sertimaba->storeAs('file/syarat/sertimaba', "{$number}sertimaba.{$sertimaba->extension()}");
        $bebaslab = request()->file('bebaslab');
        $bebaslabUrl = $bebaslab->storeAs('file/syarat/bebaslab', "{$number}bebaslab.{$bebaslab->extension()}");
        $transkrip = request()->file('transkrip');
        $transkripUrl = $transkrip->storeAs('file/syarat/transkrip', "{$number}transkrip.{$transkrip->extension()}");
        $pembayaran = request()->file('pembayaran');
        $pembayaranUrl = $pembayaran->storeAs('file/syarat/pembayaran', "{$number}pembayaran.{$pembayaran->extension()}");

        $syarats = Syarat::updateOrCreate([
            'mahasiswa_id'   => $mahasiswa->id,
        ], [
            'nama_ibu'     => $request->get('nama_ibu'),
            'pekerjaan_ibu' => $request->get('pekerjaan_ibu'),
            'nama_ayah'    => $request->get("nama_ayah"),
            'pekerjaan_ayah'   => $request->get('pekerjaan_ayah'),
            'alamat'       => $request->get('alamat'),
            'no_hp'   => $request->get('no_hp'),
        ]);
        
        return redirect()->route('frontend.syarats.index');
    }

    public function edit(Syarat $syarat)
    {
        abort_if(Gate::denies('syarat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mahasiswas = Mahasiswa::with(['user' => function ($query) {
            $query->pluck('name', 'nik');
        }])->get(); 

        $syarat->load('mahasiswa');

        return view('frontend.syarats.edit', compact('mahasiswas', 'syarat'));
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

        return view('frontend.syarats.show', compact('syarat'));
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
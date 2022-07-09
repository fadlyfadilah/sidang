<?php

namespace App\Http\Controllers\User;

use App\Models\Dosen;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class PengujiController extends Controller
{
    public function index()
    {
        $list = new Dosen();
        $dosens = $list->dosenUser();
        $mahasiswa = Mahasiswa::with(['userpenguji'])->where('user_id', auth()->user()->id)->first();
        $nilais = Nilai::with('mahasiswa')->where('mahasiswa_id', $mahasiswa->id)->get();
        $nilaiavg = Nilai::where('mahasiswa_id', $mahasiswa->id)->pluck('nilai')->avg();
        return view('user.pengujis.index', compact('dosens', 'mahasiswa', 'nilais', 'nilaiavg'));
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $mahasiswa->userpenguji()->sync(request('dosens'));

        return redirect()->back()->with('success', 'Berhasil!');;
    }
}

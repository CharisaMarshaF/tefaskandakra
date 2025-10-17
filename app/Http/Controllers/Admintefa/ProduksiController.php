<?php

namespace App\Http\Controllers\Admintefa;


use App\Http\Controllers\Controller;
use App\Models\KelasIndustri;
use App\Models\Produksi;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        $produksis = Produksi::all();
        $project = Project::all();
        $industris = KelasIndustri::all();
        $members = ProjectMember::with('siswa')->get()->groupBy('id_project');
        return view('admintefa.produksi', compact('produksis', 'project', 'industris', 'members'));
    }
    public function tambah(Request $request)
    {
        Produksi::create([
            'id_project' => $request->id_project,
            'id_kelasindustri' => $request->id_kelasindustri,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'catatan' => $request->catatan,
        ]);
        return back();
    }
}

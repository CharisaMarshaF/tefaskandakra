<?php

namespace App\Http\Controllers\Admintefa;


use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\Jurusan;
use App\Models\StokTransaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        do {
            $prefix = 'PRD'; // Awalan tetap
            $tahun  = date('Y'); // Tahun saat ini, misalnya 2025
            $random = strtoupper(Str::random(6)); // Random 6 karakter huruf/angka, huruf besar
            $kode_bahan = "{$prefix}-{$tahun}-{$random}";
        } while (\App\Models\Bahan::where('kode_bahan', $kode_bahan)->exists());
        $bahans = Bahan::all();
        $stoks = StokTransaksi::all();

        return view('admintefa.stok', compact('kode_bahan', 'jurusan', 'bahans', 'stoks'));
    }

    public function store(Request $request)
    {
        // generate kode produk unik
        do {
            $kode_bahan = 'PRD-' . date('Y') . '-' . strtoupper(Str::random(6));
        } while (Bahan::where('kode_bahan', $kode_bahan)->exists());
        $data['kode_bahan'] = $kode_bahan;

        Bahan::create([
            'kode_bahan' => $request->kode_bahan,
            'nama_bahan' => $request->nama_bahan,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'minimal_stok' => $request->minimal_stok,
            'harga_satuan' => $request->harga_satuan,
            'id_jurusan' => $request->id_jurusan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }



    public function edit($id)
    {
        $bahans = Bahan::find($id);
        return view('admintefa.stok', compact('bahans'));
    }

    public function update(Request $request, $id) {

        $bahan = Bahan::find($id);
        $bahan->update([
             'kode_bahan' => $request->kode_bahan,
            'nama_bahan' => $request->nama_bahan,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'minimal_stok' => $request->minimal_stok,
            'harga_satuan' => $request->harga_satuan,
            'id_jurusan' => $request->id_jurusan,
        ]);
         return redirect()->back()->with('success', 'Data berhasil diedit!');
    }

    public function hapusBahan($id)
    {
        $bahan = Bahan::find($id);
        $bahan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function tambahStok(Request $request)
    {
        // Validasi data jika perlu
        $request->validate([
            'id_bahan' => 'required|exists:bahans,id',
            'qty' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'reference' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        // 1. Catat transaksi
        StokTransaksi::create([
            'id_bahan' => $request->id_bahan,
            'jenis' => $request->jenis,
            'qty' => $request->qty,
            'tanggal' => $request->tanggal,
            'reference' => $request->reference,
            'keterangan' => $request->keterangan,
        ]);

        // 2. Tambah stok di tabel Bahan
        $bahan = Bahan::findOrFail($request->id_bahan);
        $bahan->stok += $request->qty;
        $bahan->save();

        // 3. Redirect atau response
        return redirect()->back()->with('success', 'Stok berhasil ditambahkan.');
    }
}

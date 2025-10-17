<?php

namespace App\Http\Controllers\Admintefa;

use App\Models\Foto;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Jurusan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();  // Fetch all the jurusans
        do {
            $prefix = 'PRD';
            $tahun  = date('Y');
            $random = strtoupper(Str::random(6));
            $kode_produk = "{$prefix}-{$tahun}-{$random}";
        } while (\App\Models\Produk::where('kode_produk', $kode_produk)->exists());

        $produk = Produk::all();
        
        return view('admintefa.produk', compact('jurusans', 'kode_produk', 'produk'));  // Pass the $jurusans variable to the view
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required',
        'id_jurusan' => 'required',
        'deskripsi' => 'required',
        'kategori' => 'required',
        'harga' => 'required',
        'satuan' => 'required',
        'stok' => 'required',
        'status' => 'required',
        'foto.*' => 'image|mimes:jpeg,jpg,png|max:2048',
    ]);

    // generate kode produk unik
    do {
        $kode_produk = 'PRD-' . date('Y') . '-' . strtoupper(Str::random(6));
    } while (Produk::where('kode_produk', $kode_produk)->exists());

    $data = $request->except('foto');
    $data['kode_produk'] = $kode_produk;

    // simpan produk dulu
    $produk = Produk::create($data);

    // upload semua foto
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $index => $file) {
            $path = $file->store('fotos', 'public');

            $foto = Foto::create([
                'foto' => $path,
                'produk_id' => $produk->id
            ]);

            // set foto pertama sebagai foto utama
            if ($index == 0) {
                $produk->id_foto = $foto->id;
                $produk->save();
            }
        }
    }

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
}


    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admintefa.edit_produk', compact('produk'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks,kode_produk,' . $id,
            'nama_produk' => 'required',
            'id_jurusan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'status' => 'required',
            'id_foto' => 'required',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Models\File;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Jurusan;
use App\Models\Payment;
use App\Models\CsTicket;
use App\Models\Keranjang;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CooperationRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function allProduk()
{
    // Ambil semua produk beserta relasi jurusan
    $produks = Produk::with('jurusan')->get();

    // Kirim ke view
    return view('customer.produk', compact('produks'));
}


    public function profil_tefa()
    {
        return view('customer.profil_tefa');
    }
   
    public function riwayatpesanan()
    {
        // Ambil semua pesanan user yang login, urutkan terbaru dulu
        $orders = Order::where('id_user', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('customer.riwayat_pesanan', compact('orders'));
    }
   
    

    public function jurusan_rpl()
    {
        $produk = Produk::where('id_jurusan', 1)->with('foto')->get();

        return view('customer.jurusan_rpl', compact('produk'));
    }

    public function jurusan_oto()
    {
        $produk = Produk::where('id_jurusan', 2)->with('foto')->get();
        return view('customer.jurusan_oto', compact('produk'));
    }

    public function jurusan_tekstil()
    {
        $produk = Produk::where('id_jurusan', 3)->with('foto')->get();
        return view('customer.jurusan_tekstil', compact('produk'));
    }

    public function jurusan_mesin()
    {
        $produk = Produk::where('id_jurusan', 4)->with('foto')->get();
        return view('customer.jurusan_mesin', compact('produk'));
    }


    public function jurusan($id)
    {
        $produk = Produk::with('jurusan')
            ->where('id_jurusan', $id)
            ->where('status', 'aktif')
            ->get();

        return view('customer.jurusan', compact('produk'));
    }

    public function kontak()
    {
        return view('customer.kontak');
    }
    public function mitra(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_perusahaan' => 'required|string|max:255',
                'alamat_perusahaan' => 'required|string|max:255',
                'bidang_usaha' => 'required|string|max:150',
                'kontak_person' => 'required|string|max:150',
                'no_telp' => 'required|string|max:50',
                'email' => 'required|email|max:100',
                'jenis_kerjasama' => 'required|string|max:150',
                'deskripsi_kebutuhan' => 'required|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            ]);

            $fileId = null;
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');

                // Simpan file ke storage
                $path = $uploadedFile->store('uploads', 'public');

               
                $file = File::create([
                    'nama_file' => $uploadedFile->getClientOriginalName(),
                    'file_type' => $uploadedFile->getClientMimeType(),
                    'uploaded_at' => now(),
                ]);

                $fileId = $file->id;
            }
            CooperationRequest::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'kode_tiket' => uniqid('REQ-'),
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'bidang_usaha' => $request->bidang_usaha,
                'kontak_person' => $request->kontak_person,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'jenis_kerjasama' => $request->jenis_kerjasama,
                'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
                'id_file' => $fileId,
                'tanggal_pengajuan' => now(),
                'tanggal_update' => now(),
            ]);

            return redirect()->back()->with('success', 'Permohonan kerja sama berhasil dikirim!');
        }

        return view('customer.mitra');
    }


    public function customer_service()
    {
        $tickets = CsTicket::where('id_user', Auth::id())->latest()->get();
        return view('customer.customer_service', compact('tickets'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'kategori' => 'required|string',
            'kontak'   => 'required|string|max:150',
            'subject'  => 'required|string|max:150',
            'message'  => 'required|string',
            'lampiran' => 'nullable|file|max:51200|mimes:jpg,jpeg,png,pdf,mp4',
        ]);
    
        $fileId = null;
        if ($request->hasFile('lampiran')) {
            $uploadedFile = $request->file('lampiran');
    
            $path = $uploadedFile->store('tickets', 'public');
    
            $file = File::create([
                'nama_file'  => $uploadedFile->getClientOriginalName(),
                'file_type'  => $uploadedFile->getClientMimeType(),
                'uploaded_at'=> now(),
            ]);
    
            $fileId = $file->id;
        }
    
        $kodeTiket = 'TCK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
    
        $ticket = CsTicket::create([
            'id_user'    => Auth::id(),
            'kode_tiket' => $kodeTiket,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'status'     => 'open',
            'id_file'    => $fileId,
        ]);
    
        return redirect()->back()->with('ticket_number', $ticket->kode_tiket);
    }

    public function tracking(Request $request)
{
    $query = $request->input('kode_tiket');

    $tickets = CsTicket::where('id_user', auth()->id())
        ->when($query, function($q) use ($query) {
            $q->where('kode_tiket', 'like', "%{$query}%")
              ->orWhere('subject', 'like', "%{$query}%");
        })
        ->latest()
        ->get();

    return view('customer.customer_service', compact('tickets'));
}

public function show($id)
{
    $ticket = CsTicket::where('id_user', Auth::id())->findOrFail($id);
    return view('customer.ticket_detail', compact('ticket'));
}

public function produkDetail($id)
{
    $produk = Produk::with('jurusan')
        ->withCount([
            'orderItems as terjual' => function ($query) {
                $query->select(DB::raw('COALESCE(SUM(qty), 0)'));
            }
        ])
        ->findOrFail($id);

    $terkait = Produk::where('id_jurusan', $produk->id_jurusan)
                     ->where('id', '!=', $id)
                     ->take(4)
                     ->get();

    return view('customer.produk_detail', compact('produk', 'terkait'));
}



public function destroy($id)
{
    $ticket = CsTicket::where('id_user', Auth::id())->findOrFail($id);

    // Hapus file lampiran jika ada
    if($ticket->lampiran && file_exists(storage_path('app/public/' . $ticket->lampiran))){
        unlink(storage_path('app/public/' . $ticket->lampiran));
    }

    $ticket->delete();

    return redirect()->back()->with('success', 'Tiket berhasil dihapus.');
}


    // === Halaman Akun ===
    public function akun()
    {
        $user = Auth::user();
        return view('customer.akun', compact('user'));
    }

    // Update profil
    public function updateAkun(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:80',
            'last_name'  => 'required|string|max:80',
            'email'      => 'required|email|max:150|unique:users,email,' . auth()->id(),
            'phone'      => 'nullable|string|max:30',
        ]);

        $user = auth()->user();
        $user->username = $request->first_name . ' ' . $request->last_name;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'user'    => $user
        ]);
    }


    // Landing page
    public function landingPage()
{
    // Ambil semua jurusan dengan produk aktif dan stok > 0
    $jurusans = Jurusan::with(['produk' => function($query) {
        $query->where('status', 'aktif')
              ->where('stok', '>', 0)
              ->orderBy('created_at', 'desc')
              ->with('foto'); // relasi foto
    }])->get();

    // Produk RPL (id_jurusan = 1)
    $rplProduks = Produk::where('id_jurusan', 1)
        ->where('status', 'aktif')
        ->where('stok', '>', 0)
        ->with('foto')
        ->take(8)
        ->get();

    // Produk MESIN (id_jurusan = 2)
    $mesinProduks = Produk::where('id_jurusan', 4)
        ->where('status', 'aktif')
        ->where('stok', '>', 0)
        ->with('foto')
        ->take(8)
        ->get();

    // Produk TEKSTIL (id_jurusan = 3)
    $tekstilProduks = Produk::where('id_jurusan', 3)
        ->where('status', 'aktif')
        ->where('stok', '>', 0)
        ->with('foto')
        ->take(8)
        ->get();

    // Produk OTOMOTIF (id_jurusan = 4)
    $otoProduks = Produk::where('id_jurusan', 2)
        ->where('status', 'aktif')
        ->where('stok', '>', 0)
        ->with('foto')
        ->take(4)
        ->get();

    // kirim semua ke view
    return view('customer.landing_page', compact(
        'jurusans', 'rplProduks', 'mesinProduks', 'tekstilProduks', 'otoProduks'
    ));
}



    // Halaman keranjang
    public function keranjang()
    {
        $userId = Auth::id();
        $keranjang = Keranjang::with('produk')->where('user_id', $userId)->get();
        return view('customer.keranjang', compact('keranjang'));
    }

    // Tambah ke keranjang
    public function tambahKeranjang(Request $request, $id)
{
    $userId = Auth::id();
    $produk = Produk::findOrFail($id);

    // ambil jumlah dari request, default = 1
    $jumlah = $request->input('quantity', 1);

    $keranjang = Keranjang::where('user_id', $userId)
        ->where('produk_id', $id)
        ->first();

    if ($keranjang) {
        // tambahkan jumlah sesuai input
        $keranjang->quantity += $jumlah;
        $keranjang->save();
    } else {
        Keranjang::create([
            'user_id' => $userId,
            'produk_id' => $id,
            'quantity' => $jumlah,
        ]);
    }

    return redirect()->route('customer.keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
}


    // Update quantity
    public function updateKeranjang(Request $request, $id)
    {
        $item = Keranjang::findOrFail($id);
        if ($request->action === 'plus') {
            $item->quantity += 1;
        } elseif ($request->action === 'minus' && $item->quantity > 1) {
            $item->quantity -= 1;
        }
        $item->save();
        return redirect()->route('customer.keranjang');
    }

    // Hapus dari keranjang
    public function hapusKeranjang($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();
        return redirect()->route('customer.keranjang');
    }

    public function checkout($id = null)
    {
        $userId = Auth::id();
    
        if ($id) {
            // ✅ Kalau $id dikirim → berarti user klik "Beli Sekarang" (1 produk saja)
            $produk = Produk::findOrFail($id);
    
            // Bikin data palsu mirip keranjang agar view tetap bisa pakai variabel $keranjang
            $keranjang = collect([
                (object)[
                    'produk' => $produk,
                    'quantity' => 1
                ]
            ]);
        } else {
            // ✅ Kalau $id tidak dikirim → berarti checkout semua isi keranjang
            $keranjang = Keranjang::with('produk')
                ->where('user_id', $userId)
                ->get();
        }
    
        return view('customer.checkout', compact('keranjang'));
    }
    
    
    public function prosesCheckout(Request $request)
{
    $userId = Auth::id();

    // Simpan data order utama
    $order = Order::create([
        'order_no' => 'ORD-' . strtoupper(Str::random(8)), // ✅ tambahkan ini
        'id_user' => $userId,
        'total' => 0,
        'status' => 'pending'
    ]);
    
    

    $items = collect();

    if ($request->has('produk_id')) {
        // ✅ Checkout 1 produk saja (dari tombol Beli Sekarang)
        $produk = Produk::findOrFail($request->produk_id);
        $qty = $request->quantity ?? 1;

        $items->push((object)[
            'produk' => $produk,
            'quantity' => $qty
        ]);
    } else {
        $items = Keranjang::with('produk')
            ->where('user_id', $userId)
            ->get();
    }

    // Simpan item ke order_items
    $total = 0;
    foreach ($items as $item) {
        $subtotal = $item->produk->harga * $item->quantity;
        $total += $subtotal;

        OrderItem::create([
            'id_order' => $order->id,
            'id_produk' => $item->produk->id,
            'qty' => $item->quantity,
            'price' => $item->produk->harga,
            'subtotal' => $subtotal
        ]);
    }

    // Update total harga di orders
    $order->update(['total' => $total]);

    // Hapus keranjang hanya kalau checkout dari keranjang
    if (!$request->has('produk_id')) {
        Keranjang::where('user_id', $userId)->delete();
    }

    return redirect()->route('customer.payment', ['order' => $order->id]);

}

    
// Halaman metode pembayaran
public function payment($orderId)
{
    $order = Order::with('items')->findOrFail($orderId);

    // Ambil data item + produk terkait
    $items = $order->items()
    ->join('produks', 'produks.id', '=', 'order_items.id_produk')
    ->leftJoin('fotos', 'fotos.id', '=', 'produks.id_foto') // ambil foto dari tabel fotos
    ->select(
        'produks.nama_produk',
        'fotos.foto as foto',
        'order_items.qty',
        'order_items.subtotal'
        
    )
    ->get();


    $total = $order->total;

    return view('customer.payment', compact('order', 'items', 'total'));
}
public function pay(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'payment_method' => 'required',
    ]);

    $order = Order::find($request->order_id);
    if (!$order) {
        return response()->json(['success' => false, 'message' => 'Order tidak ditemukan.']);
    }

    Payment::create([
        'id_order' => $order->id,
        'metode' => $request->payment_method,
        'amount' => $order->total,
        'bukti_file_id' => null,
        'verified_by' => Auth::id(),
        'status' => 'pending',
    ]);

    $order->update(['status' => 'pending']);

    return response()->json(['success' => true]);
}
public function lacakPesanan()
{
    $orders = Order::with('items.produk')
        ->where('id_user', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($order) {
            // tambahkan estimasi tanpa ubah tabel
            $order->estimasi_pengiriman = $order->created_at->addDays(3);
            return $order;
        });

    return view('customer.lacak_pesanan', compact('orders'));
}

public function search(Request $request)
{
    $keyword = $request->input('q');

    $produks = \App\Models\Produk::where('nama_produk', 'like', "%{$keyword}%")
                ->orWhere('deskripsi', 'like', "%{$keyword}%")
                ->paginate(12);

    return view('customer.produk', [
        'produks' => $produks,
        'keyword' => $keyword,
    ]);
}


}

<?php

namespace App\Http\Controllers\Admintefa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(){
        $pembayarans = Pembayaran::all();
        return view('admintefa.pembayaran',compact('pembayarans'));
    }

    public function konfirmasi(Request $request,$id){
        $pembayarans = Pembayaran::find($id);
        $pembayarans->update([
            'status' => 'diterima'
        ]);
        return redirect()->back()->with('success','Pembayaran berhasil dikonfirmasi');
    }
    public function tolak(Request $request,$id){
        $pembayarans = Pembayaran::find($id);
        $pembayarans->update([
            'status' => 'ditolak'
        ]);
        return redirect()->back()->with('success','Pembayaran berhasil ditolak');
    }
}

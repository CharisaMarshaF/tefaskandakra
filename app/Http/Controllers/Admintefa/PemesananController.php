<?php

namespace App\Http\Controllers\Admintefa;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(){
        $orders = Pemesanan::all();
        return view('admintefa.pemesanan',compact('orders'));
    }

    public function konfirmasi(Request $request,$id){
        $order = Order::find($id);
        $order->update([
            'order_no' => $request->order_no,
            'id_user' => $request->id_user,
            'total' => $request->total,
            'shipping_address' => $request->shipping_address,
            'status' => 'diproses',
        ]);

        return redirect()->back()->with('success','Berhasil diproses!');
    }
    public function dikirim(Request $request,$id){
        $order = Order::find($id);
        $order->update([
            'order_no' => $request->order_no,
            'id_user' => $request->id_user,
            'total' => $request->total,
            'shipping_address' => $request->shipping_address,
            'status' => 'dikirim',
        ]);
        return redirect()->back()->with('success','Berhasil diproses!');
    }
    public function selesai(Request $request,$id){
        $order = Order::find($id);
        $order->update([
            'order_no' => $request->order_no,
            'id_user' => $request->id_user,
            'total' => $request->total,
            'shipping_address' => $request->shipping_address,
            'status' => 'selesai',
        ]);
        return redirect()->back()->with('success','Berhasil diproses!');
    }

}

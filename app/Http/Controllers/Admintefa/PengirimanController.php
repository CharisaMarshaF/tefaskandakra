<?php

namespace App\Http\Controllers\Admintefa;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $order = \App\Models\Order::all();
        $shipment = \App\Models\Shipment::all();
        return view('admintefa.pengiriman', compact('order', 'shipment'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'id_order' => 'required',
            'courier' => 'required',
            'tracking_no' => 'required',
            'status' => 'required',
            'packed_by' => 'required',
            'shipped_at' => 'required',
            'delivered_at' => 'nullable',
        ]);
        \App\Models\Shipment::create($validated);
        return back()->with('success', 'Data pengiriman berhasil ditambahkan!');
    }

}

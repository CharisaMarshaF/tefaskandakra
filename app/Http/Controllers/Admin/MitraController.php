<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MitraController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:150',
            'pic_name' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat user baru untuk login mitra (Asumsi Role ID 8 untuk Perusahaan/DUDI)
        $user = User::create([
            'username' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => 8, // Sesuaikan dengan ID role Perusahaan/DUDI
        ]);

        // Buat data perusahaan/mitra yang terhubung dengan user baru
        Perusahaan::create([
            'id_user' => $user->id,
            'nama' => $request->nama,
            'kode_perusahaan' => 'PRSH-' . time(), // Contoh kode unik
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'pic_email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['success' => 'Mitra DUDI berhasil ditambahkan!']);
    }
}

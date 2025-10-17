<?php

namespace App\Http\Controllers\OrangTuas;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrangTuaController extends Controller
{
    protected $orangTua;
    protected $datasiswas;
    protected $project_progress;
    protected $project_grades;

    public function __construct()
    {
        // Ambil data orang tua sesuai user login
        $this->orangTua = DB::table('orang_tuas')
            ->where('id_user', auth()->id())
            ->first();

        if (!$this->orangTua) {
            abort(404, 'Data orang tua tidak ditemukan');
        }

        // Ambil data siswa sesuai id_siswas
        $this->datasiswas = Siswa::with('kelas')
            ->where('id', $this->orangTua->id_siswas)
            ->first();


        // Ambil data project progress
        $this->project_progress = DB::table('project_progress as pp')
        ->leftJoin('projects as p', 'pp.id_project', '=', 'p.id')
        ->select(
            'pp.id',
            'pp.id_siswa',
            'pp.id_project',
            'pp.tanggal',
            'pp.progress_percent',
            'pp.deskripsi',
            'pp.file_id',
            'pp.submitted_by',
            'p.nama_project',
            'p.deadline',
            'p.start_date',
        )
        ->where('pp.id_siswa', $this->datasiswas->id ?? 0)
        ->get();

         // Ambil data project grades (selesai)
         $this->project_grades = DB::table('project_grades as pg')
         ->leftJoin('projects as p', 'pg.id_project', '=', 'p.id')
         ->leftJoin('files as f', 'pg.sertifikat_file_id', '=', 'f.id')
         ->where('pg.id_siswa', $this->datasiswas->id ?? 0)
         ->select(
             'pg.id',
             'pg.id_project',
             'pg.nilai',
             'pg.feedback',
             'pg.graded_by',
             'pg.graded_at',
             'p.nama_project',
             'p.deskripsi as deskripsi',
             'p.start_date',
             'p.deadline',
             'f.nama_file as dokumen_nama_file',
             'f.id as dokumen_id'
         )
         ->get();

        
        
    }
    public function index()
    {
        return view('orang-tua.index', [
            'datasiswas'  => $this->datasiswas,
            'orangTua'    => $this->orangTua,
            'project_grades'   => $this->project_grades->take(3),
            'project_progress' => $this->project_progress
        ]);

    }

    
    public function nilai()
    {
        // Ambil data nilai + sertifikat
        $sertifikats = DB::table('project_grades as pg')
            ->leftJoin('files as f', function ($join) {
                $join->on('pg.sertifikat_file_id', '=', 'f.id')
                     ->where('f.file_type', '=', 'sertifikat'); // filter hanya file sertifikat
            })
            ->select(
                'pg.id',
                'pg.id_project',
                'pg.id_siswa',
                'pg.nilai',
                'pg.feedback',
                'pg.graded_by',
                'pg.graded_at',
                'f.nama_file as nama_sertifikat',
                'f.id as sertifikat_id' // tambahkan ID file supaya bisa di-download
            )
            ->when($this->datasiswas, function ($query) {
                return $query->where('pg.id_siswa', $this->datasiswas->id);
            })
            ->get();
    
        return view('orang-tua.nilai', [
            'datasiswas'       => $this->datasiswas,
            'orangTua'         => $this->orangTua,
            'sertifikats'      => $sertifikats,
            'project_progress' => $this->project_progress,
            'project_grades'   => $this->project_grades
        ]);

        
    }
    
   

    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'file_type' => 'required|string',
            'file' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);
    
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
    
        // Simpan ke storage/app/public/surat
        $file->storeAs('surat', $fileName, 'public');
    
        // Simpan ke tabel files
        $fileId = DB::table('files')->insertGetId([
            'nama_file' => $fileName,
            'file_type' => $request->file_type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Simpan ke tabel surat_persetujuan
        DB::table('surat_persetujuan')->insert([
            'id_file' => $fileId,
            'id_siswa' => $this->datasiswas->id ?? 0,
            'id_orang_tua' => $this->orangTua->id ?? 0,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return back()->with('success', 'Surat berhasil ditambahkan!');
    }
    

    public function surat()
    {
         // Data surat (pending)
        $dataSurat = DB::table('surat_persetujuan as sp')
        ->join('files as f', 'sp.id_file', '=', 'f.id')
        ->where('sp.id_orang_tua', $this->orangTua->id)
        ->select('sp.id as sp_id', 'sp.id_file', 'f.nama_file', 'f.file_type', 'sp.status') // 🔥 tambahkan sp.id_file
        ->orderBy('sp.created_at', 'desc')
        ->get();

        // Riwayat (hanya yang sudah disetujui)
        $riwayatSurat = DB::table('surat_persetujuan as sp')
            ->join('files as f', 'sp.id_file', '=', 'f.id')
            ->where('sp.id_orang_tua', $this->orangTua->id)
            ->where('sp.status', 'disetujui')
            ->select('sp.id as sp_id', 'sp.id_file', 'f.nama_file', 'f.file_type', 'sp.status') // 🔥 tambahkan sp.id_file
            ->orderBy('sp.updated_at', 'desc')
            ->get();
    
        return view('orang-tua.surat', [
            'datasiswas'   => $this->datasiswas,
            'orangTua'     => $this->orangTua,
            'dataSurat'    => $dataSurat,
            'riwayatSurat' => $riwayatSurat,
        ]);
    }
    
    public function approveSurat($id)
    {
        DB::table('surat_persetujuan')
            ->where('id', $id)
            ->update([
                'status' => 'disetujui',
                'updated_at' => now()
            ]);
    
        return back()->with('success', 'Surat berhasil disetujui!');
    }
    
    public function downloadSurat($id)
    {
        $surat = DB::table('surat_persetujuan as sp')
            ->join('files as f', 'sp.id_file', '=', 'f.id')
            ->where('sp.id', $id)
            ->select('f.nama_file')
            ->first();
    
        if (!$surat) {
            abort(404, 'Surat tidak ditemukan');
        }
    
        $filePath = storage_path('app/public/surat/' . $surat->nama_file);
    
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ada di server');
        }
    
        return response()->download($filePath, $surat->nama_file);
    }
    
    public function riwayat()
    {
       

        return view('orang-tua.riwayat', [
            'datasiswas'       => $this->datasiswas,
            'orangTua'         => $this->orangTua,
            'project_progress' => $this->project_progress,
            'project_grades'   => $this->project_grades
        ]);
    }


     public function downloadSertifikat($id)
        {
            // Ambil data file berdasarkan ID
            $file = DB::table('files')->where('id', $id)->first();

            if (!$file) {
                abort(404, 'File tidak ditemukan');
            }

            $filePath = storage_path('app/public/' . $file->nama_file);

            if (!file_exists($filePath)) {
                abort(404, 'File tidak ditemukan di server');
            }

            return response()->download($filePath, $file->nama_file);
        }

        


}

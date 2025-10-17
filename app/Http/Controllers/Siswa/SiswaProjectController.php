<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Project;
use App\Models\JadwalProduksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiswaProjectController extends Controller
{
public function index(Request $request)
{
    $siswa = Siswa::where('id_user', Auth::id())->first();
    if (!$siswa) abort(403, 'Anda bukan siswa atau data siswa belum terdaftar.');

    $today = Carbon::today();
    $validStatuses = ['proses','selesai'];

    // ambil filter dari request
    $filterStatus = $request->get('status');

    $projectsQuery = Project::with([
        'perusahaan',
        'grades' => fn($q) => $q->where('id_siswa', $siswa->id)->with('sertifikatFile'),
        'memberProgress' => fn($q) => $q->where('id_siswa', $siswa->id)
    ])
    ->whereHas('members', fn($q) => $q->where('id_siswa', $siswa->id))
    ->whereIn('status', $validStatuses);

    if ($filterStatus && in_array($filterStatus, $validStatuses)) {
        $projectsQuery->where('status', $filterStatus);
    }

    $projects = $projectsQuery->get()->map(function($project) {
        $project->progress_value = $project->memberProgress->max('progress_percent') ?? 0;

        if($project->status == 'selesai') {
            $grade = $project->grades->first();
            $project->grade = $grade?->nilai ?? null;
            $project->feedback = $grade?->feedback ?? null;
            $project->sertifikat_file = $grade?->sertifikatFile ?? null;
        } else {
            $project->grade = null;
            $project->feedback = null;
            $project->sertifikat_file = null;
        }

        $project->perusahaan_nama = $project->perusahaan->nama ?? '-';
        return $project;
    });

    // Statistik
    $totalProjects     = $projects->count();
    $activeProjects    = $projects->where('status','proses')->count();
    $completedProjects = $projects->where('status','selesai')->count();

    // Jadwal produksi hari ini
    $todaySchedules = JadwalProduksi::with(['project.perusahaan'])
        ->whereDate('tanggal_mulai','<=',$today)
        ->whereDate('tanggal_selesai','>=',$today)
        ->whereHas('project.members', fn($q) => $q->where('id_siswa', $siswa->id))
        ->whereHas('project', fn($q) => $q->whereIn('status',$validStatuses))
        ->get();

    return view('siswa.project', compact(
        'projects','totalProjects','activeProjects','completedProjects',
        'todaySchedules','siswa','filterStatus'
    ));
}

}

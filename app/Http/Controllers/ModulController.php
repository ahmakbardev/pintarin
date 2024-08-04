<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModulController extends Controller
{
    public function index()
    {
        $dosenId = Auth::user()->dosen_id;

        // Ambil modul yang sesuai dengan dosen_id
        $moduls = DB::table('moduls')
            ->where('dosen_id', $dosenId)
            ->get();

        // Ambil progress dan hitung jumlah materi serta materi yang sudah diakses
        $moduls = $moduls->map(function ($modul) {
            $modul->total_materi = DB::table('materis')->where('modul_id', $modul->id)->count();
            $progress = DB::table('progress')
                ->where('modul_id', $modul->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($progress) {
                $modul->completed_materi = count(json_decode($progress->materi_ids));
            } else {
                $modul->completed_materi = 0;
            }

            return $modul;
        });

        return view('index', compact('moduls'));
    }

    public function getModulsByCategory(Request $request, $category)
    {
        $dosenId = Auth::user()->dosen_id;
        $moduls = DB::table('moduls')
            ->where('topic', $category)
            ->where('dosen_id', $dosenId)
            ->get();

        $moduls = $moduls->map(function ($modul) {
            $modul->total_materi = DB::table('materis')->where('modul_id', $modul->id)->count();
            $progress = DB::table('progress')
                ->where('modul_id', $modul->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($progress) {
                $modul->completed_materi = count(json_decode($progress->materi_ids));
            } else {
                $modul->completed_materi = 0;
            }

            return $modul;
        });

        return response()->json($moduls);
    }


    public function showModul($id)
    {
        $dosenId = Auth::user()->dosen_id;
        $modul = DB::table('moduls')->where('id', $id)->where('dosen_id', $dosenId)->first();
        if (!$modul) {
            abort(404, 'Modul not found');
        }

        $materis = DB::table('materis')->where('modul_id', $id)->get();
        $postTests = DB::table('post_tests')
            ->select('modul_id', DB::raw('MIN(id) as id'), DB::raw('MIN(question) as question'))
            ->where('modul_id', $id)
            ->groupBy('modul_id')
            ->get();
        $tasks = DB::table('tasks')->where('modul_id', $id)->get();

        $progress = Progress::where('user_id', Auth::id())->where('modul_id', $id)->first();
        $completedMateriIds = $progress ? $progress->materi_ids : [];

        $allMateriCompleted = count($completedMateriIds) === $materis->count();
        $postTestScore = $progress ? $progress->post_test_score : null;

        return view('modul', compact('modul', 'materis', 'postTests', 'tasks', 'completedMateriIds', 'allMateriCompleted', 'postTestScore'));
    }

    public function showMateri($id)
    {
        $dosenId = Auth::user()->dosen_id;
        $materi = DB::table('materis')->where('id', $id)->first();
        if (!$materi) {
            abort(404, 'Materi not found');
        }

        $modul = DB::table('moduls')->where('id', $materi->modul_id)->where('dosen_id', $dosenId)->first();
        if (!$modul) {
            abort(404, 'Modul not found');
        }

        // Simpan progress
        $progress = Progress::firstOrNew(['user_id' => Auth::id(), 'modul_id' => $modul->id]);
        $materiIds = $progress->materi_ids ?? [];

        if (!in_array($id, $materiIds)) {
            $materiIds[] = $id;
            $progress->materi_ids = $materiIds;
            $progress->save();
        }

        $materis = DB::table('materis')->where('modul_id', $modul->id)->get();

        // Check if all materi are completed
        $completedMateriIds = $progress->materi_ids ?? [];
        $allMateriCompleted = count($completedMateriIds) === $materis->count();

        // Get current index
        $currentIndex = $materis->search(function ($item) use ($id) {
            return $item->id == $id;
        });

        // Get previous and next materi
        $previousMateri = $currentIndex > 0 ? $materis[$currentIndex - 1] : null;
        $nextMateri = $currentIndex < $materis->count() - 1 ? $materis[$currentIndex + 1] : null;

        return view('materi', compact('materi', 'materis', 'modul', 'previousMateri', 'nextMateri', 'completedMateriIds', 'allMateriCompleted'))->with('currentMateri', $materi);
    }


    public function getTaskProgress($taskId)
    {
        $userId = Auth::id();
        $tugasProgress = DB::table('tugas_progress')
            ->where('task_id', $taskId)
            ->where('user_id', $userId)
            ->first();

        if ($tugasProgress) {
            return response()->json($tugasProgress);
        } else {
            return response()->json(null);
        }
    }


    public function showTask($id)
    {
        $dosenId = Auth::user()->dosen_id;
        $task = DB::table('tasks')->where('id', $id)->where('dosen_id', $dosenId)->first();

        if (!$task) {
            abort(404, 'Task not found');
        }

        return view('post-test', compact('task'));
    }
}
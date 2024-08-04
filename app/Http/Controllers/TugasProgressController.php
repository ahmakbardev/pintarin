<?php

namespace App\Http\Controllers;

use App\Models\TugasProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TugasProgressController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $userId = Auth::id();

        $request->validate([
            'description' => 'nullable|string',
            'pdfFile' => 'nullable|file|mimes:pdf',
            'pptFile' => 'nullable|file|mimes:ppt,pptx',
        ]);

        // Dapatkan tugas progress yang ada untuk taskId dan userId
        $existingProgress = DB::table('tugas_progress')
            ->where('task_id', $taskId)
            ->where('user_id', $userId)
            ->first();

        $description = $request->input('description');

        $pdfFilePath = $existingProgress ? $existingProgress->pdf_path : null;
        if ($request->hasFile('pdfFile')) {
            $pdfFile = $request->file('pdfFile');
            $pdfFilePath = $pdfFile->store('tasks/pdf', 'public');
        }

        $pptFilePath = $existingProgress ? $existingProgress->ppt_path : null;
        if ($request->hasFile('pptFile')) {
            $pptFile = $request->file('pptFile');
            $pptFilePath = $pptFile->store('tasks/ppt', 'public');
        }

        $data = [
            'user_id' => $userId,
            'task_id' => $taskId,
            'description' => $description,
            'pdf_path' => $pdfFilePath,
            'ppt_path' => $pptFilePath,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('tugas_progress')->updateOrInsert(['task_id' => $taskId, 'user_id' => $userId], $data);

        return response()->json([$data]);
    }

    public function deleteFile(Request $request, $taskId)
    {
        $userId = Auth::id();

        $request->validate([
            'fileType' => 'required|string|in:pdf,ppt',
        ]);

        $fileType = $request->input('fileType');
        $filePathField = $fileType === 'pdf' ? 'pdf_path' : 'ppt_path';

        $progress = DB::table('tugas_progress')
            ->where('task_id', $taskId)
            ->where('user_id', $userId)
            ->first();

        if (!$progress) {
            return response()->json(['error' => 'Progress not found'], 404);
        }

        if ($fileType === 'pdf' && $progress->pdf_path) {
            Storage::disk('public')->delete($progress->pdf_path);
            $progress->pdf_path = null;
        } elseif ($fileType === 'ppt' && $progress->ppt_path) {
            Storage::disk('public')->delete($progress->ppt_path);
            $progress->ppt_path = null;
        }

        DB::table('tugas_progress')
            ->where('task_id', $taskId)
            ->where('user_id', $userId)
            ->update([$filePathField => null]);

        return response()->json(['message' => 'File deleted successfully']);
    }
}

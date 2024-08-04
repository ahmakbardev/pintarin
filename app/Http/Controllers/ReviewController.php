<?php

namespace App\Http\Controllers;

use App\Models\TugasProgress;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpPresentation\IOFactory;

class ReviewController extends Controller
{
    public function index($userId)
    {
        // Fetch the selected user
        $selectedUser = DB::table('users')->find($userId);

        if (!$selectedUser) {
            abort(404, 'User not found');
        }

        // Fetch the task progress for the selected user
        $tugasProgress = DB::table('tugas_progress')->where('user_id', $userId)->get();

        return view('saling-review.index', compact('selectedUser', 'tugasProgress'));
    }

    public function detailOptions($progress_id)
    {
        // Fetch task progress for the specified id
        $tugasProgress = DB::table('tugas_progress')->where('id', $progress_id)->first();
        if (!$tugasProgress) {
            abort(404, 'Task progress not found');
        }

        // Fetch user and task details
        $user = DB::table('users')->where('id', $tugasProgress->user_id)->first();
        $task = DB::table('tasks')->where('id', $tugasProgress->task_id)->first();

        // Fetch all progress entries for the same user and task
        $tugasProgressList = DB::table('tugas_progress')
            ->where('user_id', $tugasProgress->user_id)
            ->where('task_id', $tugasProgress->task_id)
            ->get();

        return view('saling-review.detail-option', compact('tugasProgress', 'tugasProgressList', 'user', 'task'));
    }


    public function convertPptToPdf($id)
    {
        $tugasProgress = TugasProgress::find($id);

        if (!$tugasProgress) {
            abort(404, 'Task progress not found');
        }

        $pptFilePath = storage_path('app/public/' . $tugasProgress->ppt_path);
        $ppt = IOFactory::createReader('PowerPoint2007')->load($pptFilePath);

        $html = '';

        foreach ($ppt->getAllSlides() as $slide) {
            $html .= '<div style="page-break-after: always;">';
            foreach ($slide->getShapeCollection() as $shape) {
                if ($shape instanceof \PhpOffice\PhpPresentation\Shape\RichText) {
                    $html .= '<div>' . $shape->getText() . '</div>';
                }
            }
            $html .= '</div>';
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream('presentation.pdf', ['Attachment' => false]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\SalingReviewMessageSent;
use App\Models\SalingReviewChat;
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

        // Fetch user along with their advisor (dosen) details using the relationship
        $user = User::with('dosen')->where('id', $tugasProgress->user_id)->first();

        // Fetch task details
        $task = DB::table('tasks')->where('id', $tugasProgress->task_id)->first();

        // Fetch all progress entries for the same user and task
        $tugasProgressList = DB::table('tugas_progress')
            ->where('user_id', $tugasProgress->user_id)
            ->where('task_id', $tugasProgress->task_id)
            ->get();

        return view('saling-review.detail-option', compact('tugasProgress', 'tugasProgressList', 'user', 'task'));
    }


    // Controller
    public function fetchMessages($progress_id)
    {
        $messages = SalingReviewChat::where('progress_id', $progress_id)
            ->with('user:id,name') // Include user data for each message
            ->orderBy('created_at', 'asc')
            ->get();

        // Format messages to include 'user_name' field
        $formattedMessages = $messages->map(function ($message) {
            return [
                'id' => $message->id,
                'message' => $message->message,
                'user_id' => $message->user_id,
                'created_at' => $message->created_at->format('H:i'),
                'user_name' => $message->user->name,
            ];
        });

        return response()->json($formattedMessages);
    }


    public function sendReviewMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'progress_id' => 'required|integer|exists:tugas_progress,id',
        ]);

        $chat = SalingReviewChat::create([
            'message' => $request->message,
            'progress_id' => $request->progress_id,
            'user_id' => Auth::id(),
        ]);

        broadcast(new SalingReviewMessageSent($chat))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
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

<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostTestController extends Controller
{
    public function show($modulId)
    {
        $questions = DB::table('post_tests')->where('modul_id', $modulId)->get();
        return view('latihan', compact('questions'));
    }

    public function store(Request $request, $modulId)
    {
        $userId = Auth::id();
        $answers = $request->input('answers');
        $questions = DB::table('post_tests')->where('modul_id', $modulId)->get();

        $correctAnswers = 0;

        foreach ($questions as $index => $question) {
            if (isset($answers[$index]) && $answers[$index] === $question->correct_answer) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $questions->count()) * 100;

        // Update progress
        DB::table('progress')->updateOrInsert(
            ['user_id' => $userId, 'modul_id' => $modulId],
            ['post_test_score' => $score]
        );

        if ($score < 75) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Skor Anda di bawah 75. Silakan ulangi post-test.',
                'redirect' => route('post-test', ['modulId' => $modulId])
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Selamat! Anda telah lulus post-test.',
                'redirect' => route('post-test.answer', ['modulId' => $modulId])
            ]);
        }
    }


    public function answer($modulId)
    {
        $userId = Auth::id();
        $questions = DB::table('post_tests')->where('modul_id', $modulId)->get();
        $progress = DB::table('progress')->where('user_id', $userId)->where('modul_id', $modulId)->first();
        $answers = json_decode($progress->post_test_score, true); // Decoding as array

        return view('answer', compact('questions', 'answers'));
    }
}

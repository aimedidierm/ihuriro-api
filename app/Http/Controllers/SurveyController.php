<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\SurveyRequest;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == UserRole::USER->value) {
            $surveys = Survey::where('user_id', Auth::id())->get();
            $surveys->load('user');
            return response()->json([
                'surveys' => $surveys
            ], Response::HTTP_OK);
        } else {
            $surveys = Survey::all();
            $surveys->load('user');
            return response()->json([
                'surveys' => $surveys
            ], Response::HTTP_OK);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyRequest $request)
    {
        $survey = Survey::create([
            'q1' => $request->input('q1'),
            'q2' => $request->input('q2'),
            'q3' => $request->input('q3'),
            'q4' => $request->input('q4'),
            'q5' => $request->input('q5'),
            'q6' => $request->input('q6'),
            'q7' => $request->input('q7'),
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Survey created',
            'survey' => $survey,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        //
    }

    public function questionsList()
    {
        $questions = Question::all();
        return response()->json([
            'questions' => $questions
        ], Response::HTTP_OK);
    }
}

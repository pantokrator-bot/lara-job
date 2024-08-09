<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessSubmission;
use App\Models\Submission;

class SubmitController extends Controller
{
    public function submit(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return validation errors
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            // Dispatch the job to process the submission
            ProcessSubmission::dispatch($request->only(['name', 'email', 'message']));
        } catch (\Exception $e) {
            // Log the error
            Log::error('Job dispatch failed', ['error' => $e->getMessage()]);

            // Return error response
            return response()->json(['message' => 'Failed to process submission'], 500);
        }

        return response()->json(['message' => 'Data submitted successfully'], 200);
    }
}

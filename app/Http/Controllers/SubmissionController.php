<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Jobs\ProcessSubmission;
use Exception;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function submit(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            ProcessSubmission::dispatch($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data validated, job dispatched successfully!',
            ], 200);
        } catch (Exception $e) {
            Log::error('Job dispatch error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to dispatch job. Please try again later.',
            ], 500);
        }
    }
}

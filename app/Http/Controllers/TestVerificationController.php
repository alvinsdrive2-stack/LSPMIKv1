<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VerificationCheckboxService;

class TestVerificationController extends Controller
{
    /**
     * Show test verification form
     */
    public function index()
    {
        return view('test.verification');
    }

    /**
     * Process test verification
     */
    public function test(Request $request)
    {
        // Get checkbox data for debugging
        $checkboxData = VerificationCheckboxService::getCheckboxData($request);

        // Validate checkboxes
        $isValid = VerificationCheckboxService::validateAllRequiredCheckboxes($request);

        return response()->json([
            'success' => true,
            'checkbox_data' => $checkboxData,
            'is_valid' => $isValid,
            'message' => $isValid ? 'All required checkboxes are checked' : 'Some checkboxes are missing'
        ]);
    }
}
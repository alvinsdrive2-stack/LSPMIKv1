<?php

use Illuminate\Http\Request;

Route::get('/debug-fpdi', function() {
    // Test class instantiation
    try {
        $fpdi = new \setasign\Fpdi\Tcpdf\Fpdi();
        return "FPDI instantiated successfully. Class: " . get_class($fpdi);
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/debug-service', function() {
    // Test service class
    try {
        $positions = \App\Services\VerificationCheckboxService::getCheckboxPositions();
        return "Service loaded successfully. Positions: " . json_encode($positions);
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
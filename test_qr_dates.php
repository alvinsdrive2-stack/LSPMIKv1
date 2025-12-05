<?php

// Test script untuk memverifikasi QR generation dengan tanggal berbeda

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Verification;
use App\Models\User;
use App\Services\QRService;
use Carbon\Carbon;

echo "Test QR Generation dengan Tanggal Berbeda\n";
echo "==========================================\n\n";

// Buat test verification
$verification = new Verification();
$verification->id = 999; // test ID
$verification->created_at = Carbon::now();

// Buat test user
$user = new User();
$user->id = 1;
$user->name = 'Test User';

// Inisialisasi QRService
$qrService = new QRService();

// Test 1: QR untuk halaman 1 (tanggal sekarang)
echo "Test 1: QR untuk halaman 1 (tanggal sekarang)\n";
echo "Created at: " . $verification->created_at->format('Y-m-d H:i:s') . "\n";

$qrPage1 = $qrService->generateQRForUser($verification, 'direktur_page1', $user);
echo "UUID: " . $qrPage1['uuid'] . "\n";
echo "Expires at: " . $qrPage1['expires_at']->format('Y-m-d H:i:s') . "\n\n";

// Test 2: QR untuk halaman 2 (tanggal kemarin)
echo "Test 2: QR untuk halaman 2 (tanggal kemarin)\n";
$verificationPage2 = clone $verification;
$yesterdayDate = (clone $verification->created_at)->modify('-1 day');
$verificationPage2->created_at = $yesterdayDate;
echo "Created at: " . $verificationPage2->created_at->format('Y-m-d H:i:s') . "\n";

$qrPage2 = $qrService->generateQRForUser($verificationPage2, 'direktur_page2', $user);
echo "UUID: " . $qrPage2['uuid'] . "\n";
echo "Expires at: " . $qrPage2['expires_at']->format('Y-m-d H:i:s') . "\n\n";

// Test 3: Verifikasi QR codes berbeda
echo "Test 3: Verifikasi QR codes berbeda\n";
echo "Apakah UUID halaman 1 dan 2 berbeda? " . ($qrPage1['uuid'] !== $qrPage2['uuid'] ? 'YA ✓' : 'TIDAK ✗') . "\n\n";

echo "Semua test selesai!\n";
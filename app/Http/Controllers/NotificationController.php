<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::with('workorder')
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at, terbaru lebih dulu
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Berhasil mengambil list notifikasi.',
        'data' => $notifications
    ], 200);
}
}

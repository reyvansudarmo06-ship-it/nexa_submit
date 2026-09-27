<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function read(Notification $notification)
    {
        abort_unless(
            (int) $notification->user_id === (int) auth()->id(),
            404
        );

        if (!$notification->read_at) {
            $notification->update([
                'read_at' => now(),
            ]);
        }

        if (!empty($notification->action_url)) {
            return redirect($notification->action_url);
        }

        return redirect()->route('notifications.index');
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return back()->with(
            'success',
            'Semua notifikasi sudah ditandai sebagai dibaca.'
        );
    }
}
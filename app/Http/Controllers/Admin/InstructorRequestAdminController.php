<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestActionMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestAdminController extends Controller
{
    public function index() : View {
        $instructorRequests = User::where('approve_status', 'pending')
        ->orWhere('approve_status', 'rejected')
        ->get();
        return view('admin.instructor-request.index', compact('instructorRequests'));
    }

    public function update(Request $request, int $userId) : RedirectResponse {
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $user = User::find($userId);
        $user->update( [
            'approve_status' => $request->status,
            'role' => $request->status === 'approved' ? 'instructor' : 'student',
        ]);

        // send email
        if(config('mail_queue.is_queue')) {
            // queue email
            Mail::to($user->email)->queue(new InstructorRequestActionMail($user));
        } else {
            // send email without queue (very long time to send email)
            Mail::to($user->email)->send(new InstructorRequestActionMail($user));
        }

        return redirect()->back();
    }

    public function downloadDocument(int $userId) {
        $user = User::find($userId);
        return response()->download(public_path($user->document));
    }
}

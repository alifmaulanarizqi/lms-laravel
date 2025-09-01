<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        return redirect()->back();
    }

    public function downloadDocument(int $userId) {
        $user = User::find($userId);
        return response()->download(public_path($user->document));
    }
}

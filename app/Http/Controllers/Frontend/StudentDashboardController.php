<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstructorRequestByStudentMail;

class StudentDashboardController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        return view('frontend.student-dashboard.index');
    }

    public function becomeInstructor(): View
    {   
        if (auth()->user()->role === 'instructor') {
            abort(403);
        }

        return view('frontend.student-dashboard.become-instructor.become-instructor');
    }

    public function becomeInstructorStore(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:10000']
        ]);

        // store file to storage
        $filePath = $this->uploadFile($request->file('document'));

        $user = User::find($id);
        $user->update([
            'document' => $filePath,
            'approve_status' => 'pending',
        ]);

        // send email to admin
        if (config('mail_queue.is_queue')) {
            // queue email
            Mail::to('alifdeadpool333@gmail.com')->queue(new InstructorRequestByStudentMail($user));
        } else {
            // send email without queue (very long time to send email)
            Mail::to('alifdeadpool333@gmail.com')->send(new InstructorRequestByStudentMail($user));
        }
        
        return redirect()->route('student.dashboard');
    }
}

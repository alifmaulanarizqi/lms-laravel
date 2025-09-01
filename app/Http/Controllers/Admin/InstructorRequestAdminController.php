<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InstructorRequestAdminController extends Controller
{
    public function index() : View {
        $instructorRequests = User::where('approve_status', 'pending')->get();
        return view('admin.instructor-request.index', compact('instructorRequests'));
    }
}

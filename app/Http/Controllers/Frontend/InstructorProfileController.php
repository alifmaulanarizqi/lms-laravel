<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileUpdateInformationRequest;
use App\Http\Requests\Frontend\ProfileUpdatePasswordRequest;
use App\Http\Requests\Frontend\ProfileUpdateSocialRequest;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorProfileController extends Controller
{
    use FileUpload;

    public function index() : View
    {
        return view('frontend.instructor-dashboard.instructor-profile.profile');
    }

    public function updateInformation(ProfileUpdateInformationRequest $request) : RedirectResponse
    {
        try {
            $user = Auth::user();

            if ($request->hasFile('image')) {
                $oldImagePath = $user->image;

                $imagePath = $this->uploadFile($request->file('image'));
                $user->image = $imagePath;

                $this->deleteFile($oldImagePath);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->headline = $request->headline;
            $user->bio = $request->bio;
            $user->save();
            return redirect()->back()->with('success', 'Profile information updated successfully!');
        } catch (\Exception $e) {
            logger($e);
            return redirect()->back()->with('error', 'Failed to update profile information. Please try again.');
        }
    }

    public function updatePassword(ProfileUpdatePasswordRequest $request) : RedirectResponse
    {
        try {
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully!');
        } catch (\Exception $e) {
            logger($e);
            return redirect()->back()->with('error', 'Failed to update password. Please try again.');
        }
    }

    public function updateSocial(ProfileUpdateSocialRequest $request) : RedirectResponse
    {
        try {
            $user = Auth::user();
            $user->facebook = $request->facebook;
            $user->x = $request->x;
            $user->linkedin = $request->linkedin;
            $user->website = $request->website;
            $user->github = $request->github;
            $user->save();
            return redirect()->back()->with('success', 'Social media updated successfully!');
        } catch (\Exception $e) {
            logger($e);
            return redirect()->back()->with('error', 'Failed to update social media. Please try again.');
        }
    }
}

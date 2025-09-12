@extends('frontend.layouts.master')

@section('content')
    <!--===========================
                                                    BREADCRUMB START
                                                ============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Instructor Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Instructor Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                                    BREADCRUMB END
                                                ============================-->


    <!--===========================
                                                    DASHBOARD OVERVIEW START
                                                ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.instructor-dashboard.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update.user.information') }}" method="POST"
                            class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf
                            <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                <div class="img">
                                    <img src="{{ asset(auth()->user()->image) }}" alt="profile" class="img-fluid w-100">
                                    <label for="profile_photo">
                                        <img src="{{ asset('frontend/assets/images/dash_camera.png') }}" alt="camera"
                                            class="img-fluid w-100">
                                    </label>
                                    <input type="file" id="profile_photo" hidden="" name="image" accept="image/*">
                                </div>
                                <div class="text">
                                    <h6>Your avatar</h6>
                                    <p>PNG or JPG format and less than 5MB</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Enter your name"
                                            value="{{ auth()->user()->name }}" required>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Enter your email"
                                            value="{{ auth()->user()->email }}" required>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option @selected(auth()->user()->gender == 'male') value="male">Male</option>
                                            <option @selected(auth()->user()->gender == 'female') value="female">Female</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Headline</label>
                                        <input type="text" name="headline" placeholder="Enter your headline"
                                            value="{{ auth()->user()->headline }}">
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Bio</label>
                                        <textarea name="bio" rows="7" placeholder="Your text here">{{ auth()->user()->bio }}</textarea>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Password</h5>
                                <p>Manage your password.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update.user.password') }}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password"
                                            placeholder="Enter your current password" required>
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" placeholder="Enter your new password"
                                            required>
                                        <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password"
                                            placeholder="Enter your confirm password" required>
                                        <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Social Media Information</h5>
                                <p>Manage your social media links.</p>
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update.user.social') }}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value="{{ auth()->user()->facebook }}"
                                            placeholder="Enter your Facebook link">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>X</label>
                                        <input type="text" name="x" value="{{ auth()->user()->x }}"
                                            placeholder="Enter your X link">
                                        <x-input-error :messages="$errors->get('x')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>LinkedIn</label>
                                        <input type="text" name="linkedin" value="{{ auth()->user()->linkedin }}"
                                            placeholder="Enter your LinkedIn link">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Website</label>
                                        <input type="text" name="website" value="{{ auth()->user()->website }}"
                                            placeholder="Enter your Website link">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Github</label>
                                        <input type="text" name="github" value="{{ auth()->user()->github }}"
                                            placeholder="Enter your Github link">
                                        <x-input-error :messages="$errors->get('github')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Social Media</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                                    DASHBOARD OVERVIEW END
                                                ============================-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profilePhotoInput = document.getElementById('profile_photo');
            
            profilePhotoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    // Find the parent form
                    const form = this.closest('form');
                    
                    if (form) {
                        // Optional: Show loading indicator
                        const existingIndicator = form.querySelector('.upload-indicator');
                        if (!existingIndicator) {
                            const submitBtn = document.createElement('div');
                            submitBtn.className = 'upload-indicator';
                            submitBtn.innerHTML =
                                '<div style="text-align: center; margin-top: 10px;"><small>Uploading image...</small></div>';
                            form.appendChild(submitBtn);
                        }
                        
                        // Submit the form automatically
                        form.submit();
                    }
                }
            });
        });
    </script>
@endsection

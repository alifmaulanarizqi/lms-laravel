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
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Student Dashboard</li>
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
            @if (auth()->user()->approve_status === 'pending')
                <div class="alert alert-primary d-flex align-items-center col-xl-12 col-md-12" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                        aria-label="Warning:">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        Hi, {{ auth()->user()->name }} your instructor request is currently pending. We will send a mail
                        when on your your email when it will be approved.
                    </div>
                </div>
            @endif
            @if ((auth()->user()->approve_status === 'approved' || auth()->user()->approve_status === 'rejected') && auth()->user()->role === 'student')
                <div class="text-end">
                    <a href="{{ route('student.become-instructor') }}" class="common_btn">Become an Instructor</a>
                </div>
            @elseif (auth()->user()->approve_status === 'approved' && auth()->user()->role === 'instructor')
                <div class="text-end">
                    <a href="{{ route('instructor.dashboard') }}" class="common_btn">To Instructor Dashboard</a>
                </div>
            @endif
            <div class="row">
                @include('frontend.student-dashboard.sidebar')
                <div class="col-xl-9 col-md-8">
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>REVENUE</h6>
                                <h3>$2456.34</h3>
                                <p>Earning this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>STUDENTS ENROLLMENTS</h6>
                                <h3>16,450</h3>
                                <p>Progress this month</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>COURSES RATING</h6>
                                <h3>4.70</h3>
                                <p>Rating this month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                DASHBOARD OVERVIEW END
                            ============================-->
@endsection

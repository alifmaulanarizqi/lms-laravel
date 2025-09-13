<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseLanguage\CourseLanguageRequest;
use App\Models\CourseLanguage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.course.course-language.course-language');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.course.course-language.create-course-language');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseLanguageRequest $request) : RedirectResponse {
        $coureLanguage = new CourseLanguage();
        $coureLanguage->name = $request->name;
        $coureLanguage->slug = Str::slug($request->name);
        $coureLanguage->save();
        return redirect()
        ->route('admin.course-languages.index')
        ->with('success', 'Course language added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

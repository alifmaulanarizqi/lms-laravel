<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseLanguage\CourseLanguageRequest;
use App\Models\CourseLanguage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courseLanguages = CourseLanguage::paginate(15);
        return view('admin.course.course-language.course-language', compact('courseLanguages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.course-language.create-course-language');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseLanguageRequest $request): RedirectResponse
    {
        try {
            $coureLanguage = new CourseLanguage();
            $coureLanguage->name = $request->name;
            $coureLanguage->slug = Str::slug($request->name);
            $coureLanguage->save();
            return redirect()
                ->route('admin.course-languages.index')
                ->with('success', 'Course language added successfully');
        } catch (\Exception $e) {
            logger($e);
            return redirect()
                ->route('admin.course-languages.index')
                ->with('error', 'Course language added failed. Please try again.');
        }
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
    public function edit(string $id): View
    {
        $courseLanguage = CourseLanguage::findOrFail($id);
        return view('admin.course.course-language.edit-course-language', compact('courseLanguage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseLanguageRequest $request, string $id): RedirectResponse
    {
        try {
            $courseLanguage = CourseLanguage::findOrFail($id);
            $courseLanguage->name = $request->name;
            $courseLanguage->slug = Str::slug($request->name);
            $courseLanguage->save();
            return redirect()
                ->route('admin.course-languages.index')
                ->with('success', 'Course language updated successfully');
        } catch (\Exception $e) {
            logger($e);
            return redirect()
                ->route('admin.course-languages.index')
                ->with('error', 'Course language updated failed. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $courseLanguage = CourseLanguage::findOrFail($id);
            $courseLanguage->delete();
            return response()->json(['message' => "Course language deleted successfully"], 200);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['message' => "Course language deleted failed. Please try again."], 500);
        }
    }
}

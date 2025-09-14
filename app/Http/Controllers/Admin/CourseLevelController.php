<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseLevel\CourseLevelRequest;
use App\Models\CourseLevel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courseLevels = CourseLevel::paginate(15);
        return view('admin.course.course-level.course-level', compact('courseLevels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.course-level.create-course-level');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseLevelRequest $request): RedirectResponse
    {
        try {
            $courseLevels = new CourseLevel();
            $courseLevels->name = $request->name;
            $courseLevels->slug = Str::slug($request->name);
            $courseLevels->save();
            return redirect()
                ->route('admin.course-levels.index')
                ->with('success', 'Course level added successfully');
        } catch (\Exception $e) {
            logger($e);
            return redirect()
                ->route('admin.course-levels.index')
                ->with('error', 'Course level added failed. Please try again.');
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
        $courseLevel = CourseLevel::findOrFail($id);
        return view('admin.course.course-level.edit-course-level', compact('courseLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseLevelRequest $request, string $id): RedirectResponse
    {
        try {
            $courseLevel = CourseLevel::findOrFail($id);
            $courseLevel->name = $request->name;
            $courseLevel->slug = Str::slug($request->name);
            $courseLevel->save();
            return redirect()
                ->route('admin.course-levels.index')
                ->with('success', 'Course level updated successfully');
        } catch (\Exception $e) {
            logger($e);
            return redirect()
                ->route('admin.course-levels.index')
                ->with('error', 'Course level updated failed. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $courseLevel = CourseLevel::findOrFail($id);
            $courseLevel->delete();
            return response()->json(['message' => "Course level deleted successfully"], 200);
        } catch (\Exception $e) {
            logger($e);
            return response()->json(['message' => "Course level deleted failed. Please try again."], 500);
        }
    }
}

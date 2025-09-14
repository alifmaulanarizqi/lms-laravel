@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Course Levels</h3>
                    <div class="card-actions">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="ti ti-arrow-left me-1"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.course-levels.update', $courseLevel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Level Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter level name" value="{{ $courseLevel->name }}" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i>
                                Update Level</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

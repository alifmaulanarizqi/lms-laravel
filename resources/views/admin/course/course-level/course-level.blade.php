@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Course Levels</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.course-levels.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i>
                            Add new
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courseLevels as $courseLevel)
                                    <tr>
                                        <td>{{ $courseLevel->name }}</td>
                                        <td>{{ $courseLevel->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.course-levels.edit', $courseLevel->id) }}"
                                                class="text-blue">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.course-levels.destroy', $courseLevel->id) }}"
                                                class="text-red delete-item">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $courseLevels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Instructor Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($instructorRequests as $instructorRequest)
                                    <tr>
                                        <td>{{ $instructorRequest->name }}</td>
                                        <td>{{ $instructorRequest->email }}</td>
                                        <td>
                                            @if ($instructorRequest->approve_status === 'pending')
                                                <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                            @elseif ($instructorRequest->approve_status === 'approved')
                                                <span class="badge bg-lime text-lime-fg">Approved</span>
                                            @elseif ($instructorRequest->approve_status === 'rejected')
                                                <span class="badge bg-red text-red-fg">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.instructor-requests.download-document', $instructorRequest->id) }}" class="text-muted"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 11l5 5l5 -5" />
                                                    <path d="M12 4l0 12" />
                                                </svg></a>
                                        </td>
                                        <td>
                                          <form method="POST" action="{{ route('admin.instructor-requests.update', $instructorRequest->id) }}" class="status-{{ $instructorRequest->id }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control" onchange="$('.status-{{ $instructorRequest->id }}').submit()">
                                              <option @selected($instructorRequest->approve_status === 'pending') value="pending">Pending</option>
                                              <option @selected($instructorRequest->approve_status === 'approved') value="approved">Approved</option>
                                              <option @selected($instructorRequest->approve_status === 'rejected') value="rejected">Rejected</option>
                                            </select>
                                          </form>
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
                </div>
            </div>
        </div>
    </div>
@endsection

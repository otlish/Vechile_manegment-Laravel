@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2 fw-bold text-primary-dark">Customer Management</h1>
            <p class="text-muted small">Manage registered users and their details</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
             <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-download me-1"></i> Export
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 text-uppercase text-muted small fw-bold">ID</th>
                            <th class="text-uppercase text-muted small fw-bold">Name</th>
                            <th class="text-uppercase text-muted small fw-bold">Email</th>
                            <th class="text-uppercase text-muted small fw-bold">Joined Date</th>
                            <th class="text-uppercase text-muted small fw-bold text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td class="ps-4 fw-bold text-secondary">#{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="fw-bold text-dark">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $customer->email }}</td>
                            <td class="text-muted">{{ $customer->created_at->format('M d, Y') }}</td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-users fa-3x opacity-25 mb-3"></i>
                                    <p>No customers found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

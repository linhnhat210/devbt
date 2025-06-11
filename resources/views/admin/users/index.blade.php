@extends('layouts.admin')

@section('title', 'Người dùng')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên người dùng..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="card mb-4">
                <div class="card-header">Người dùng</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">
                                            {{ $user->name }}
                                        </td>
                                        <td class="text-truncate" style="max-width: 200px;">
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="text-info">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </nav>

            <style>
                .pagination .page-link {
                    transition: all 0.3s ease;
                }

                .pagination .page-link:hover {
                    background-color: #513ede;
                    color: #fff;
                    border-color: #513ede;
                }
            </style>

        </div>
    </div>
@endsection

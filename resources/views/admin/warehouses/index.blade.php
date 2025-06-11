@extends('layouts.admin')

@section('title', 'Danh sách kho')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.warehouses.index') }}" class="d-flex w-100">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên kho..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.warehouses.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>

            <div class="card mb-4">
                <div class="card-header">Danh sách kho</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên kho</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warehouses as $index => $warehouse)
                                    <tr>
                                        <td>{{ $loop->iteration + ($warehouses->currentPage() - 1) * $warehouses->perPage() }}
                                        </td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $warehouse->name }}</td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $warehouse->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.warehouses.show', $warehouse->id) }}"
                                                class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}"
                                                class="text-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($warehouses->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $warehouses->links('pagination::bootstrap-5') }}
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

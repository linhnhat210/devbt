@extends('layouts.admin')

@section('title', 'Chủng loại thiết bị')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.categories.index') }}" class="d-flex w-100">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên thiết bị..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>

            <div class="card mb-4">
                <div class="card-header">Danh sách chủng loại thiết bị</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thiết bị</th>
                                    <th>Mã chủng loại</th>
                                    <th>Giá nội bộ</th>
                                    <th>Bảo hành (tháng)</th>
                                    <th>Thông tin</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $category->name }}</td>
                                        <td class="text-truncate" style="max-width: 100px;">{{ $category->code }}</td>
                                        <td>{{ number_format($category->internal_price, 0, ',', '.') }} đ</td>
                                        <td>{{ $category->warranty_period }}</td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $category->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($categories->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $categories->links('pagination::bootstrap-5') }}
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

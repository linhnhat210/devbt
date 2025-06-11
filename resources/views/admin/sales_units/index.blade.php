@extends('layouts.admin')

@section('title', 'Danh sách đơn vị bán hàng')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.sales_units.index') }}" class="d-flex w-100">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="name" placeholder="Tên đơn vị..."
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.sales_units.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.sales_units.create') }}" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>

            <div class="card mb-4">
                <div class="card-header">Danh sách đơn vị bán hàng</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên đơn vị</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesUnits as $index => $salesUnit)
                                    <tr>
                                        <td>{{ $loop->iteration + ($salesUnits->currentPage() - 1) * $salesUnits->perPage() }}
                                        </td>
                                        <td class="text-truncate" style="max-width: 150px;">{{ $salesUnit->name }}</td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $salesUnit->description }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sales_units.show', $salesUnit->id) }}"
                                                class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.sales_units.edit', $salesUnit->id) }}"
                                                class="text-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($salesUnits->isEmpty())
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
                    {{ $salesUnits->links('pagination::bootstrap-5') }}
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

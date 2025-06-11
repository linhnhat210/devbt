@extends('layouts.admin')

@section('title', 'Bảo hành')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.warranties.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="imei" placeholder="Tìm theo IMEI..."
                            value="{{ request('imei') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.warranties.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.warranties.create') }}" type="button" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </a>
                    </div>
                </form>
            </div>

            <div class="card mb-4">
                <div class="card-header">Danh sách bảo hành</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã bảo hành</th>
                                    <th>IMEI</th>
                                    <th>Khách hàng</th>
                                    <th>Mô tả lỗi</th>
                                    <th>Trạng thái</th>
                                    <th>Hết hạn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warranties as $index => $warranty)
                                    <tr>
                                        <td>{{ $index + $warranties->firstItem() }}</td>
                                        <td>{{ $warranty->code }}</td>
                                        <td>{{ $warranty->imei }}</td>
                                        <td>{{ $warranty->warrantyUser->name ?? '---' }}</td>
                                        <td>{{ $warranty->error_description }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'Chờ khách hàng xác nhận' => 'secondary',
                                                    'Đã tạo đơn' => 'primary',
                                                    'Đang bảo hành' => 'warning',
                                                    'Hoàn thành' => 'success',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$warranty->status] ?? 'dark' }}">
                                                {{ $warranty->status }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $warranty->expired_at ? \Carbon\Carbon::parse($warranty->expired_at)->format('d/m/Y') : '---' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.warranties.show', $warranty->id) }}"
                                                class="text-info">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.warranties.edit', $warranty->id) }}"
                                                class="text-warning">
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
                    {{ $warranties->links('pagination::bootstrap-5') }}
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

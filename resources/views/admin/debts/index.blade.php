@extends('layouts.admin')

@section('title', 'Công nợ')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">

            {{-- Tìm kiếm --}}
            <div class="row mb-3 align-items-center d-flex justify-content-center">
                <form method="GET" action="{{ route('admin.debts.index') }}" class="d-flex">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="debt_code" placeholder="Tìm theo mã công nợ..."
                            value="{{ request('debt_code') }}">
                    </div>
                    <div class="col-md-3">
                        <button style="margin-left: 10px" type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.debts.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-rotate-right"></i> Làm mới
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" onclick="showDebtTypeModal()">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Danh sách --}}
            <div class="card mb-4">
                <div class="card-header">Danh sách công nợ</div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Dự án</th>
                                    <th>Tên đại lý / khách hàng</th>
                                    <th>Mã công nợ</th>
                                    <th>Công nợ (vnd)</th>
                                    <th>Loại công nợ</th>
                                    <th>Loại dịch vụ</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debts as $index => $debt)
                                    <tr>
                                        <td>{{ $index + $debts->firstItem() }}</td>
                                        <td>{{ $debt->project->name ?? '---' }}</td>
                                        <td>{{ $debt->project->agent->name ?? '---' }}</td>

                                        <td>{{ $debt->debt_code }}</td>
                                        <td>{{ number_format($debt->amount, 0, ',', '.') }} đ</td>
                                        <td>
                                            @if ($debt->warranty_id)
                                                <span class="badge bg-info">Bảo hành</span>
                                            @elseif ($debt->device_payment_id)
                                                <span class="badge bg-warning">Thiết bị</span>
                                            @elseif ($debt->service_id)
                                                <span class="badge bg-success">Dịch vụ</span>
                                            @else
                                                <span class="badge bg-secondary">--- </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($debt->service)
                                                {{ $debt->service->service_type }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'Chờ thanh toán' => 'secondary',
                                                    'Hoàn thành' => 'success',
                                                    'Hủy' => 'danger',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$debt->status] ?? 'dark' }}">
                                                {{ $debt->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="
                                        {{ route('admin.debts.show', $debt->id) }}
                                         "
                                                class="text-info me-2">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @php
                                                $editRoute = '';
                                                if ($debt->warranty_id) {
                                                    $editRoute = route('admin.debts.edit', $debt->id);
                                                } elseif ($debt->device_payment_id) {
                                                    $editRoute = route('admin.debts.edit', $debt->id);
                                                } elseif ($debt->service_id) {
                                                    $editRoute = route('admin.debts.edit', $debt->id);
                                                }
                                            @endphp
                                            <a href="{{ $editRoute }}" class="text-warning">
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

            {{-- Phân trang --}}
            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $debts->links('pagination::bootstrap-5') }}
                </div>
            </nav>

            {{-- Style --}}
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

            {{-- Modal chọn loại công nợ --}}
            <div id="debtTypeModal" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Chọn loại công nợ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Vui lòng chọn loại công nợ bạn muốn tạo:</p>
                            <div class="d-grid gap-2">
                                <a href="
                            {{ route('admin.debts.create') }}?type=warranty
                             "
                                    class="btn btn-info">Bảo hành</a>
                                <a href="
                            {{ route('admin.debts.create') }}?type=device
                             "
                                    class="btn btn-warning">Thiết bị</a>
                                <a href="
                            {{ route('admin.debts.create') }}?type=service
                             "
                                    class="btn btn-success">Dịch vụ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Script gọi modal --}}
            <script>
                function showDebtTypeModal() {
                    const modal = new bootstrap.Modal(document.getElementById('debtTypeModal'));
                    modal.show();
                }
            </script>

        </div>
    </div>
@endsection

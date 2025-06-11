@extends('layouts.admin')

@section('title', 'Chỉnh sửa công nợ phí bảo hành')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.debts.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Chỉnh sửa công nợ phí bảo hành "{{ $debt->debt_code }}"</strong>
                    <span class="badge bg-warning text-dark">{{ $debt->status }}</span>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.debts.update', $debt->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Cột trái --}}
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Mã đơn bảo hành</label>
                                <input type="text" class="form-control" value="{{ $debt->warranty->code ?? '---' }}"
                                    disabled>

                                <label class="form-label mt-3">Loại công nợ</label>
                                <input type="text" class="form-control" value="Phí bảo hành" disabled>

                                <label class="form-label mt-3">Thời gian bảo hành</label>
                                <input type="text" class="form-control"
                                    value="{{ $debt->warranty->expired_at ?? '---' }}" disabled>

                                <label for="note" class="form-label mt-3">Ghi chú</label>
                                <textarea id="note" name="note" class="form-control" rows="3">{{ old('note', $debt->note) }}</textarea>
                            </div>

                            {{-- Cột phải --}}
                            <div class="col-md-6">
                                <label class="form-label">Giá hệ thống</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="0" disabled>
                                    <span class="input-group-text">VNĐ</span>
                                </div>

                                <label for="amount" class="form-label mt-3"><span class="text-danger">*</span> Giá
                                    duyệt</label>
                                <div class="input-group">
                                    <input type="number" id="amount" name="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ old('amount', $debt->amount) }}">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <label class="form-label mt-3">Tệp đính kèm</label>
                                <div class="border rounded p-3 bg-light text-center" style="min-height: 80px;">
                                    @if ($debt->attachment)
                                        <p>
                                            <a href="{{ asset('storage/' . $debt->attachment) }}" target="_blank">
                                                📎 Xem tệp hiện tại
                                            </a>
                                        </p>
                                    @endif

                                    <input type="file" name="attachment" class="form-control mt-2">
                                    <small class="text-muted d-block mt-1">Chọn hoặc kéo thả file mới để thay thế</small>
                                </div>
                            </div>
                        </div>

                        {{-- Nút cập nhật --}}
                        <div class="d-flex justify-content-end align-items-center mt-4">
                            <a href="{{ route('admin.debts.index') }}" class="btn btn-secondary me-2">Đóng</a>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>

                    {{-- Form hủy / duyệt riêng biệt --}}
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <form method="POST" action="{{ route('admin.debts.cancel', $debt->id) }}" class="me-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Hủy công nợ</button>
                        </form>

                        <form method="POST" action="{{ route('admin.debts.approve', $debt->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Thêm mới công nợ phí bảo hành')

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
            <div class="card-header">Thêm mới công nợ phí bảo hành</div>
            <div class="card-body">
                <form action="{{ route('admin.debts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Đặt trước giá trị loại công nợ --}}
                    <input type="hidden" name="debt_type" value="1">

                    <div class="row g-3">
                        {{-- Cột trái --}}
                        <div class="col-md-6">
                            <label for="warranty_id" class="form-label">
                                <span class="text-danger">*</span> Mã đơn bảo hành
                            </label>
                            <select id="warranty_id" name="warranty_id"
                                class="form-select select2 @error('warranty_id') is-invalid @enderror"
                                data-placeholder="Chọn mã đơn bảo hành">
                                <option></option>
                                @foreach ($warranties as $warranty)
                                    <option value="{{ $warranty->id }}"
                                        data-expired="{{ $warranty->expired_at }}"
                                        {{ old('warranty_id') == $warranty->id ? 'selected' : '' }}>
                                        {{ $warranty->code }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warranty_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="form-label mt-3">Loại công nợ</label>
                            <input type="text" class="form-control" value="Phí bảo hành" readonly>

                            <label for="expired_at" class="form-label mt-3">Thời gian bảo hành</label>
                            <input type="text" id="expired_at" class="form-control" readonly>

                            <label for="note" class="form-label mt-3">Ghi chú</label>
                            <textarea id="note" name="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                        </div>

                        {{-- Cột phải --}}
                        <div class="col-md-6">
                            {{-- Giá duyệt (amount) --}}
                            <label for="amount" class="form-label mt-3">
                                <span class="text-danger">*</span> Giá duyệt
                            </label>
                            <div class="input-group">
                                <input type="number" id="amount" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    placeholder="Nhập phí dịch vụ" value="{{ old('amount') }}">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Tệp đính kèm --}}
                            <label for="attachment" class="form-label mt-3">Tệp đính kèm</label>
                            <input type="file" id="attachment" name="attachment" class="form-control">
                            <small class="form-text text-muted">Chọn hoặc kéo thả file vào đây</small>
                        </div>
                    </div>

                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="continue" name="continue"
                            {{ old('continue') ? 'checked' : '' }}>
                        <label class="form-check-label" for="continue">Thêm và tiếp tục</label>
                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('admin.debts.index') }}" class="btn btn-secondary me-2">Đóng</a>
                        <button type="submit" class="btn btn-primary">
                            Thêm mới <i class="fa-solid fa-square-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#warranty_id').select2({
                placeholder: "Chọn mã đơn bảo hành",
                allowClear: true,
                width: '100%'
            });

            // Cập nhật thời gian bảo hành khi chọn mã đơn
            $('#warranty_id').on('change', function () {
                var expiredDate = $(this).find(':selected').data('expired') || '';
                $('#expired_at').val(expiredDate);
            });

            // Load sẵn nếu đã chọn từ trước
            var selectedInit = $('#warranty_id').find(':selected');
            if (selectedInit.length > 0) {
                var expiredInit = selectedInit.data('expired') || '';
                $('#expired_at').val(expiredInit);
            }
        });
    </script>
@endsection

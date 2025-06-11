@extends('layouts.admin')

@section('title', 'Thêm mới công nợ tiền dịch vụ')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="card mb-4">
                <div class="card-header">Thêm mới công nợ tiền dịch vụ</div>
                <div class="card-body">

                    {{-- Hiển thị lỗi tổng --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Đã có lỗi xảy ra:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.debts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            {{-- Cột trái --}}
                            <div class="col-md-6">
                                {{-- Dự án --}}
                                <label for="project_id" class="form-label"><span class="text-danger">*</span> Dự án</label>
                                <select id="project_id" name="project_id"
                                    class="form-select select2 @error('project_id') is-invalid @enderror"
                                    data-placeholder="Chọn dự án">
                                    <option></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Loại công nợ --}}
                                <label for="debt_type" class="form-label mt-3"><span class="text-danger">*</span> Loại công
                                    nợ</label>
                                <input type="hidden" id="debt_type" name="debt_type" class="form-control" value="3">
                                <input type="text" class="form-control" value="Phí dịch vụ" readonly>

                                {{-- Thời gian bắt đầu thu phí --}}
                                <label for="start_date" class="form-label mt-3"><span class="text-danger">*</span> Thời gian
                                    bắt đầu thu phí</label>
                                <input type="text" id="start_date" name="start_date"
                                    class="form-control flatpickr @error('start_date') is-invalid @enderror"
                                    placeholder="Chọn thời gian bắt đầu" value="{{ old('start_date') }}" autocomplete="off">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Thời gian hoàn thành thu phí --}}
                                <label for="end_date" class="form-label mt-3">Thời gian hoàn thành thu phí</label>
                                <input type="text" id="end_date" name="end_date" class="form-control flatpickr"
                                    placeholder="Chọn thời gian hoàn thành" value="{{ old('end_date') }}" autocomplete="off">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Loại dịch vụ --}}
                                <label for="service_type" class="form-label mt-3"><span class="text-danger">*</span> Loại
                                    dịch vụ</label>
                                <select id="service_type" name="service_type"
                                    class="form-select select2 @error('service_type') is-invalid @enderror"
                                    data-placeholder="Chọn loại dịch vụ">
                                    <option></option>
                                    <option value="Dịch vụ bảo trì thiết bị"
                                        {{ old('service_type') == 'Dịch vụ bảo trì thiết bị' ? 'selected' : '' }}>
                                        Dịch vụ bảo trì thiết bị
                                    </option>
                                    <option value="Dịch vụ máy chủ" {{ old('service_type') == 'Dịch vụ máy chủ' ? 'selected' : '' }}>
                                        Dịch vụ máy chủ
                                    </option>
                                    <option value="Dịch vụ sim card" {{ old('service_type') == 'Dịch vụ sim card' ? 'selected' : '' }}>
                                        Dịch vụ sim card
                                    </option>
                                </select>
                                @error('service_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Ghi chú --}}
                                <label for="note" class="form-label mt-3">Ghi chú</label>
                                <textarea id="note" name="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Cột phải --}}
                            <div class="col-md-6">
                                {{-- Phí dịch vụ/tháng --}}
                                <label for="monthly_fee" class="form-label"><span class="text-danger">*</span> Phí dịch
                                    vụ/tháng</label>
                                <div class="input-group">
                                    <input type="number" id="monthly_fee" name="monthly_fee"
                                        class="form-control @error('monthly_fee') is-invalid @enderror"
                                        placeholder="Nhập phí dịch vụ" value="{{ old('monthly_fee') }}">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                @error('monthly_fee')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Chu kỳ thu phí --}}
                                <label for="billing_cycle" class="form-label mt-3"><span class="text-danger">*</span> Chu kỳ
                                    thu phí</label>
                                <div class="input-group">
                                    <input type="number" id="billing_cycle" name="billing_cycle"
                                        class="form-control @error('billing_cycle') is-invalid @enderror"
                                        placeholder="Nhập chu kỳ thu phí" value="{{ old('billing_cycle') }}">
                                    <span class="input-group-text">Tháng</span>
                                </div>
                                @error('billing_cycle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Giá đề xuất --}}
                                <label for="suggested_price" class="form-label mt-3">Giá đề xuất</label>
                                <div class="input-group">
                                    <input type="number" id="suggested_price" name="suggested_price"
                                        class="form-control @error('suggested_price') is-invalid @enderror"
                                        placeholder="Nhập giá đề xuất" value="{{ old('suggested_price') }}">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                @error('suggested_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Giá duyệt --}}
                                <label for="approved_price" class="form-label mt-3"><span class="text-danger">*</span> Giá
                                    duyệt</label>
                                <div class="input-group">
                                    <input type="number" id="amount" name="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="Nhập giá duyệt" value="{{ old('amount') }}">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Số tháng thu phí --}}
                                <label for="billing_months" class="form-label mt-3">Số tháng thu phí</label>
                                <div class="input-group">
                                    <input type="number" id="billing_months" name="billing_months"
                                        class="form-control @error('billing_months') is-invalid @enderror"
                                        placeholder="Số tháng" value="{{ old('billing_months') }}">
                                    <span class="input-group-text">Tháng</span>
                                </div>
                                @error('billing_months')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Tự động gia hạn --}}
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('auto_extend') is-invalid @enderror" type="checkbox"
                                        id="auto_extend" name="auto_extend" {{ old('auto_extend') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="auto_extend">Tự động gia hạn</label>
                                    @error('auto_extend')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tệp đính kèm --}}
                                <label for="attachment" class="form-label mt-3">Tệp đính kèm</label>
                                <input type="file" id="attachment" name="attachment"
                                    class="form-control @error('attachment') is-invalid @enderror">
                                @error('attachment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Check thêm tiếp tục --}}
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="continue" name="continue"
                                {{ old('continue') ? 'checked' : '' }}>
                            <label class="form-check-label" for="continue">Thêm và tiếp tục</label>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('admin.debts.index') }}" class="btn btn-secondary me-2">Đóng</a>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%'
            });

            flatpickr('.flatpickr', {
                locale: 'vn',
                dateFormat: 'd/m/Y',
                allowInput: true
            });
        });
    </script>
@endsection

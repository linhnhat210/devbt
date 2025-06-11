@extends('layouts.admin')

@section('title', 'Thêm mới công nợ tiền thiết bị')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">


            <div class="card mb-4">
                <div class="card-header">Thêm mới công nợ tiền thiết bị</div>
                <div class="card-body">
                    <form action="{{ route('admin.debts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
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
                                <label for="loai_cong_no" class="form-label mt-3"><span class="text-danger">*</span> Loại
                                    công nợ</label>
                                <input type="hidden" id="debt_type" name="debt_type" class="form-control" value="2"
                                    readonly>
                                <input type="text" class="form-control" value="Tiền thiết bị" readonly>

                                {{-- Thời gian bắt đầu thu phí --}}
                                <label for="thoi_gian_bat_dau" class="form-label mt-3"><span class="text-danger">*</span>
                                    Thời gian bắt đầu thu phí</label>
                                <input type="text" id="start_date" name="start_date"
                                    class="form-control flatpickr @error('start_date') is-invalid @enderror"
                                    placeholder="Chọn thời gian bắt đầu" value="{{ old('start_date') }}"
                                    autocomplete="off">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div   >
                                @enderror

                                {{-- Ghi chú --}}
                                <label for="ghi_chu" class="form-label mt-3">Ghi chú</label>
                                <textarea id="ghi_chu" name="ghi_chu" rows="3" class="form-control">{{ old('ghi_chu') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                {{-- Giá hệ thống --}}
                                <label for="gia_he_thong" class="form-label">Giá hệ thống</label>
                                <div class="input-group">
                                    <input type="number" readonly id="gia_he_thong" name="gia_he_thong"
                                        class="form-control" placeholder="Phí dịch vụ" value="{{ old('gia_he_thong') }}">
                                    <span class="input-group-text">VNĐ</span>
                                </div>

                                {{-- Giá duyệt --}}
                                <label for="gia_duyet" class="form-label mt-3"><span class="text-danger">*</span> Giá
                                    duyệt</label>
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
                                <label for="attachments" class="form-label mt-3">Tệp đính kèm</label>

                                <input type="file" id="attachments" name="attachments[]" multiple class="form-control">


                            </div>
                        </div>

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
                allowInput: true,
            });
        });
    </script>
@endsection

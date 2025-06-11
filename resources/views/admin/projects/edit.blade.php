@extends('layouts.admin')

@section('title', 'Cập nhật dự án')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Cập nhật dự án</div>
                <div class="card-body">
                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Tên dự án</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $project->name) }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Đại lý <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('agent_id') is-invalid @enderror" id="agent_id"
                                    name="agent_id">
                                    <option value="">Chọn đại lý</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}"
                                            {{ old('agent_id', $project->agent_id) == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label"><span class="text-danger">*</span> Địa chỉ</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ old('address', $project->address) }}">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kinh doanh phụ trách <span class="text-danger">*</span></label>
                                <select class="form-control select2 @error('sales_user_id') is-invalid @enderror"
                                    id="sales_user_id" name="sales_user_id">

                                    <option value="">Chọn kinh doanh</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('sales_user_id', $project->sales_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sales_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Thời gian bảo hành</label>
                                <input type="text"
                                    class="form-control datepicker @error('warranty_start_date') is-invalid @enderror"
                                    name="warranty_start_date"
                                    value="{{ old('warranty_start_date', $project->warranty_start_date) }}">
                                @error('warranty_start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">

                                <label for="accountant_user_id" class="form-label fw-semibold">Kế toán phụ trách <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2 @error('accountant_user_id') is-invalid @enderror"
                                    id="accountant_user_id" name="accountant_user_id">
                                    <option value="">Chọn kế toán phụ trách</option> <!-- Mặc định -->
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('accountant_user_id', $project->accountant_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('sales_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="">-- Chọn trạng thái --</option>
                                @foreach (['Đã triển khai', 'Đang triển khai', 'Hủy', 'Tạm dừng', 'Tạo mới'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status', $project->status) === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn btn-success">
                                Cập nhật <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                locale: "vn",
                allowInput: true,
            });

            // Khởi tạo từng select2 với placeholder riêng
            $('#agent_id').select2({
                placeholder: "Chọn đại lý",
                allowClear: true
            });

            $('#sales_user_id').select2({
                placeholder: "Chọn kinh doanh phụ trách",
                allowClear: true
            });

            $('#accountant_user_id').select2({
                placeholder: "Chọn kế toán phụ trách",
                allowClear: true
            });

        });
    </script>
@endsection

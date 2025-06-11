@extends('layouts.admin')

@section('title', 'Thêm bảo hành')

@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4">
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <a href="{{ route('admin.warranties.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Thêm bảo hành</div>
                <div class="card-body">
                    <form action="{{ route('admin.warranties.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            {{-- IMEI Thiết bị --}}
                            <div class="col-md-6">
                                <label for="imei" class="form-label"><span class="text-danger">*</span> IMEI thiết
                                    bị</label>
                                <select class="form-control select2 @error('imei') is-invalid @enderror" id="imei"
                                    name="imei" required>
                                    <option value="">Chọn IMEI</option>
                                    @foreach ($devices as $device)
                                        <option value="{{ $device->imei }}" data-device-id="{{ $device->id }}"
                                            {{ old('imei') == $device->imei ? 'selected' : '' }}>
                                            {{ $device->imei }} - {{ $device->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('imei')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Hidden device_id --}}
                            <input type="hidden" id="device_id" name="device_id" value="{{ old('device_id') }}">

                            {{-- Người bảo hành --}}
                            <div class="col-md-6">
                                <label for="warranty_user_id" class="form-label">Người bảo hành</label>
                                <select class="form-control select2 @error('warranty_user_id') is-invalid @enderror"
                                    id="warranty_user_id" name="warranty_user_id" required>
                                    <option value="">Chọn người dùng</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('warranty_user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('warranty_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ngày bắt đầu (readonly) --}}
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Ngày bắt đầu bảo hành</label>
                                <input type="text"
                                    class="form-control datepicker @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date"
                                    value="{{ old('start_date', now()->format('Y-m-d')) }}" readonly>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="expired_at" class="form-label">Ngày kết thúc bảo hành</label>
                                <input type="text"
                                    class="form-control datepicker @error('expired_at') is-invalid @enderror"
                                    id="expired_at" name="expired_at"
                                    value="{{ old('expired_at', now()->addYear()->format('Y-m-d')) }}" readonly>
                                @error('expired_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Loại bảo hành --}}
                            <div class="col-md-6">
                                <label for="type" class="form-label">Loại bảo hành</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror"
                                    name="type" value="{{ old('type') }}" placeholder="Phần mềm, phần cứng...">
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Mô tả lỗi --}}
                            <div class="col-md-12">
                                <label for="error_description" class="form-label">Mô tả lỗi</label>
                                <textarea class="form-control" name="error_description" rows="3" placeholder="Nhập mô tả lỗi">{{ old('error_description') }}</textarea>
                                @error('error_description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Ghi chú --}}
                            <div class="col-md-12">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" name="note" rows="2" placeholder="Ghi chú thêm">{{ old('note') }}</textarea>
                                @error('note')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Trạng thái --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="Chờ khách hàng xác nhận"
                                        {{ old('status') == 'Chờ khách hàng xác nhận' ? 'selected' : '' }}>Chờ khách hàng
                                        xác nhận</option>
                                    <option value="Đã tạo đơn" {{ old('status') == 'Đã tạo đơn' ? 'selected' : '' }}>Đã tạo
                                        đơn</option>
                                    <option value="Đang bảo hành" {{ old('status') == 'Đang bảo hành' ? 'selected' : '' }}>
                                        Đang bảo hành</option>
                                    <option value="Hoàn thành" {{ old('status') == 'Hoàn thành' ? 'selected' : '' }}>Hoàn
                                        thành</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Thêm mới <i class="fa-solid fa-square-plus"></i>
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

            $('#imei').select2({
                placeholder: "Chọn IMEI",
                allowClear: true
            });

            $('#warranty_user_id').select2({
                placeholder: "Chọn người dùng",
                allowClear: true
            });
            $('#imei').on('change', function() {
                const selected = $(this).find('option:selected');
                const deviceId = selected.data('device-id') ?? '';
                $('#device_id').val(deviceId);
            });

            $('#imei, #warranty_user_id').select2({
                placeholder: "Chọn",
                allowClear: true
            });
        });
    </script>
@endsection
